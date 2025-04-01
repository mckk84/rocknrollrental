<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Checkout';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('searchbike_model');
		$this->load->model('coupons_model');
		$this->load->model('publicholidays_model');
		$data['cart_bikes'] = array();

		$data['cart'] = $this->session->userdata("cart");
		$session_order = $this->session->userdata("order");
		$data['order'] = $session_order;
		
		$bike_ids = json_decode($data['cart']['bike_ids']);
		$data['cart']['paymentOption'] = "PAY_FULL";
		
		if( isset($_POST) && count($_POST) > 0 )
		{
			$data['cart']['paymentOption'] = $this->input->post('paymentOption');
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
			if( $day == 'Fri' || $day == 'Sat' || $day == 'Sun' )
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

		    if( $data['cart']['coupon_code'] != "" ){
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
        $this->load->view('front/checkout', $data);
        $this->load->view('layout/footer');
	}

	public function coupon()
	{
		$response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
		if ($this->input->is_ajax_request()) 
		{
            if ($this->input->method(TRUE) == "POST") 
            {
            	if( isset($_POST) && count($_POST) > 0 )
				{
					$this->load->model('coupons_model');
					$coupon_code = $this->security->xss_clean($this->input->post('coupon_code'));
					$cancel = $this->security->xss_clean($this->input->post('cancel'));
					if( isset($cancel) && $cancel == 1 )
					{
						$data['cart'] = $this->session->userdata("cart");
						$data['cart']['coupon_code'] = "";
						$data['cart']['coupon_type'] = "";
						$data['cart']['coupon_discount'] = ""; 
						$this->session->set_userdata("cart", $data['cart']);

						$response["error"] = 0;
						$response["error_message"] = "";
						$response["success_message"] = "Coupon Removed";
						die(json_encode($response)); 
					}
					else
					{
						if( $coupon_code == "" )
						{
							$response["error"] = 1;
							$response["error_message"] = "Invalid Coupon";
							$response["success_message"] = "";
							die(json_encode($response)); 					
						}
						$coupon = $this->coupons_model->getByCode($coupon_code);
						if( count($coupon) == 0 )
						{
							$response["error"] = 1;
							$response["error_message"] = "Invalid Coupon";
							$response["success_message"] = "";
							die(json_encode($response)); 					
						} 
						else
						{
							$data['cart'] = $this->session->userdata("cart");
							$data['cart']['coupon_code'] = $coupon['code'];
							$data['cart']['coupon_type'] = $coupon['type'];
							$data['cart']['coupon_discount'] = $coupon['discount_amount']; 
							$this->session->set_userdata("cart", $data['cart']);

							$response["error"] = 0;
							$response["error_message"] = "";
							$response["success_message"] = "Coupon Applied";
							die(json_encode($response)); 					
						}
					}
				}
            }
        }
        die(json_encode($response));
	}

}
