<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Unlimited Kilometers | About';
		$data['user'] = $this->session->userdata("Auth");
        $this->load->view('layout/header', $data);
        $this->load->view('front/about', $data);
        $this->load->view('layout/footer');
	}
}
