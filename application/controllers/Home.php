<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Unlimited Kilometers | Home';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('searchbike_model');

		$data['bikes'] = $this->searchbike_model->getBikesByType();

        $this->load->view('layout/header', $data);
        $this->load->view('front/home', $data);
        $this->load->view('layout/footer');
	}
}
