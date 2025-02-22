<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 */
class Logout extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $sessionArray = array('userId' => 0, 'isLoggedIn' => 0);
        $this->session->set_userdata($sessionArray);
        
        unset($sessionArray['userId'], $sessionArray['isLoggedIn']);
        
        $this->session->set_flashdata('success', 'Logged Out');
        redirect('admin');
    }
}

?>