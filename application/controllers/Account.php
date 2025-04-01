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

	public function order_cart()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Edit Order';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$this->load->model('coupons_model');
		$this->load->model('bookingbikes_model');
		$data['cart_bikes'] = array();
		$data['cart'] = array();
		$data['cart']['weekend'] = 0;
		$data['cart']['public_holiday'] = 0;

		$session_cart = $this->session->userdata("order_cart");

		$data['cart']['booking_id'] = $session_cart['booking_id'];
		$data['cart']['order_cart_bikes'] = $this->bookingbikes_model->getByBookingId($session_cart['booking_id']);

		$bike_id_array = array();
		$bike_qty_array = array();
		foreach($data['cart']['order_cart_bikes'] as $i => $row)
		{
			if( in_array($row['type_id'], $bike_id_array) )
			{
				$bike_qty_array[ $row['type_id'] ] = $bike_qty_array[ $row['type_id'] ] + 1;
			}
		    else
		    {
		    	$bike_id_array[] = $row['type_id'];
		    	$bike_qty_array[ $row['type_id'] ] = 1;
		    }
		}

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

			foreach($data['cart']['cart_bikes'] as $index => $bike)
			{
				foreach($bike_ids as $i => $obj) 
				{
					if($obj->bike_id == $bike['bike_type_id'])
					{
						if( in_array($obj->bike_id, $bike_id_array ))
						{
							$bike['bikes_available'] = $bike['bikes_available'] + $bike_qty_array[$obj->bike_id];
						}
						if( $bike['bikes_available'] > $obj->qty ){

							$bike['quantity'] = $obj->qty;
						} 
						else
						{
							$bike['quantity'] = $bike['bikes_available'];
						}
						break;
					}
			    }					
			    $data['cart']['cart_bikes'][$index] = $bike;
			}

			$data['cart']['bike_ids'] = json_encode($bike_ids);
			$data['cart']['helmets_qty'] = (isset($data['cart']['helmets_qty']) && $data['cart']['helmets_qty'] != "") ? $data['cart']['helmets_qty'] : 0;
			$data['cart']['coupon_code'] =  (isset($data['cart']['coupon_code']) && $data['cart']['coupon_code'] != "") ? $data['cart']['coupon_code'] : "";
			$data['cart']['early_pickup'] =  (isset($data['cart']['early_pickup']) && $data['cart']['early_pickup'] != "") ? $data['cart']['early_pickup'] : 0;
			$data['cart']['free_helmet'] =  (isset($data['cart']['free_helmet']) && $data['cart']['free_helmet'] != "") ? $data['cart']['free_helmet'] : 0;

		}
		$this->session->set_userdata("order_cart", $data['cart']);

        $this->load->view('layout/header', $data);
        $this->load->view('front/account_cart', $data);
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

		$data['order'] = $this->bookings_model->getById($id);
		$data['order']['customer'] = $this->customers_model->getById($data['user']['userId']);
		if( $data['order']['customer_id'] != $data['user']['userId'] )
		{
			redirect('/Account');
		}
		$data['order']['booking_id'] = $id;
		$data['order']['order_cart_bikes'] = $this->bookingbikes_model->getByBookingIdGroup($id);

		$this->session->set_userdata('order', $data);

		$data['cart'] = $data['order'];

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
					$data['cart']['cart_bikes'][$i]['quantity'] = $orow['bikes_qty'];
				}
			}
		}
		$data['cart']['bike_ids'] = json_encode($order_bike_ids);

		$this->session->set_userdata("cart", $data['cart']);

		redirect('/Cart');
	}

	public function addtoCart()
	{
		if( isset($_POST) && count($_POST) > 0 )
		{
			$bike_id_post = $this->input->post('bike_ids');
			$qty = $this->input->post('qty');
			$this->load->model('searchbike_model');
			$session_cart = $this->session->userdata("order_cart");
			
			$bike_id_string = "";
			if( isset($session_cart['bike_ids']) && $session_cart['bike_ids'] != "" )
			{
				$old_bike_ids = json_decode($session_cart['bike_ids']);
				if( count($old_bike_ids) == 0 )
				{
					$obj = new stdClass();
					$obj->bike_id = $bike_id_post;
					$obj->qty = $qty;
					$old_bike_ids[] = $obj;
				}
				else
				{
					foreach($old_bike_ids as $i => $obj) 
					{
						if( $obj->bike_id == $bike_id_post )
						{
							$obj->qty = $obj->qty + $qty;
							$bike_ids[] = $obj;
						}
						else
						{
							$obj = new stdClass();
							$obj->bike_id = $bike_id_post;
							$obj->qty = 1;
							$old_bike_ids[] = $obj;
						}
				    }
				}
			    foreach($old_bike_ids as $i => $obj) 
				{
					$bike_id_string .= ($bike_id_string == "") ? $obj->bike_id : ",".$obj->bike_id;
				}
			    $session_cart['bike_ids'] = json_encode($old_bike_ids);
			}
			
			$data['cart'] = $session_cart;		

			//echo "bike_id_string=".$bike_id_string;
			$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_id_string, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

			$bike_ids = json_decode($data['cart']['bike_ids']);

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
			
			$data['cart']['bike_ids'] = json_encode($bike_ids);
			$this->session->set_userdata("order_cart", $data['cart']);
		}
		$response = array("error" => 0, "error_message" => "", "success_message" => "Success");
		die(json_encode($response)); 
	}

	public function deletefromCart()
	{
		if( isset($_POST) && count($_POST) > 0 )
		{
			$bike_id_post = $this->input->post('bike_ids');
			$qty = $this->input->post('qty');
			$this->load->model('searchbike_model');
			$session_cart = $this->session->userdata("order_cart");
			
			$bike_id_string = "";
			if( isset($session_cart['bike_ids']) && $session_cart['bike_ids'] != "" )
			{
				$old_bike_ids = json_decode($session_cart['bike_ids']);
				$new_bike_ids = array();
				foreach($old_bike_ids as $i => $obj) 
				{
					if( $obj->bike_id == $bike_id_post )
					{
						if( $obj->qty > 1 )
						{
							$obj->qty = $obj->qty - $qty;
							if( $obj->qty > 0 )
							{
								$new_bike_ids[] = $obj;	
							}
						}
					}
					else
					{
						$obj = new stdClass();
						$obj->bike_id = $bike_id_post;
						$obj->qty = $qty;
						$new_bike_ids[] = $obj;
					}
			    }
			    foreach($new_bike_ids as $i => $obj) 
				{
					$bike_id_string .= ($bike_id_string == "") ? $obj->bike_id : ",".$obj->bike_id;
				}
			    $session_cart['bike_ids'] = json_encode($new_bike_ids);
			}
			$data['cart'] = $session_cart;

			//echo "bike_id_string=".$bike_id_string;
			$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_id_string, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

			$bike_ids = json_decode($data['cart']['bike_ids']);

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
			
			$data['cart']['bike_ids'] = json_encode($bike_ids);
			$this->session->set_userdata("order_cart", $data['cart']);
		}
		$response = array("error" => 0, "error_message" => "", "success_message" => "Success");
		die(json_encode($response)); 
	}
}
