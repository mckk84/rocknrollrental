<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Cart';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$data['cart_bikes'] = array();
		$data['cart'] = array();

		if( isset($_POST) && count($_POST) > 0 )
		{
			$data['cart']['bike_ids'] = $this->input->post('bike_ids');
			$data['cart']['pickup_date'] = $this->input->post('pickup_date');
			$data['cart']['pickup_time'] = $this->input->post('pickup_time');
			$data['cart']['dropoff_date'] = $this->input->post('dropoff_date');
			$data['cart']['dropoff_time'] = $this->input->post('dropoff_time');
			$data['cart']['period_days'] = $this->input->post('period_days');
			$data['cart']['period_hours'] = $this->input->post('period_hours');
			$data['cart']['weekend'] =$this->input->post('weekend');
			$data['cart']['public_holiday'] = $this->input->post('public_holiday');
			$data['cart']['bike_type'] = $this->input->post('bike_type');
		}
		else
		{
			$data['cart'] = $this->session->userdata("cart");
		}

		if( isset($data['cart']['bike_ids']) )
		{
			$d1= new DateTime($data['cart']['dropoff_date']." ".$data['cart']['dropoff_time']); // first date
			$d2= new DateTime($data['cart']['pickup_date']." ".$data['cart']['pickup_time']); // second date
			$interval= $d1->diff($d2); // get difference between two dates
			$data['cart']['period_days'] = $interval->days;
			$data['cart']['period_hours'] = $interval->h; 

			$date=date_create($data['cart']['pickup_date']);
			$day = date_format($date,"D");
			if( $day == 'Sat' || $day == 'Sun' )
			{
				$data['cart']['weekend'] = 1;
			}
			$res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['cart']['pickup_date']));
			if( $res )
			{
				$data['cart']['public_holiday'] = 1;
			}

			$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($data['cart']['bike_ids'], $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

			$this->session->set_userdata("cart", $data['cart']);
		}

        $this->load->view('layout/header', $data);
        $this->load->view('front/cart', $data);
        $this->load->view('layout/footer');
	}
}
