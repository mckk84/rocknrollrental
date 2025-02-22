<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Admin';
        $this->load->view('layout_admin/header', $data);
        $this->load->view('backend/home', $data);
        $this->load->view('layout_admin/footer');
	}
}
