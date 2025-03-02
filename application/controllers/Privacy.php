<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Privacy Policy';
		$data['user'] = $this->session->userdata("Auth");
        $this->load->view('layout/header', $data);
        $this->load->view('front/privacy', $data);
        $this->load->view('layout/footer');
	}
}
