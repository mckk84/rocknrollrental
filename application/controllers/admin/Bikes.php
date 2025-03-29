<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bikes
 * Bikes class to manage bike CRUD.
 */
class Bikes extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bike_model');
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
            $data['page_title'] = "Bikes";
            $data['records'] = $this->bike_model->getAll();
            $data['biketypes'] = $this->biketypes_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/bikes', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function getRecord()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if( $id )
        {
            $record = $this->bike_model->getById($id);
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
        
        $type_id = $this->security->xss_clean($this->input->post('type_id'));     
        $this->form_validation->set_rules('type_id','Bike Type','trim|required|max_length[128]');
        $this->form_validation->set_rules('bikes','Bikes','trim|required|max_length[250]');
                
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        
        $user = $this->session->userdata();

        $type_id = $this->security->xss_clean($this->input->post('type_id'));
        $in_bikes = $this->security->xss_clean($this->input->post('bikes'));

        $bikes = explode(",", $in_bikes);
            
        if( count($bikes) == 0 )
        {
            $response["error"] = 1;
            $response["error_message"] = "No bikes added";
            die(json_encode($response));
        }

        foreach($bikes as $vehicle_number)
        {
            if( $this->bike_model->checkRecordExists($vehicle_number) )
            {
                $response["error"] = 1;
                $response["error_message"] = "Vehicle with vehicle_number ".$vehicle_number." already exists.";
                die(json_encode($response));
            }
        }

        foreach($bikes as $vehicle_number)
        {
            $recordInfo = array(
                'vehicle_number' => $vehicle_number, 
                'type_id' => $type_id,
                'created_by' => $user['userId']
            );

            $result = $this->bike_model->addNew($recordInfo);
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
        die(json_encode($response));        
    }

    public function deleteRecord()
    {
        $record_id = intval($this->uri->segment(4));
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $user = $this->session->userdata();

        if( $user['user_type'] !== "Admin" )
        {
            $response["error"] = 1;
            $response["error_message"] = "Your have no permission.";   
            die(json_encode($response));
        }

        
        if( $record_id == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Invalid Request";
            die(json_encode($response));
        }
        
        $data['record'] = $this->bike_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            $this->bike_model->deleteRecord($record_id);
            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>