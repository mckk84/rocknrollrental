<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Payment';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$this->load->model('bookings_model');
		$this->load->model('bookingbikes_model');
		$this->load->model('bookingpayment_model');
		$this->load->model('paymentmode_model');

		$data['cart_bikes'] = array();
		$data['cart'] = $this->session->userdata("cart");
		$bike_ids = json_decode($data['cart']['bike_ids']);

		$data['payment_status'] = "Failed";
		
		if( isset($bike_ids) && is_array($bike_ids) && count($bike_ids) > 0 )
		{
			$bike_id_string = "";
			foreach($bike_ids as $i => $obj) 
			{
		        $bike_id_string .= ($bike_id_string == "") ? $obj->bike_id: ",".$obj->bike_id;
		    }
		}
		else if( $bike_ids != "" )
		{
			$bike_id_string = $bike_ids;
		}
		else
		{
			$this->session->set_userdata("cart", array());
			redirect();
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
		foreach($data['cart']['cart_bikes'] as $bike) 
        {
        	$bikes_quantity++;
            $rent_price = 0;
            if( $data['cart']['period_days'] > 0  || $data['cart']['period_hours'] > 4 ){
                if( $data['cart']['public_holiday'] == 1 ){
                    $rent_price = $bike['holiday_day_price'];
                }
                elseif( $data['cart']['weekend'] == 1 ){
                    $rent_price = $bike['weekend_day_price'];
                } else {
                    $rent_price = $bike['week_day_price'];
                }
            } else {
                if( $data['cart']['public_holiday'] == 1 ){
                    $rent_price = $bike['holiday_day_half_price'];
                } elseif( $data['cart']['weekend'] == 1 ){
                    $rent_price = $bike['weekend_day_half_price'];
                } else {
                    $rent_price = $bike['week_day_half_price'];
                } 
            }
            $total += $rent_price;
        }
        if( isset($data['cart']['helmets_qty']) && $data['cart']['helmets_qty'] > 0 )
        {
            $helmets_price = 50;
            $helmets_total = $data['cart']['helmets_qty'] * $helmets_price;
            $total += $helmets_total;
        }
        else
        {
        	$cart['helmets_qty'] = 0;
        }

        $subtotal = $total - round($total * 0.05, 2);
        $gst = round($total * 0.05, 2);
        $total_paid = 0;

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
            	"gst" => $gst,
            	"payment_mode" => $pmode_row['id'],
            	"status" => 0,
            	"pickup_date" => dateformatdb($data['cart']['pickup_date']),
            	"pickup_time" => $data['cart']['pickup_time'],
            	"dropoff_date" => dateformatdb($data['cart']['dropoff_date']),
            	"dropoff_time" => $data['cart']['dropoff_time'],
            	"notes" => "",
            	"created_by" => 0,	
            );
        
        $booking_id = $this->bookings_model->addNew($booking_record);
        if( $booking_id != "" )
        {
            foreach($data['cart']['cart_bikes'] as $bike) 
            {
				$bookingbikes_record = array(
	            	"booking_id" => $booking_id,
	            	"type_id" => $bike['type_id'],
	            	"quantity" => 1,
	            	"created_by" => 0,	
	            );
	            $this->bookingbikes_model->addNew($bookingbikes_record);
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

	        $this->session->set_userdata("cart", array());
        }

        $this->load->view('layout/header', $data);
        $this->load->view('front/payment_success', $data);
        $this->load->view('layout/footer');
	}
}
