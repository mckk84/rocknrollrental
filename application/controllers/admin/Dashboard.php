<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 */
class Dashboard extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bookings_model');
        $this->load->model('biketypes_model');
        $this->load->model('customers_model');
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
            $data['page_title'] = "Dashboard";
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            $data['records'] = $this->bookings_model->getAll("0", 5);
            $data['returns'] = $this->bookings_model->getAllReturnsToday();
            $data['late_pickups'] = $this->bookings_model->getAllPickupsToday();

            $data['today_pickups'] = $this->bookings_model->getAllPickups(date("Y-m-d"));
            $data['today_dropoffs'] = $this->bookings_model->getAllDropoffs(date("Y-m-d"));

            
            $data['today_bookings'] = $this->bookings_model->getAllByCreatedDate(date("Y-m-d"));
            $data['week_bookings'] = $this->bookings_model->getAllByCreatedDateBetween(rangeWeek(date("Y-m-d")));
            $data['month_bookings'] = $this->bookings_model->getAllByCreatedDateBetween(rangeMonth(date("Y-m-d")));

            $data['today_customers'] = $this->customers_model->getAllByCreatedDate(date("Y-m-d"));
            $data['week_customers'] = $this->customers_model->getAllByCreatedDateBetween(rangeWeek(date("Y-m-d")));
            $data['month_customers'] = $this->customers_model->getAllByCreatedDateBetween(rangeMonth(date("Y-m-d")));

            $data['last_update'] = date("Y-m-d H:i:s");

            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/dashboard', $data);
            $this->load->view('layout_admin/footer');
        }
    }
    
}

?>