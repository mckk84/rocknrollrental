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
			$bike_ids = json_decode($data['cart']['bike_ids']);
			$data['cart']['pickup_date'] = $this->input->post('pickup_date');
			$data['cart']['pickup_time'] = $this->input->post('pickup_time');
			$data['cart']['dropoff_date'] = $this->input->post('dropoff_date');
			$data['cart']['dropoff_time'] = $this->input->post('dropoff_time');
			$data['cart']['period_days'] = $this->input->post('period_days');
			$data['cart']['period_hours'] = $this->input->post('period_hours');
			$data['cart']['weekend'] =$this->input->post('weekend');
			$data['cart']['public_holiday'] = $this->input->post('public_holiday');
			$data['cart']['helmets_qty'] = $this->input->post('helmets_qty');
			$data['cart']['coupon_code'] =  $this->input->post('coupon_code');
		}
		else
		{ 
			$data['cart'] = $this->session->userdata("cart");
			if( isset($data['cart']['bike_ids']) && $data['cart']['bike_ids'] != "" )
			{
				$bike_ids = json_decode($data['cart']['bike_ids']);
			}
		}

		if( isset($bike_ids) && count($bike_ids) > 0 )
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

			$bike_id_string = "";
			foreach($bike_ids as $i => $obj) 
			{
		        $bike_id_string .= ($bike_id_string == "") ? $obj->bike_id: ",".$obj->bike_id;
		    }

			$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_id_string, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

			foreach($data['cart']['cart_bikes'] as $index => $bike)
			{
				foreach($bike_ids as $i => $obj) 
				{
					if($obj->bike_id == $bike['bike_type_id'])
					{
						$bike['quantity'] = $obj->qty;
						break;
					}
			    }					
			    $data['cart']['cart_bikes'][$index] = $bike;
			}
			$this->session->set_userdata("cart", $data['cart']);
		}

        $this->load->view('layout/header', $data);
        $this->load->view('front/cart', $data);
        $this->load->view('layout/footer');
	}
}
