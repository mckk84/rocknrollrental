<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tariff extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Unlimited Kilometers | Tariff';
		$data['user'] = $this->session->userdata("Auth");

		$this->load->model('searchbike_model');

		$data['bikes'] = $this->searchbike_model->getBikesByType();
		$data['reviews'] = get_google_reviews();

        $this->load->view('layout/header', $data);
        $this->load->view('front/tariff', $data);
        $this->load->view('layout/footer');
	}
}
