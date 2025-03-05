<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Returns
 * Returns class to control to manage Returns data
 */
class Returns extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bookings_model');
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
            $data['page_title'] = "Returns";
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            $data['records'] = $this->bookings_model->getAllReturnsToday();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/bookings', $data);
            $this->load->view('layout_admin/footer');
        }
    }    
    
}

?>