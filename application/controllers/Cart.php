<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Cart';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$this->load->model('coupons_model');
		$data['cart_bikes'] = array();
		$data['cart'] = array();
		$data['cart']['weekend'] = 0;
		$data['cart']['public_holiday'] = 0;

		$session_cart = $this->session->userdata("cart");
		$session_order = $this->session->userdata("order");
		$data['order'] = $session_order;

		if( isset($session_cart['bike_ids']) && $session_cart['bike_ids'] != "" )
		{
			$bike_ids = json_decode($session_cart['bike_ids']);
			$data['cart'] = $session_cart;
		}

		if( isset($bike_ids) && is_array($bike_ids) && count($bike_ids) > 0 )
		{
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

			$bike_id_string = "";
			foreach($bike_ids as $i => $obj) 
			{
		        $bike_id_string .= ($bike_id_string == "") ? $obj->bike_id: ",".$obj->bike_id;
		    }

			$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_id_string, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

			if( isset($session_order) && count($session_order) > 0 )
			{
				foreach($data['cart']['cart_bikes'] as $i => $row)
				{
					foreach($session_order['order']['order_cart_bikes'] as $orow)
					{
						if( $row['bike_type_id'] == $orow['type_id'] )
						{
							$row['bikes_available'] = $row['bikes_available'] + $orow['bikes_qty'];
							$data['cart']['cart_bikes'][$i] = $row;
						}
					}
				}
			}

			foreach($data['cart']['cart_bikes'] as $index => $bike)
			{
				foreach($bike_ids as $i => $obj) 
				{
					if($obj->bike_id == $bike['bike_type_id'])
					{
						if( $bike['bikes_available'] > $obj->qty ){

							$bike['quantity'] = $obj->qty;
						} else{
							$bike['quantity'] = $bike['bikes_available'];
						}
						break;
					}
			    }					
			    $data['cart']['cart_bikes'][$index] = $bike;
			}

			$data['cart']['helmets_qty'] = (isset($data['cart']['helmets_qty']) && $data['cart']['helmets_qty'] != "") ? $data['cart']['helmets_qty'] : 0;
			$data['cart']['coupon_code'] =  (isset($data['cart']['coupon_code']) && $data['cart']['coupon_code'] != "") ? $data['cart']['coupon_code'] : "";
			$data['cart']['early_pickup'] =  (isset($data['cart']['early_pickup']) && $data['cart']['early_pickup'] != "") ? $data['cart']['early_pickup'] : 0;
			$data['cart']['free_helmet'] =  (isset($data['cart']['free_helmet']) && $data['cart']['free_helmet'] != "") ? $data['cart']['free_helmet'] : 0;

			$this->session->set_userdata("cart", $data['cart']);
		}
		else
		{
			$this->session->set_userdata("cart", array());
			$this->session->set_userdata("order", array());
		}

        $this->load->view('layout/header', $data);
        $this->load->view('front/cart', $data);
        $this->load->view('layout/footer');
	}

	public function cancel()
	{
		$this->session->set_userdata("cart", array());
		$this->session->set_userdata("order", array());
		redirect('/Cart');
	}

	public function addtoCart()
	{
		if( isset($_POST) && count($_POST) > 0 )
		{
			$cartform = $this->input->post('cartform');
			$this->load->model('coupons_model');
			if( isset($cartform) && $cartform == 1 )
			{
				// submitted from cart
				// overrides bike ids
				$bike_id_post = $this->input->post('bike_ids');
				$bike_ids = json_decode($bike_id_post); 
			}
			else
			{
				$bike_id_post = $this->input->post('bike_ids');
				$bike_ids = json_decode($bike_id_post); 
				
				$session_cart = $this->session->userdata("cart");
				if( isset($session_cart['bike_ids']) && $session_cart['bike_ids'] != "" )
				{
					$old_bike_ids = json_decode($session_cart['bike_ids']);
					$new_bike_ids = array_merge($bike_ids, $old_bike_ids);
					$bike_ids = array();
					$unique_ids = array();
					foreach($new_bike_ids as $i => $obj) 
					{
						if( in_array($obj->bike_id, $unique_ids) )
						{
							$q = $new_bike_ids[$i];
							foreach($bike_ids as $j => $jjo)
							{
								if( $jjo->bike_id == $q->bike_id )
								{
									$q->qty = 1;
									$bike_ids[$j] = $q;
								}
							}
							$unique_ids[] = $q->bike_id;
						}
						else
						{
							$bike_ids[$i] = $obj;
							$unique_ids[] = $obj->bike_id;
						}
				    }
				}
				$data['cart'] = $session_cart;
			}			

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
			
			$data['cart']['bike_ids'] = json_encode($bike_ids);
			$this->session->set_userdata("cart", $data['cart']);
		}
		if ( $this->input->is_ajax_request() ) 
		{
			$response = array("error" => 0, "error_message" => "", "success_message" => "Success");
			die(json_encode($response)); 
		}
		else
		{
			redirect('/Cart');
		}
	}

	public function instant()
	{
		if( isset($_POST) && count($_POST) > 0 )
		{
			$bike_type_id = $this->input->post('bike_type_id');
			$bike_qty = $this->input->post('bikeqty');
				
			$bike_ids = [];
			$obj = new stdClass();
			$obj->bike_id = $bike_type_id;
			$obj->qty = $bike_qty;

			$bike_ids[0] = $obj;
			$data['cart']['pickup_date'] = $this->input->post('pickupdate');
			$data['cart']['pickup_time'] = $this->input->post('pickuptime');
			$data['cart']['dropoff_date'] = $this->input->post('dropoffdate');
			$data['cart']['dropoff_time'] = $this->input->post('dropofftime');
			
			if( $this->input->post('helmets_qty') != null ){
				$data['cart']['helmets_qty'] = $this->input->post('helmets_qty');
			}
			if( $this->input->post('free_helmet') != null ){
				$data['cart']['free_helmet'] = $this->input->post('free_helmet');
			}
			if( $this->input->post('early_pickup') != null ){
				$data['cart']['early_pickup'] =  $this->input->post('early_pickup');
			}

			$data['cart']['coupon_code'] = "";
			$data['cart']['coupon_type'] = "";
			$data['cart']['coupon_discount'] = 0; 
						
			$data['cart']['bike_ids'] = json_encode($bike_ids);
			$this->session->set_userdata("cart", $data['cart']);
			redirect('/Cart');
		}

	}

	public function bike_availability()
	{
		$response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
		if ($this->input->is_ajax_request()) 
		{
            if ($this->input->method(TRUE) == "POST") 
            {
            	if( isset($_POST) && count($_POST) > 0 )
				{
					$this->load->model('searchbike_model');
					$this->load->model('publicholidays_model');

					$data['bike_ids'] = $this->input->post('bikeId');
					$data['bikeqty'] = $this->input->post('bikeqty');
					$data['pickup_date'] = $this->input->post('pickup_date');
					$data['pickup_time'] = $this->input->post('pickup_time');
					$data['dropoff_date'] = $this->input->post('dropoff_date');
					$data['dropoff_time'] = $this->input->post('dropoff_time');

					$d1= new DateTime($data['dropoff_date']." ".$data['dropoff_time']); // first date
					$d2= new DateTime($data['pickup_date']." ".$data['pickup_time']); // second date
					$interval= $d1->diff($d2); // get difference between two dates
					$data['period_days'] = $interval->days;
					$data['period_hours'] = $interval->h; 

					if( $interval->days == 0 && $data['period_hours'] <= 0 )
					{
						$response = array('error' => 1, 'error_message' => 'Invalid dates');
						die(json_encode($response));
					}

					$data['weekend'] = 0;
					$data['public_holiday'] = 0;
					$date=date_create($data['pickup_date']);
					$day = date_format($date,"D");
					if( $day == 'Sat' || $day == 'Sun' )
					{
						$data['weekend'] = 1;
					}
					$res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['pickup_date']));
					if( $res )
					{
						$data['public_holiday'] = 1;
					}

					$data['bike_availability'] = 0;
					$data['cart_bikes'] = $this->searchbike_model->getCartBikes($data['bike_ids'], $data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);

					foreach($data['cart_bikes'] as $index => $bike)
					{
						if($data['bike_ids'] == $bike['bike_type_id'])
						{
							$bike['quantity'] = $bike['bikes_available'];
							$data['bike_availability'] = $bike['bikes_available'];
							$data['rent_price'] = $bike['rent_price'];
							$data['available_from'] = isset($bike['available_from']) ? getAvailableDate($bike['available_from']) : "";
							break;
						}					
					    $data['cart_bikes'][$index] = $bike;
					}

					$response["data"] = $data;
					$response["error"] = 0;
					$response["success_message"] = ( $data['bike_availability'] > 0 ) ? "Availabile" : "Not Availabile";
					die(json_encode($response)); 					
				}
            }
        }
        die(json_encode($response));
	}

	public function search()
	{
		$response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('biketypes_model');
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		
		$data['pickup_date'] = "";
		$data['pickup_time'] = "";
		$data['dropoff_date'] = "";
		$data['dropoff_time'] = "";
		$data['period_days'] = "";
		$data['period_hours'] = "";
		$data['weekend'] = 0;
		$data['public_holiday'] = 0;
		
		if( isset($_POST) && count($_POST) > 0 )
		{
			$data['pickup_date'] = $this->input->post('pickup_date');
			$data['pickup_time'] = $this->input->post('pickup_time');
			$data['dropoff_date'] = $this->input->post('dropoff_date');
			$data['dropoff_time'] = $this->input->post('dropoff_time');		
		
			$d1= new DateTime($data['dropoff_date']." ".$data['dropoff_time']); // first date
			$d2= new DateTime($data['pickup_date']." ".$data['pickup_time']); // second date
			$interval= $d1->diff($d2); // get difference between two dates
			$data['period_days'] = $interval->days;
			$data['period_hours'] = $interval->h; 

			$date=date_create($data['pickup_date']);
			$day = date_format($date,"D");
			if( $day == 'Fri' || $day == 'Sat' || $day == 'Sun' )
			{
				$data['weekend'] = 1;
			}
			$res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['pickup_date']));
			if( $res )
			{
				$data['public_holiday'] = 1;
			}

			if( $data['period_days'] > 0 || $data['period_hours'] > 0 )
			{
				$data['available_bikes'] = $this->searchbike_model->getAvailableBikes($data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);
			}
			else
			{
				$data['available_bikes'] = array();
			}

			$response["data"] = $data;
			$response["error"] = 0;
			$response["success_message"] = "Success";
			$response["error_message"] = "";
			die(json_encode($response)); 	
		}
		else{
			$response["error"] = 1;
			$response["error_message"] = "Invalid Request";
			die(json_encode($response));
		}
			
	}

}
