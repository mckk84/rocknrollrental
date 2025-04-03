<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Reports
 * Reports class to control to manage Reports data
 */
class Reports extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bike_model');
        $this->load->model('bookings_model');
        $this->load->model('biketypes_model');
        $this->load->model('bookingbikes_model');
        $this->load->model('bookingpayment_model');
        $this->load->model('paymentmode_model');
        $this->load->model('holidays_model');
        $this->load->model('publicholidays_model');
        $this->load->model('searchbike_model');
        $this->load->model('customers_model');
        $this->load->model('users_model');
        $this->load->model('orderhistory_model');
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
            $data['page_title'] = "Reports";

            
                        
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/reports', $data);
            $this->load->view('layout_admin/footer');
        }
    }
    
}

?>