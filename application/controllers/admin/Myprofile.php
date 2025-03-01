<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Contact
 * Contact class to manage Contact messages data
 */
class Myprofile extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

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
            $data['page_title'] = "Myprofile";
            $data['record'] = $this->users_model->getById($data['user']['userId']);
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/myprofile', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function changepassword()
    {
        $response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
        if ($this->input->is_ajax_request()) 
        {
            if ($this->input->method(TRUE) == "POST") 
            {
                $this->load->library('form_validation');   

                $this->form_validation->set_rules('current_password','Current Password','trim|required|min_length[5]|max_length[10]');
                $this->form_validation->set_rules('new_password','New Password','trim|required|min_length[5]|max_length[10]');
                $this->form_validation->set_rules('retype_password','Retype Password','trim|required|min_length[5]|max_length[10]');

                $current_password = $this->security->xss_clean($this->input->post('current_password'));
                $new_password = $this->security->xss_clean($this->input->post('new_password'));
                $retype_password = $this->security->xss_clean($this->input->post('retype_password'));

                if($this->form_validation->run() == FALSE)
                {
                    $response["error"] = 1;
                    $response["error_message"] = $this->form_validation->error_string();
                    die(json_encode($response));
                }
                /*if(!preg_match('/^(?=.*\d)[0-9A-Za-z_!@#$%]{5,}$/', $new_password)) 
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Password contains invalid characters.";
                    die(json_encode($response));
                }*/

                if( $new_password != $retype_password)
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Passwords did not match.";
                    die(json_encode($response));
                }

                $user = $this->session->userdata();
                $record = $this->users_model->getById($user['userId']);
            
                if(!verifyHashedPassword($current_password, $record['password']))
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Current password is incorrect.";
                    die(json_encode($response));
                }

                $result = $this->users_model->createPasswordUser($user['userId'], $new_password);
                if( $result )
                {
                    $response["error"] = 0;
                    $response["error_message"] = "";
                    $response["success_message"] = "Password update successful";
                } 
                else 
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Password update failed.";
                }
            }
        }
        die(json_encode($response));  
    }

    
}

?>