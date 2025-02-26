<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Prices 
 * Prices class to manage rental price data
 */
class Prices extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('prices_model');
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
            $data['page_title'] = "Rental Prices";
            $data['records'] = $this->prices_model->getAll();
            $data['biketypes'] = $this->biketypes_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/prices', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function getRecord()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if( $id )
        {
            $record = $this->prices_model->getById($id);
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
        $this->form_validation->set_rules('type_id','Bike Type','trim|required|max_length[128]');
        $this->form_validation->set_rules('week_day_price','Week Day Price','trim|required|numeric|max_length[128]');
        $this->form_validation->set_rules('week_day_half_price','Week Day Half Price','trim|required|numeric|max_length[128]');
        $this->form_validation->set_rules('weekend_day_price','Weekend Day Price','trim|required|numeric|max_length[128]');
        $this->form_validation->set_rules('weekend_day_half_price','Weekend Day Half Price','trim|required|numeric|max_length[128]');
        $this->form_validation->set_rules('holiday_day_price','Holiday Day Price','trim|required|numeric|max_length[128]');
        $this->form_validation->set_rules('holiday_day_half_price','Holiday Day Half Price','trim|required|numeric|max_length[128]');
                
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
            $type_id = $this->security->xss_clean($this->input->post('type_id'));

            $week_day_price = $this->security->xss_clean($this->input->post('week_day_price'));
            $week_day_half_price = $this->security->xss_clean($this->input->post('week_day_half_price'));
            $weekend_day_price = $this->security->xss_clean($this->input->post('weekend_day_price'));
            $weekend_day_half_price = $this->security->xss_clean($this->input->post('weekend_day_half_price'));
            $holiday_day_price = $this->security->xss_clean($this->input->post('holiday_day_price'));
            $holiday_day_half_price = $this->security->xss_clean($this->input->post('holiday_day_half_price'));

            if( $id == "" )
            {
                $recordInfo = array(
                    'type_id' => $type_id, 
                    'week_day_price' => $week_day_price,
                    'week_day_half_price' => $week_day_half_price,
                    'weekend_day_price' => $weekend_day_price,
                    'weekend_day_half_price' => $weekend_day_half_price,
                    'holiday_day_price' => $holiday_day_price,
                    'holiday_day_half_price' => $holiday_day_half_price,
                    'created_by' => $user['userId']
                );
                if( $this->prices_model->checkRecordExists($type_id) )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists.";
                }
                else
                {
                    $result = $this->prices_model->addNew($recordInfo);
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
                $recordInfo = array('type_id' => $type_id, 'week_day_price' => $week_day_price,
                    'week_day_half_price' => $week_day_half_price,
                    'weekend_day_price' => $weekend_day_price,
                    'weekend_day_half_price' => $weekend_day_half_price,
                    'holiday_day_price' => $holiday_day_price,
                    'holiday_day_half_price' => $holiday_day_half_price,);

                $result = $this->prices_model->checkRecordExists1($type_id, $id);
                if( $result )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists";
                    $response["success_message"] = "";
                }
                else
                {
                    $result = $this->prices_model->updateRecord($recordInfo, $id);
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
        
        $data['record'] = $this->prices_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            $this->prices_model->deleteRecord($record_id);
            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>