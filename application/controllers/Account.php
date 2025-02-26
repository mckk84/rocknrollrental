<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Account';
		$data['user'] = $this->session->userdata();
		$this->load->model('customers_model');
		$data['record'] = $this->customers_model->getById($data['user']['userId']);

        $this->load->view('layout/header', $data);
        $this->load->view('front/account', $data);
        $this->load->view('layout/footer');
	}
}
