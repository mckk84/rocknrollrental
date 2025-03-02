<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Checkout';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$data['cart_bikes'] = array();

		$data['cart'] = $this->session->userdata("cart");
		$data['cart']['paymentOption'] = "PAY_FULL";

		if( isset($_POST) && count($_POST) > 0 )
		{
			$data['cart']['paymentOption'] = $this->input->post('paymentOption');
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

			$this->session->set_userdata("cart", $data["cart"]);
		}

        $this->load->view('layout/header', $data);
        $this->load->view('front/checkout', $data);
        $this->load->view('layout/footer');
	}
}
