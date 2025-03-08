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
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/new_booking', $data);
            $this->load->view('layout_admin/footer');
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