<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Cart';
		$data['user'] = $this->session->userdata();
        $this->load->view('layout/header', $data);
        $this->load->view('front/cart', $data);
        $this->load->view('layout/footer');
	}
}
