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

            $data['manufacturers'] = $this->manufacturer_model->getAll();
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
        $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('number','Number','trim|required|max_length[128]');
        $this->form_validation->set_rules('manufacturer_id','Manufacturer','trim|required');
        $this->form_validation->set_rules('type_id','Bike Type','trim|required');
        $this->form_validation->set_rules('cc','CC','trim|required|max_length[10]');
        $this->form_validation->set_rules('color','Color','trim|required|max_length[25]');
        $this->form_validation->set_rules('model','Model','trim|required|max_length[25]');
        $this->form_validation->set_rules('milage','Milage','trim|required|max_length[50]');
        $this->form_validation->set_rules('weight','Weight','trim|required|max_length[50]');
        $this->form_validation->set_rules('power','Power','trim|required|max_length[50]');
                
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }

        $image = "";
        $image_type = "";
        $target_file = $_SERVER['DOCUMENT_ROOT']."/bikes/";

        $bike_image = $_FILES['image']; // Get the uploaded file
        if ( $bike_image && $bike_image['name']) 
        {
            $image = trim($bike_image['name']);
            $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
            
            $new_image_name = ucwords(strtolower($this->security->xss_clean(trim($this->input->post('heading')))));
            $new_image_name = preg_replace('/\s+/', '', $new_image_name);
            $new_image_name = preg_replace('/[^a-z\d ]/i', '', $new_image_name);
            $new_image_name = $new_image_name.".".$imageFileType;
            $target_file = $target_file.$new_image_name;
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) 
            {
                $response["error"] = 1;
                $response["error_message"] = "Image format invalid. Upload jpg/jpeg/png.";
                die(json_encode($response));
            }
            
            // Check file size
            if ( $bike_image["size"] > 2000000 || $bike_image["error"] == 1) 
            {
                $response["error"] = 1;
                $response["error_message"] = "Image size too large. Upload size less than 2MB.";
                die(json_encode($response));
            }
            
            if( file_exists($target_file) )
            {
                $response["error"] = 1;
                $response["error_message"] = "Image already exists";
                die(json_encode($response));
            }
            
            // upload file
            if (move_uploaded_file($bike_image["tmp_name"], $target_file)) 
            {
                // upload suuccess 
                $image = $new_image_name;
            } else {
                $response["error"] = 1;
                $response["error_message"] = "Image upload failed";
                die(json_encode($response));
            }
        } 
        else 
        {
            $response["error"] = 1;
            $response["error_message"] = "Please upload Image";
            die(json_encode($response));
        }
        
        $user = $this->session->userdata();
        $id = $this->security->xss_clean($this->input->post('record_id'));
        $name = $this->security->xss_clean($this->input->post('name'));
        $vehicle_number = $this->security->xss_clean($this->input->post('number'));
        $manufacturer_id = $this->security->xss_clean($this->input->post('manufacturer_id'));
        $type_id = $this->security->xss_clean($this->input->post('type_id'));
        $cc = $this->security->xss_clean($this->input->post('cc'));
        $color = $this->security->xss_clean($this->input->post('color'));
        $model = $this->security->xss_clean($this->input->post('model'));
        $milage = $this->security->xss_clean($this->input->post('milage'));
        $weight = $this->security->xss_clean($this->input->post('weight'));
        $power = $this->security->xss_clean($this->input->post('power'));
        
        $recordInfo = array(
                'name' => $name,
                'vehicle_number' => $vehicle_number, 
                'manufacturer_id' => $manufacturer_id,
                'type_id' => $type_id,
                'cc' => $cc,
                'color' => $color,
                'model' => $model,
                'milage' => $milage,
                'power' => $power,
                'created_by' => $user['userId']
            );

        if( $id == "" )
        {
            if( $this->bike_model->checkRecordExists($name) )
            {
                $response["error"] = 1;
                $response["error_message"] = "Record already exists.";
            }
            else
            {
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
        }
        else
        {
            $result = $this->bike_model->checkRecordExists1($name, $id);
            if( $result )
            {
                $response["error"] = 1;
                $response["error_message"] = "Record already exists";
                $response["success_message"] = "";
            }
            else
            {
                $result = $this->bike_model->updateRecord($recordInfo, $id);
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