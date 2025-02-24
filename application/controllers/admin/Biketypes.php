<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 */
class Biketypes extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
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
            $data['page_title'] = "Bike Types";
            $data['records'] = $this->biketypes_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/biketypes', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function getRecord()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if( $id )
        {
            $record = $this->biketypes_model->getById($id);
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
        $this->form_validation->set_rules('type','Type','trim|required|max_length[25]');
                
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
            $type = $this->security->xss_clean($this->input->post('type'));

            if( $id == "" )
            {
                $recordInfo = array('type' => $type, 'created_by' => $user['userId']);
                if( $this->biketypes_model->checkRecordExists($type) )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists.";
                }
                else
                {
                    $result = $this->biketypes_model->addNew($recordInfo);
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
                $recordInfo = array('type' => $type);

                $result = $this->biketypes_model->checkRecordExists1($type, $id);
                if( $result )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Record already exists";
                    $response["success_message"] = "";
                }
                else
                {
                    $result = $this->biketypes_model->updateRecord($recordInfo, $id);
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
        
        $data['record'] = $this->biketypes_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            $this->biketypes_model->deleteRecord($record_id);
            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>