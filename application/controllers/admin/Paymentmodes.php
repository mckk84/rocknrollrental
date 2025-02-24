<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Paymentmodes
 * Paymentmodes to manage payment methods.
 */
class Paymentmodes extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paymentmode_model');
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
            $data['page_title'] = "Payment Modes";
            $data['records'] = $this->Paymentmode_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/paymentmodes', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function getRecord()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if( $id )
        {
            $record = $this->Paymentmode_model->getById($id);
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
        $this->form_validation->set_rules('payment_mode','Payment Mode','trim|required|max_length[128]');
                
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
            $payment_mode = $this->security->xss_clean($this->input->post('payment_mode'));

            if( $id == "" )
            {
                $recordInfo = array('payment_mode' => $payment_mode, 'created_by' => $user['userId']);
                if( $this->Paymentmode_model->checkRecordExists($payment_mode) )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists.";
                }
                else
                {
                    $result = $this->Paymentmode_model->addNew($recordInfo);
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
                $recordInfo = array('payment_mode' => $payment_mode);

                $result = $this->Paymentmode_model->checkRecordExists1($payment_mode, $id);
                if( $result )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists";
                    $response["success_message"] = "";
                }
                else
                {
                    $result = $this->Paymentmode_model->updateRecord($recordInfo, $id);
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
        
        $data['record'] = $this->Paymentmode_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            $this->Paymentmode_model->deleteRecord($record_id);
            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>