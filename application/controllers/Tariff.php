<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tariff extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Unlimited Kilometers | Tariff';
		$data['user'] = $this->session->userdata();
        $this->load->view('layout/header', $data);
        $this->load->view('front/tariff', $data);
        $this->load->view('layout/footer');
	}
}
