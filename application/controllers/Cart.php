<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Cart';
		$data['user'] = $this->session->userdata();
		$this->load->model('searchbike_model');

		if( isset($_POST) && count($_POST) > 0 )
		{
			$data['bike_ids'] = $this->input->post('bike_ids');
			$data['pickup_date'] = $this->input->post('pickup_date');
			$data['pickup_time'] = $this->input->post('pickup_time');
			$data['dropoff_date'] = $this->input->post('dropoff_date');
			$data['dropoff_time'] = $this->input->post('dropoff_time');

			$data['cart_bikes'] = $this->searchbike_model->getCartBikes($data['bike_ids'], $data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);
		}

        $this->load->view('layout/header', $data);
        $this->load->view('front/cart', $data);
        $this->load->view('layout/footer');
	}
}
