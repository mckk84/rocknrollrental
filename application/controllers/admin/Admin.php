<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Admin (LoginController)
 * Admin class to control to authenticate user credentials and starts user's session.
 */
class Admin extends CI_Controller
{
     /**
     * Index Page for this controller.
     */
    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $data['page_title'] = 'Rock N Roll Bike Rentals | Admin';
	        $this->load->view('backend/login', $data);
        }
        else
        {
            redirect('admin/Dashboard');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $password = $this->input->post('password');
            $this->load->model('login_model');
            $result = $this->login_model->loginMe($username, $password);

            //pre($result); die;
            
            if (!empty($result))
            {
                $sessionArray = array( 'userId'=>$result->userId,
                                        'name'=>$result->name,
                                        'isAdmin'=>$result->isAdmin,
                                        'isLoggedIn' => TRUE
                                );

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['userId'], $sessionArray['isLoggedIn']);

                $loginInfo = array("userId"=>$result->userId, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());
                
                redirect('admin/Dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'username or password incorrect');
                redirect('admin');
            }
        }
    }

 }

?>
  