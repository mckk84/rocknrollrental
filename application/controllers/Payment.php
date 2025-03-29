<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Payment';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('users_model');
		$data['admin_phone'] = $this->users_model->getAdminPhone();
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$this->load->model('bookings_model');
		$this->load->model('bookingbikes_model');
		$this->load->model('bookingpayment_model');
		$this->load->model('paymentmode_model');
		$this->load->model('coupons_model');

		$data['cart_bikes'] = array();

		$data['cart'] = $this->session->userdata("cart");
		$bike_ids = json_decode($data['cart']['bike_ids']);

		$data['payment_status'] = "Failed";

		$data['cart']['notes'] = "";

		if( isset($_POST) && count($_POST) > 0 )
		{
			$data['cart']['notes'] = trim($this->input->post('notes'));
		}
		
		if( isset($bike_ids) && is_array($bike_ids) && count($bike_ids) > 0 )
		{
			$bike_id_string = "";
			foreach($bike_ids as $i => $obj) 
			{
		        $bike_id_string .= ($bike_id_string == "") ? $obj->bike_id: ",".$obj->bike_id;
		    }
		}
		else
		{
			$this->session->set_userdata("cart", array());
			redirect();
		}

		if( $data['cart']['coupon_code'] != "" ) {
			$coupon = $this->coupons_model->getByCode($data['cart']['coupon_code']);
			$data['cart']['coupon_code'] = $coupon['code'];
			$data['cart']['coupon_type'] = $coupon['type'];
			$data['cart']['coupon_discount'] = $coupon['discount_amount']; 
		}else{
			$data['cart']['coupon_code'] = "";
			$data['cart']['coupon_type'] = "";
			$data['cart']['coupon_discount'] = 0; 
		}

		$d1= new DateTime($data['cart']['dropoff_date']." ".$data['cart']['dropoff_time']); // first date
		$d2= new DateTime($data['cart']['pickup_date']." ".$data['cart']['pickup_time']); // second date
		$interval= $d1->diff($d2);
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
		
		$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_id_string, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

		$subtotal = 0;
        $gst = 0;
        $total = 0;
        $helmets_total = 0;
        $bikes_quantity = 0;
        $refund_amount = 1000;
        $discount = 0;
		foreach($data['cart']['cart_bikes'] as $index => $bike) 
        {
        	foreach($bike_ids as $i => $obj) 
			{
				if($obj->bike_id == $bike['type_id'])
				{
					$bike['quantity'] = $obj->qty;
					break;
				}
		    }
			    
        	$bikes_quantity = $bikes_quantity + $bike['quantity'];
            $rent_price = $bike['rent_price'];
            $subtotal += $rent_price * $bike['quantity'];
            $data['cart']['cart_bikes'][$index] = $bike;
        }
        $total = $subtotal;
        if( $data['cart']['coupon_code'] != "" ) {
	        if( $data['cart']['coupon_type'] == 'percent' )
	        {
	            $discount = round($subtotal * ($data['cart']['coupon_discount'] / 100));
	        }else{
	            $discount = $data['cart']['coupon_discount'];
	        }
	    }
        if( isset($data['cart']['helmets_qty']) && $data['cart']['helmets_qty'] > 0 )
        {
            $helmets_price = 50;
            $helmets_total = $data['cart']['helmets_qty'] * $helmets_price;
            $total += $helmets_total;
        }
        else
        {
        	$data['cart']['helmets_qty'] = 0;
        }
        if( isset($data['cart']['early_pickup']) && $data['cart']['early_pickup'] > 0 )
        {
            $total += $bikes_quantity * 200;
        }
        else
        {
        	$data['cart']['early_pickup'] = 0;
        }
      	
      	$total = $total - $discount;

        $gst = round($subtotal * 0.05, 2);
        $total_paid = 0;
        $refund_amount = $refund_amount * $bikes_quantity;

        if( $data['cart']['paymentOption'] == "PAY_FULL" )
        {
        	$total_paid = $total;
        }
        else
        {
        	$total_paid = round($total/2, 2);
        }

        $pmode_row = $this->paymentmode_model->getIdByMode($data['cart']['paymentOption']);

        // INSERT RECORDS
        $booking_record = array(
            	"customer_id" => $data['user']['userId'],
            	"quantity" => $bikes_quantity,
            	"helmet_quantity" => $data['cart']['helmets_qty'],
            	"booking_amount" => $total_paid,
            	"total_amount" => $total,
            	"refund_amount" => $refund_amount,
            	"refund_status" => 0,
            	"gst" => $gst,
            	"payment_mode" => $pmode_row['id'],
            	"status" => 0,
            	"early_pickup" => $data['cart']['early_pickup'],
            	"pickup_date" => dateformatdb($data['cart']['pickup_date']),
            	"pickup_time" => $data['cart']['pickup_time'],
            	"dropoff_date" => dateformatdb($data['cart']['dropoff_date']),
            	"dropoff_time" => $data['cart']['dropoff_time'],
            	"notes" => $data['cart']['notes'],
            	"coupon_code" => $data['cart']['coupon_code'],
            	"discount" => $discount,
            	"created_by" => 0,	
            );
        $order_bikes = "";
        $worder_bikes = "";
        $booking_id = $this->bookings_model->addNew($booking_record);
        if( $booking_id != "" )
        {
            foreach($data['cart']['cart_bikes'] as $bike) 
            {
            	for ($i=0; $i < $bike['quantity']; $i++) 
            	{ 
            		$bookingbikes_record = array(
		            	"booking_id" => $booking_id,
		            	"type_id" => $bike['type_id'],
		            	"quantity" => 1,
		            	"created_by" => 0,	
		            );
		            $this->bookingbikes_model->addNew($bookingbikes_record);
		        }
		        $order_bikes .= ($order_bikes == "") ? $bike['bike_type_name']."(".$bike['quantity'].")" : ",".$bike['bike_type_name']."(".$bike['quantity'].")";
		        $worder_bikes .= ($worder_bikes == "") ? $bike['bike_type_name']."(".$bike['quantity'].")" : ";".$bike['bike_type_name']."(".$bike['quantity'].")";
	        }

	        // Add Payment Record
	        $booking_payment = array(
	        	"booking_id" => $booking_id,
	        	"amount" => $total_paid,
	        	"payment_mode" => $pmode_row['id'],
	        	"created_by" => 0
	        );
	        $this->bookingpayment_model->addNew($booking_payment);
	        $data['payment_status'] = "Success";
	        $data['booking_id'] = $booking_id;

	        // Send Whatsapp Message
	        sendNewOrdertoCustomer($data['user']['phone'], $data['user']['name'], $booking_id, $worder_bikes, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time'], $total, $total_paid);

	        sendNewOrderAlertToAdmin($data['admin_phone'], $data['user']['name'], $booking_id, $worder_bikes, $data['cart']['pickup_date']." ".$data['cart']['pickup_time'], $data['user']['phone']);

	        $this->session->set_userdata("cart", array());
        }

        $this->load->view('layout/header', $data);
        $this->load->view('front/payment_success', $data);
        $this->load->view('layout/footer');
	}

	public function instant()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Payment';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('users_model');
		$data['admin_phone'] = $this->users_model->getAdminPhone();
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$this->load->model('bookings_model');
		$this->load->model('bookingbikes_model');
		$this->load->model('bookingpayment_model');
		$this->load->model('paymentmode_model');

		$data['cart_bikes'] = array();

		$data['cart'] = $this->session->userdata("instant_cart");
		$bike_ids = $data['cart']['bike_ids'];
		$bike_quantity = $data['cart']['cart_bikes'][0]['quantity'];
		$data['payment_status'] = "Failed";
		$data['cart']['paymentOption'] = "PAY_FULL";
		$data['cart']['notes'] = "";

		if( isset($_POST) && count($_POST) > 0 )
		{
			$data['cart']['notes'] = trim($this->input->post('notes'));
		}
		
		if( $bike_ids != "" )
		{
			$bike_id_string = $bike_ids;
		}
		else
		{
			$this->session->set_userdata("instant_cart", array());
			redirect();
		}

		if( $data['cart']['coupon_code'] != "" ) {
			$coupon = $this->coupons_model->getByCode($data['cart']['coupon_code']);
			$data['cart']['coupon_code'] = $coupon['code'];
			$data['cart']['coupon_type'] = $coupon['type'];
			$data['cart']['coupon_discount'] = $coupon['discount_amount']; 
		}else{
			$data['cart']['coupon_code'] = "";
			$data['cart']['coupon_type'] = "";
			$data['cart']['coupon_discount'] = 0; 
		}

		$d1= new DateTime($data['cart']['dropoff_date']." ".$data['cart']['dropoff_time']); // first date
		$d2= new DateTime($data['cart']['pickup_date']." ".$data['cart']['pickup_time']); // second date
		$interval= $d1->diff($d2);
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
		
		$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($bike_id_string, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

		$subtotal = 0;
        $gst = 0;
        $total = 0;
        $helmets_total = 0;
        $refund_amount = 1000;
        $order_bikes = "";
        $worder_bikes = "";
        $discount = 0;
        // subtotal will be for only bikes
		foreach($data['cart']['cart_bikes'] as $bike) 
        {
            $rent_price = $bike['rent_price'];
            $order_bikes .= ($order_bikes == "") ? $bike['bike_type_name']."(".$bike_quantity.")" : ",".$bike['bike_type_name']."(".$bike_quantity.")";
            $subtotal += $bike_quantity * $rent_price;
            $worder_bikes .= ($worder_bikes == "") ? $bike['bike_type_name']."(".$bike_quantity.")" : ";".$bike['bike_type_name']."(".$bike_quantity.")";
        }

        $total = $subtotal;
        if( $data['cart']['coupon_code'] != "" ) 
        {
	        if( $data['cart']['coupon_type'] == 'percent' )
	        {
	            $discount = round($subtotal * ($data['cart']['coupon_discount'] / 100));
	        }else{
	            $discount = $data['cart']['coupon_discount'];
	        }
	    }

        if( isset($data['cart']['helmets_qty']) && $data['cart']['helmets_qty'] > 0 )
        {
            $helmets_price = 50;
            $helmets_total = $data['cart']['helmets_qty'] * $helmets_price;
            $total += $helmets_total;
        }
        else
        {
        	$data['cart']['helmets_qty'] = 0;
        }

        if( isset($data['cart']['early_pickup']) && $data['cart']['early_pickup'] > 0 )
        {
            $total += $bike_quantity * 200;
        }
        else
        {
        	$data['cart']['early_pickup'] = 0;
        }
        $total = $total - $discount;
        $gst = round($subtotal * 0.05, 2);
        $total_paid = 0;

        if( $data['cart']['paymentOption'] == "PAY_FULL" )
        {
        	$total_paid = $total;
        }
        else
        {
        	$total_paid = round($total/2, 2);
        }

        $refund_amount =$refund_amount * $bike_quantity;
        
        $pmode_row = $this->paymentmode_model->getIdByMode($data['cart']['paymentOption']);
        
        // INSERT RECORDS
        $booking_record = array(
            	"customer_id" => $data['user']['userId'],
            	"quantity" => $bike_quantity,
            	"helmet_quantity" => $data['cart']['helmets_qty'],
            	"booking_amount" => $total_paid,
            	"total_amount" => $total,
            	"refund_amount" => $refund_amount,
            	"refund_status" => 0,
            	"gst" => $gst,
            	"payment_mode" => $pmode_row['id'],
            	"status" => 0,
            	"early_pickup" => $data['cart']['early_pickup'],
            	"pickup_date" => dateformatdb($data['cart']['pickup_date']),
            	"pickup_time" => $data['cart']['pickup_time'],
            	"dropoff_date" => dateformatdb($data['cart']['dropoff_date']),
            	"dropoff_time" => $data['cart']['dropoff_time'],
            	"notes" => $data['cart']['notes'],
            	"coupon_code" => $data['cart']['coupon_code'],
            	"discount" => $discount,
            	"created_by" => 0,	
            );
        
        $booking_id = $this->bookings_model->addNew($booking_record);
        if( $booking_id != "" )
        {
            foreach($data['cart']['cart_bikes'] as $bike) 
            {
            	for ($i=0; $i < $bike_quantity; $i++) 
            	{
            		$bookingbikes_record = array(
		            	"booking_id" => $booking_id,
		            	"type_id" => $bike['type_id'],
		            	"quantity" => 1,
		            	"created_by" => 0,	
		            );
		            $this->bookingbikes_model->addNew($bookingbikes_record); 
            	}				
	        }

	        // Add Payment Record
	        $booking_payment = array(
	        	"booking_id" => $booking_id,
	        	"amount" => $total_paid,
	        	"payment_mode" => $pmode_row['id'],
	        	"created_by" => 0
	        );
	        $this->bookingpayment_model->addNew($booking_payment);
	        $data['payment_status'] = "Success";
	        $data['booking_id'] = $booking_id;

	        // Send Whatsapp Message
	        sendNewOrdertoCustomer($data['user']['phone'], $data['user']['name'], $booking_id, $worder_bikes, $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time'], $total, $total_paid);

	        sendNewOrderAlertToAdmin($data['admin_phone'], $data['user']['name'], $booking_id, $worder_bikes, $data['cart']['pickup_date']." ".$data['cart']['pickup_time'], $data['user']['phone']);

	        $this->session->set_userdata("instant_cart", array());
        }

        $this->load->view('layout/header', $data);
        $this->load->view('front/payment_success', $data);
        $this->load->view('layout/footer');
	}

	public function insta_coupon()
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
					$data['page_title'] = 'Rock N Roll Bike Rentals | Checkout';
					$data['user'] = $this->session->userdata("Auth");
					$data['cart'] = $this->session->userdata("instant_cart");
					$data['cart']['paymentOption'] = "PAY_FULL";
					$data['cart']['coupon_code'] = "";
					$data['cart']['coupon_type'] = "";
					$data['cart']['coupon_discount'] = ""; 
					$this->session->set_userdata("instant_cart", $data['cart']);

					$this->load->view('layout/header', $data);
	    			$this->load->view('front/instant_checkout', $data);
	    			$this->load->view('layout/footer'); 
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
						$data['page_title'] = 'Rock N Roll Bike Rentals | Checkout';
						$data['user'] = $this->session->userdata("Auth");
						$data['cart'] = $this->session->userdata("instant_cart");
						$data['cart']['paymentOption'] = "PAY_FULL";
						$data['cart']['coupon_code'] = $coupon['code'];
						$data['cart']['coupon_type'] = $coupon['type'];
						$data['cart']['coupon_discount'] = $coupon['discount_amount']; 
						$this->session->set_userdata("instant_cart", $data['cart']);

						$this->load->view('layout/header', $data);
		    			$this->load->view('front/instant_checkout', $data);
		    			$this->load->view('layout/footer'); 					
					}
				}
			}
        }
	}
}
