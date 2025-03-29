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
        $this->load->model('manufacturer_model');
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
            $data['manufacturers'] = $this->manufacturer_model->getAll();
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

    public function getImage()
    {
        $id = isset($_GET['type_id']) ? $_GET['type_id'] : 0;
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
        $id = $this->security->xss_clean($this->input->post('record_id'));     
        $this->form_validation->set_rules('type','Type','trim|required|max_length[128]');
        $this->form_validation->set_rules('description','Description','trim|required|max_length[128]');
        $this->form_validation->set_rules('manufacturer_id','Manufacturer','trim|required');
        $this->form_validation->set_rules('cc','CC','trim|required|max_length[10]');
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
        $target_folder = BIKE_UPLOAD_PATH;

        $bike_image = $_FILES['image']; // Get the uploaded file
        if ( $bike_image && $bike_image['name']) 
        {
            $image = trim($bike_image['name']);
            $imageFileType = strtolower(pathinfo($image,PATHINFO_EXTENSION));
            
            $result = getNewImage($target_folder, $this->security->xss_clean(trim($this->input->post('name'))), $imageFileType);
            $new_image_name = $result[0];
            $target_file = $result[1];
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
            if( $id == "" )
            {
                $response["error"] = 1;
                $response["error_message"] = "Please upload Image";
                die(json_encode($response));
            }
            else
            {
                $bikerecord = $this->biketypes_model->getById($id);
                $image = $bikerecord['image'];
            }
        }
        
        $user = $this->session->userdata();
        $id = $this->security->xss_clean($this->input->post('record_id'));
        $type = $this->security->xss_clean($this->input->post('type'));
        $description = $this->security->xss_clean($this->input->post('description'));
        $manufacturer_id = $this->security->xss_clean($this->input->post('manufacturer_id'));
        $cc = $this->security->xss_clean($this->input->post('cc'));
        $milage = $this->security->xss_clean($this->input->post('milage'));
        $weight = $this->security->xss_clean($this->input->post('weight'));
        $power = $this->security->xss_clean($this->input->post('power'));
        
        $recordInfo = array(
                'type' => $type,
                'description' => $description,
                'manufacturer_id' => $manufacturer_id,
                'cc' => $cc,
                'milage' => $milage,
                'weight' => $weight,
                'power' => $power,
                'image' => $image,
                'created_by' => $user['userId']
            );

        if( $id == "" )
        {
            if( $this->biketypes_model->checkRecordExists($type, $vehicle_number) )
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
            $result = $this->biketypes_model->checkRecordExists1($type,$id);
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