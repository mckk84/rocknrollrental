<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bookings
 * Bookings class to control to manage Bookings data
 */
class Bookings extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bookings_model');
        $this->load->model('biketypes_model');
        $this->load->model('holidays_model');
        $this->load->model('publicholidays_model');
        $this->load->model('searchbike_model');
        $this->load->model('customers_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('admin');
        }
        else
        {
            $data['user'] = $this->session->userdata();
            $data['page_title'] = "Bookings";
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            $data['records'] = $this->bookings_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/bookings', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function new()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('admin');
        }
        else
        {
            $data['user'] = $this->session->userdata();
            $data['page_title'] = "New Booking";
            $data['customers'] = $this->customers_model->getAll();
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/new_booking', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function search()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 
           
        $this->form_validation->set_rules('bikeId','Bike','trim|required|max_length[128]');
        $this->form_validation->set_rules('pickup_date','pickup_date','trim|required|max_length[18]');
        $this->form_validation->set_rules('pickup_time','pickup_time','trim|required|max_length[15]');
        $this->form_validation->set_rules('dropoff_date','dropoff_date','trim|required|max_length[18]');
        $this->form_validation->set_rules('dropoff_time','dropoff_time','trim|required|max_length[15]');
                        
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $data['bike_ids'] = $this->security->xss_clean($this->input->post('bikeId'));
            $data['pickup_date'] = $this->security->xss_clean($this->input->post('pickup_date'));
            $data['pickup_time'] = $this->security->xss_clean($this->input->post('pickup_time'));
            $data['dropoff_date'] = $this->security->xss_clean($this->input->post('dropoff_date'));
            $data['dropoff_time'] = $this->security->xss_clean($this->input->post('dropoff_time'));

            $d1= new DateTime($data['dropoff_date']." ".$data['dropoff_time']); // first date
            $d2= new DateTime($data['pickup_date']." ".$data['pickup_time']); // second date
            $interval= $d1->diff($d2); // get difference between two dates
            $data['period_days'] = $interval->days;
            $data['period_hours'] = $interval->h; 

            if( $data['period_hours'] <= 0 )
            {
                $response = array('error' => 1, 'error_message' => 'Invalid dates');
                die($response);
            }

            $data['weekend'] = 0;
            $data['public_holiday'] = 0;
            $data['holiday'] = 0;
            $date=date_create($data['pickup_date']);
            $day = date_format($date,"D");
            if( $day == 'Sat' || $day == 'Sun' )
            {
                $data['weekend'] = 1;
            }
            $res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['pickup_date']));
            if( $res )
            {
                $data['public_holiday'] = 1;
            }

            $res = $this->holidays_model->checkRecordExists(dateformatdb($data['pickup_date']));
            if( $res )
            {
                $data['holiday'] = 1;
            }

            $data['bike_availability'] = 0;
            $data['cart_bikes'] = $this->searchbike_model->searchBikes($data['bike_ids'], $data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);
            $bike_ids = explode(",", $data['bike_ids']);

            foreach($data['cart_bikes'] as $index => $bike)
            {
                if( in_array($bike['bike_type_id'], $bike_ids))
                {
                    $bike['quantity'] = $bike['available'];
                    if( $bike['available'] == "1" )
                    {
                        $data['bike_availability'] = intval($data['bike_availability']) + 1;
                    }

                    $bike['rent_price'] = 0;
                    if( $data['period_days'] > 0 || $data['period_hours'] > 4  ){
                        $duration = "day";
                        if( $data['public_holiday'] == 1 ){
                            $bike['rent_price'] = $bike['holiday_day_price'];
                        }
                        elseif( $data['weekend'] == 1 ){
                            $bike['rent_price'] = $bike['weekend_day_price'];
                        } else {
                            $bike['rent_price'] = $bike['week_day_price'];
                        }
                    } else {
                        $duration = "halfday";
                        if( $data['public_holiday'] == 1 ){
                            $bike['rent_price'] = $bike['holiday_day_half_price'];
                        } elseif( $data['weekend'] == 1 ){
                            $bike['rent_price'] = $bike['weekend_day_half_price'];
                        } else {
                            $bike['rent_price'] = $bike['week_day_half_price'];
                        } 
                    }
                }                   
                $data['cart_bikes'][$index] = $bike;
            }
            $response = array('error' => 0, 'error_message' => '', 'success_message' => 'success', 'data' => $data);
            die(json_encode($response));
        }
    }

    public function getRecord()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if( $id )
        {
            $record = $this->bookings_model->getById($id);
            die(json_encode($record));
        }
        else
        {
            die("{'error':1,'error_message':'Invalid Request'}");
        }
    }

    public function save_record()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 

        $id = $this->security->xss_clean($this->input->post('record_id'));           
        $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('phone','Phone','trim|required|max_length[10]');
        
        if( $id == "" ) {
            $this->form_validation->set_rules('password','Passwword','trim|required|min_length[6]|max_length[25]');
        }
                
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $user = $this->session->userdata();
            $id = $this->security->xss_clean($this->input->post('record_id'));
            $name = $this->security->xss_clean($this->input->post('name'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $phone = $this->security->xss_clean($this->input->post('phone'));
            $password = $this->security->xss_clean($this->input->post('password'));

            if( $id == "" )
            {
                $recordInfo = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => getHashedPassword($password),
                    'created_by' => $user['userId']
                );

                if( $this->bookings_model->checkPhoneExists($phone) )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists.";
                }
                else
                {
                    $result = $this->bookings_model->addNew($recordInfo);
                    if($result > 0)
                    {
                        $response["error"] = 0;
                        $response["error_message"] = "";
                        $response["success_message"] = "Record added successfully";
                    } 
                    else 
                    {
                        $response["error"] = 1;
                        $response["error_message"] = "Record add failed.";
                    }
                }    
            }
            else
            {
                $recordInfo = array('name' => $name, 'email' => $email,
                    'phone' => $phone);

                $result = $this->bookings_model->checkPhoneExists1($name, $id);
                if( $result )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists";
                    $response["success_message"] = "";
                }
                else
                {
                    $result = $this->bookings_model->updateRecord($recordInfo, $id);
                    if($result > 0)
                    {
                        $response["error"] = 0;
                        $response["error_message"] = "";
                        $response["success_message"] = "Record updated successfully";
                    } 
                    else 
                    {
                        $response["error"] = 1;
                        $response["error_message"] = "Record update failed.";
                    }
                }                
            }            
            die(json_encode($response));            
        }
    }

    public function deleteRecord()
    {
        $record_id = intval($this->uri->segment(4));
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        
        if( $record_id == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Invalid Request";
            die(json_encode($response));
        }
        
        $data['record'] = $this->bookings_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            $this->bookings_model->deleteRecord($record_id);
            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>