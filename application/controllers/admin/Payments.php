<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Payments
 * Payments class to control to manage Payments data
 */
class Payments extends CI_Controller
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
            $data['page_title'] = "Payments";
            $data['records'] = $this->bookingpayment_model->getAll();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/payments', $data);
            $this->load->view('layout_admin/footer');
        }
    }    
    
}

?>