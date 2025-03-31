<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Account';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('customers_model');
		$this->load->model('bookings_model');
		$this->load->model('biketypes_model');

		$data['record'] = $this->customers_model->getById($data['user']['userId']);
		$data['rentals'] = $this->bookings_model->getByCustomerId($data['user']['userId'], 10);

		$biketypes = $this->biketypes_model->getAll();
		$data['biketypes'] = result_to_array($biketypes);

        $this->load->view('layout/header', $data);
        $this->load->view('front/account', $data);
        $this->load->view('layout/footer');
	}

	public function edit()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Edit Booking';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('customers_model');
		$this->load->model('bookings_model');
		$this->load->model('bookingbikes_model');
		$this->load->model('searchbike_model');
		$this->load->model('biketypes_model');

		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

		if( $id == 0 )
		{
			redirect('/Account');
		} 

		$data['record'] = $this->customers_model->getById($data['user']['userId']);
		$data['cart'] = $this->bookings_model->getById($id);

		if( $data['cart']['customer_id'] != $data['user']['userId'] )
		{
			redirect('/Account');
		}

		$data['cart']['order_cart_bikes'] = $this->bookingbikes_model->getByBookingId($id);
		$d1= new DateTime($data['cart']['dropoff_date']." ".$data['cart']['dropoff_time']); // first date
		$d2= new DateTime($data['cart']['pickup_date']." ".$data['cart']['pickup_time']); // second date
		$interval= $d1->diff($d2); // get difference between two dates
		$data['cart']['period_days'] = $interval->days;
		$data['cart']['period_hours'] = $interval->h; 

		$date=date_create($data['cart']['pickup_date']);
		$day = date_format($date,"D");
		if( $day == 'Fri' || $day == 'Sat' || $day == 'Sun' )
		{
			$data['cart']['weekend'] = 1;
		}
		else
		{
			$data['cart']['weekend'] = 0;
		}
		$res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['cart']['pickup_date']));
		if( $res )
		{
			$data['cart']['public_holiday'] = 1;
		}
		else
		{
			$data['cart']['public_holiday'] = 0;
		}

		/*echo "<pre>";
		print_r($data);
		die();*/
		$data['cart']['helmets_qty'] = $data['cart']['helmet_quantity'];

		$bike_ids = "";
		$order_bike_ids = [];
		foreach($data['cart']['order_cart_bikes'] as $i => $row)
		{
			$bike_ids .= ($bike_ids == "") ? $row['type_id']: ",".$row['type_id'];
			$found = 0;
			foreach($order_bike_ids as $i => $obj) 
			{
				if($obj->bike_id == $row['type_id'])
				{
					$found = 1;
					$obj->qty = $obj->qty + 1;
					$order_bike_ids[$i] = $obj;
				}
		    }
		    if( $found == 0 )
		    {
		    	$obj = new stdClass();
		    	$obj->bike_id = $row['type_id'];
		    	$obj->qty = 1;
		    	array_push($order_bike_ids, $obj);
		    }
		}


		$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_ids, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);
		
		foreach($data['cart']['cart_bikes'] as $i => $row)
		{
			foreach($data['cart']['order_cart_bikes'] as $orow)
			{
				if( $row['bike_type_id'] == $orow['type_id'] )
				{
					if( isset($data['cart']['cart_bikes'][$i]['quantity']) )
					{
						$data['cart']['cart_bikes'][$i]['quantity'] = $data['cart']['cart_bikes'][$i]['quantity'] + 1;
					} 
					else
					{
						$data['cart']['cart_bikes'][$i]['quantity'] = 1;
					}
				}
			}
		}
		$data['cart']['bike_ids'] = json_encode($order_bike_ids);

		if( $data['cart']['status'] != 0 )
		{
			redirect('/Account');
		}
		$this->session->set_userdata("order_cart", $data['cart']);

		$this->load->view('layout/header', $data);
        $this->load->view('front/edit_booking', $data);
        $this->load->view('layout/footer');
	}

	function addtoCart()
	{
		if( isset($_POST) && count($_POST) > 0 )
		{
			$bike_id_post = $this->input->post('bike_id');
			$this->load->model('searchbike_model');
			$session_cart = $this->session->userdata("order_cart");
			if( isset($session_cart['bike_ids']) && $session_cart['bike_ids'] != "" )
			{
				$old_bike_ids = json_decode($session_cart['bike_ids']);
				$bike_ids = array();
				$bike_id_string = "";
				foreach($old_bike_ids as $i => $obj) 
				{
					if( $obj->bike_id == $bike_id_post )
					{
						$q = $old_bike_ids[$i];
						$q->qty = $q->qty + 1;
						$bike_ids[$i] = $q;
						$bike_id_string = ($bike_id_string == "") ? $q->bike_id : ",".$q->bike_id;
					}
					else
					{
						$obj = new stdClass();
						$obj->bike_id = $bike_id_post;
						$obj->qty = 1;
						array_push($bike_ids, $obj);
						$bike_id_string = ($bike_id_string == "") ? $bike_id_post : ",".$bike_id_post;
					}
			    }
			}
			$data['cart'] = $session_cart;		

			$data['cart']['pickup_date'] = $this->input->post('pickup_date');
			$data['cart']['pickup_time'] = $this->input->post('pickup_time');
			$data['cart']['dropoff_date'] = $this->input->post('dropoff_date');
			$data['cart']['dropoff_time'] = $this->input->post('dropoff_time');
			$data['cart']['period_days'] = $this->input->post('period_days');
			$data['cart']['period_hours'] = $this->input->post('period_hours');
			$data['cart']['weekend'] =$this->input->post('weekend');
			$data['cart']['public_holiday'] = $this->input->post('public_holiday');

			if( $this->input->post('helmets_qty') != null ){
				$data['cart']['helmets_qty'] = $this->input->post('helmets_qty');
			}
			if( $this->input->post('free_helmet') != null ){
				$data['cart']['free_helmet'] = $this->input->post('free_helmet');
			}
			if( $this->input->post('coupon_code') != null ){
				$data['cart']['coupon_code'] = $this->input->post('coupon_code');
			}
			if( $this->input->post('early_pickup') != null ){
				$data['cart']['early_pickup'] =  $this->input->post('early_pickup');
			}
			if( isset($data['cart']['coupon_code']) && $data['cart']['coupon_code'] != "" ){
				$coupon = $this->coupons_model->getByCode($data['cart']['coupon_code']);
				$data['cart']['coupon_code'] = $coupon['code'];
				$data['cart']['coupon_type'] = $coupon['type'];
				$data['cart']['coupon_discount'] = $coupon['discount_amount']; 
			}else{
				$data['cart']['coupon_code'] = "";
				$data['cart']['coupon_type'] = "";
				$data['cart']['coupon_discount'] = 0; 
			}
			$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_id_string, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);
		
			foreach($data['cart']['cart_bikes'] as $i => $row)
			{
				foreach($data['cart']['order_cart_bikes'] as $orow)
				{
					if( $row['bike_type_id'] == $orow['type_id'] )
					{
						if( isset($data['cart']['cart_bikes'][$i]['quantity']) )
						{
							$data['cart']['cart_bikes'][$i]['quantity'] = $data['cart']['cart_bikes'][$i]['quantity'] + 1;
						} 
						else
						{
							$data['cart']['cart_bikes'][$i]['quantity'] = 1;
						}
					}
				}
			}
			
			$data['cart']['bike_ids'] = json_encode($bike_ids);
			$this->session->set_userdata("order_cart", $data['cart']);
		}
		$response = array("error" => 0, "error_message" => "", "success_message" => "Success");
		die(json_encode($response)); 
	}
}
