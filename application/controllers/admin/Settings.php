<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Settings
 * Settings class to manage Settings.
 */
class Settings extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
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
            $data['page_title'] = "Settings";
            $data['records'] = $this->settings_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/settings', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function update()
    {
        $user = $this->session->userdata();
        $id = $this->security->xss_clean($this->input->post('id'));

        if( $id == "" )
        {
            $this->session->set_flashdata("error", "Invalid Record");   
        }
        else
        {
            $recordInfo = $_POST;
            $result = $this->settings_model->updateRecord($recordInfo, $id);
            if($result > 0)
            {
                $this->session->set_flashdata("success", "Record updated successfully");
            } 
            else 
            {
                $this->session->set_flashdata("error", "Record updated failed");
            }                
        } 
        redirect('admin/Settings');           
    }

}

?>