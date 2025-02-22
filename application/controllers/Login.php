<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Unlimited Kilometers | Login';
        $this->load->view('layout/header', $data);
        $this->load->view('front/login', $data);
        $this->load->view('layout/footer');
	}
}
