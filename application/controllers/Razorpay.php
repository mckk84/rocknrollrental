<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razorpay extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Razorpay';
		$data['user'] = $this->session->userdata("Auth");
		
		$data['key'] = "rzp_live_rEjfPN1L1yys2O";
		$data['order_id'] = 123; 
		$data['amount'] = 100;
		$data['name'] = $data['user']['name'];
		$data['image'] = "";
		$data['description'] = "Rentals";
		$data['prefill']['name'] = $data['user']['name'];
		$data['prefill']['email'] = $data['user']['email'];
		$data['prefill']['contact'] = $data['user']['phone'];
		$data['display_amount'] = '100';
		$data['display_currency'] = 'INR';

        $this->load->view('layout/header', $data);
        $this->load->view('front/razorpay', $data);
        $this->load->view('layout/footer');
	}

	public function callback()
	{
		print_r($_POST);
		die();
	}

}
