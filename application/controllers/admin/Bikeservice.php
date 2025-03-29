<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bikeservice
 * Bikeservice class to manage bike CRUD.
 */
class Bikeservice extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bike_model');
        $this->load->model('bikeservice_model');
        $this->load->model('servicebikes_model');
        $this->load->model('manufacturer_model');
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
            $data['page_title'] = "Bike Services";
            $data['records'] = $this->bikeservice_model->getAll();

            $data['manufacturers'] = $this->manufacturer_model->getAll();
            $data['biketypes'] = $this->biketypes_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/bikeservice', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function getRecord()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if( $id )
        {
            $record = $this->bikeservice_model->getById($id);
            die(json_encode($record));
        }
        else
        {
            die("{'error':1,'error_message':'Invalid Request'}");
        }
    }

    public function getBikes()
    {
        $response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
        if ($this->input->is_ajax_request()) 
        {
            if ($this->input->method(TRUE) == "POST") 
            {
                $type_id = intval($this->input->post('type_id'));

                $result = $this->bike_model->getBikesByType($type_id);
                $response['error'] = 0;
                $response['error_message'] = "";
                $response['success_message'] = "Found";
                $response['data'] = $result;
            }
        }
        die(json_encode($response));
    }

    public function save_record()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation');      

        $id = $this->security->xss_clean($this->input->post('record_id'));   

        $this->form_validation->set_rules('bike_ids','Bikes','trim|required|max_length[128]');
        $this->form_validation->set_rules('service_type','Service Type','trim|required|max_length[128]');
        $this->form_validation->set_rules('name','Name','trim|required');
        $this->form_validation->set_rules('phone','Phone','trim|required|max_length[10]');
        $this->form_validation->set_rules('address','Address','trim|required|max_length[200]');
        $this->form_validation->set_rules('start_date','Start Date','trim|required|max_length[25]');
        $this->form_validation->set_rules('service_cost','Service Cost','trim|required|max_length[25]');
                
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        
        $user = $this->session->userdata();
        $id = $this->security->xss_clean($this->input->post('record_id'));
        $bike_ids = $this->security->xss_clean($this->input->post('bike_ids'));
        $name = $this->security->xss_clean($this->input->post('name'));
        $phone = $this->security->xss_clean($this->input->post('phone'));
        $address = $this->security->xss_clean($this->input->post('address'));
        $service_type = $this->security->xss_clean($this->input->post('service_type'));
        $start_date = $this->security->xss_clean($this->input->post('start_date'));
        $end_date = $this->security->xss_clean($this->input->post('end_date'));
        $service_cost = $this->security->xss_clean($this->input->post('service_cost'));
        $request_note = $this->security->xss_clean($this->input->post('request_note'));
        
        $recordInfo = array(
                'service_type' => $service_type,
                'service_proivder_name' => $name, 
                'service_proivder_phone' => $phone,
                'service_proivder_address' => $address,
                'service_start_date' => $start_date,
                'service_date' => $end_date,
                'request_note' => $request_note,
                'service_cost' => $service_cost,
                'created_by' => $user['userId']
            );

        if( $id == "" )
        {
            if( $this->bikeservice_model->checkRecordExists($bike_ids) )
            {
                $response["error"] = 1;
                $response["error_message"] = "1 or more bike already in service.";
            }
            else
            {
                $service_id = $this->bikeservice_model->addNew($recordInfo);
                if( $service_id > 0 )
                {
                    $bikes = explode(",", $bike_ids);
                    for($i=0 ;$i < count($bikes); $i++)
                    {
                        $service_bike = array(
                            'service_id' => $service_id,
                            'bike_id' => $bikes[$i]
                        );

                        $this->servicebikes_model->addNew($service_bike);

                        $service_bike = array(
                            'available' => 0,
                            'id' => $bikes[$i]
                        );

                        $this->bike_model->updateRecord($service_bike, $bikes[$i]);

                    }                    

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
            $result = $this->bikeservice_model->checkRecordExists1($bike_ids, $id);
            if( $result )
            {
                $response["error"] = 1;
                $response["error_message"] = "1 or more bike selected already in service.";
                $response["success_message"] = "";
            }
            else
            {
                $result = $this->bikeservice_model->updateRecord($recordInfo, $id);
                if( $result )
                {
                    $this->servicebikes_model->deleteByServiceId($id);

                    $bikes = explode(",", $bike_ids);

                    for($i=0 ;$i < count($bikes); $i++)
                    {
                        $service_bike = array(
                            'service_id' => $id,
                            'bike_id' => $bikes[$i]
                        );

                        $this->servicebikes_model->addNew($service_bike);
                        $service_bike = array(
                            'available' => 0,
                            'id' => $bikes[$i]
                        );

                        $this->bike_model->updateRecord($service_bike, $bikes[$i]);
                    } 

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

        $user = $this->session->userdata();

        if( $user['user_type'] !== "Admin" )
        {
            $response["error"] = 1;
            $response["error_message"] = "Your have no permission.";   
            die(json_encode($response));
        }
        
        $data['record'] = $this->bikeservice_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            $this->bikeservice_model->deleteRecord($record_id);

            $result = $this->servicebikes_model->getByServiceId($record_id);
            foreach($result as $row)
            {
                $service_bike = array(
                    'available' => 1,
                    'id' => $row['bike_id']
                );
                $this->bike_model->updateRecord($service_bike, $row['bike_id']);
            }

            $this->servicebikes_model->deleteByServiceId($record_id);

            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>