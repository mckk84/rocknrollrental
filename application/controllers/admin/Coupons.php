<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Coupons
 * Coupons class to control to manage Coupons data
 */
class Coupons extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('coupons_model');
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
            $data['page_title'] = "Coupons";
            $data['records'] = $this->coupons_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/coupons', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function getRecord()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if( $id )
        {
            $record = $this->coupons_model->getById($id);
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
        $this->form_validation->set_rules('title','Title','trim|required|max_length[128]');
        $this->form_validation->set_rules('code','Code','trim|required|max_length[10]');
        $this->form_validation->set_rules('discount_amount','Discount Amount','trim|required|max_length[6]');

        $this->form_validation->set_rules('quantity','Quantity','trim|required|max_length[6]');
        $this->form_validation->set_rules('type','Type','trim|required|max_length[10]');
        $this->form_validation->set_rules('status','Status','trim|required|max_length[6]');
        $this->form_validation->set_rules('start_date','Start Date','trim|required|max_length[12]');
        $this->form_validation->set_rules('end_date','End Date','trim|required|max_length[12]');
                        
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
            $title = $this->security->xss_clean($this->input->post('title'));
            $code = $this->security->xss_clean($this->input->post('code'));
            $discount_amount = $this->security->xss_clean($this->input->post('discount_amount'));
            $quantity = $this->security->xss_clean($this->input->post('quantity'));
            $type = $this->security->xss_clean($this->input->post('type'));
            $status = $this->security->xss_clean($this->input->post('status'));
            $start_date = $this->security->xss_clean($this->input->post('start_date'));
            $end_date = $this->security->xss_clean($this->input->post('end_date'));

            if( $id == "" )
            {
                $recordInfo = array(
                    'title' => trim($title),  
                    'code' => trim($code),  
                    'discount_amount' => trim($discount_amount),  
                    'quantity' => trim($quantity),  
                    'type' => trim($type),  
                    'status' => trim($status),  
                    'start_date' => trim($start_date),  
                    'end_date' => trim($end_date),  
                    'created_by' => $user['userId']
                );

                if( $this->coupons_model->checkRecordExists($code) )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists.";
                }
                else
                {
                    $result = $this->coupons_model->addNew($recordInfo);
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
                $recordInfo = array(
                    'title' => trim($title),  
                    'code' => trim($code),  
                    'discount_amount' => trim($discount_amount),  
                    'quantity' => trim($quantity),  
                    'type' => trim($type),  
                    'status' => trim($status),  
                    'start_date' => trim($start_date),  
                    'end_date' => trim($end_date),  
                    'created_by' => $user['userId']
                );

                $result = $this->coupons_model->checkRecordExists1($code, $id);
                if( $result )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists";
                    $response["success_message"] = "";
                }
                else
                {
                    $result = $this->coupons_model->updateRecord($recordInfo, $id);
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
        
        $data['record'] = $this->coupons_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            $this->coupons_model->deleteRecord($record_id);
            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>