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
        $this->load->view('front/checkout', $data);
        $this->load->view('layout/footer');
	}

	public function instant()
	{
		if ($this->input->method(TRUE) == "POST") 
        {
			if( isset($_POST) && count($_POST) > 0 )
			{
				$data['page_title'] = 'Rock N Roll Bike Rentals | Checkout';
				$data['user'] = $this->session->userdata("Auth");
				$data['cart']['  '] = $this->input->post('bike_type_id');
				$data['cart']['pickup_date'] = $this->input->post('pickupdate');
				$data['cart']['pickup_time'] = $this->input->post('pickuptime');
				$data['cart']['dropoff_date'] = $this->input->post('dropoffdate');
				$data['cart']['dropoff_time'] = $this->input->post('dropofftime');
				$data['cart']['paymentOption'] = "PAY_FULL";

				$this->load->model('searchbike_model');
				$this->load->model('publicholidays_model');

				$data['cart']['bikeqty'] = $this->input->post('bikeqty');
				$data['cart']['helmets_qty'] = $this->input->post('helmets_qty');
				
				$d1= new DateTime($data['cart']['dropoff_date']." ".$data['cart']['dropoff_time']); // first date
				$d2= new DateTime($data['cart']['pickup_date']." ".$data['cart']['pickup_time']); // second date
				$interval= $d1->diff($d2); // get difference between two dates
				$data['cart']['period_days'] = $interval->days;
				$data['cart']['period_hours'] = $interval->h; 

				$data['cart']['weekend'] = 0;
				$data['cart']['public_holiday'] = 0;
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

				$data['cart']['bike_availability'] = 0;
				$data['cart']['cart_bikes'] = $this->searchbike_model->getCartBikes($data['cart']['bike_ids'], $data['cart']['pickup_date'], $data['cart']['pickup_time'], $data['cart']['dropoff_date'], $data['cart']['dropoff_time']);

				foreach($data['cart']['cart_bikes'] as $index => $bike)
				{
					if($data['cart']['bike_ids'] == $bike['bike_type_id'])
					{
						$bike['quantity'] = $bike['bikes_available'];
						$data['cart']['cart_bikes'][$index] = $bike;
						break;
					}					
				}
				$this->session->set_userdata("cart", $data['cart']);

				$this->load->view('layout/header', $data);
    			$this->load->view('front/checkout', $data);
    			$this->load->view('layout/footer');
			}
			else{
				redirect();
			}
		}
		else{
				redirect();
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

					if( $data['period_hours'] <= 0 )
					{
						$response = array('error' => 1, 'error_message' => 'Invalid dates');
						die($response);
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

							$data['rent_price'] = 0;
                            if( $data['period_days'] > 0 || $data['period_hours'] > 4  ){
                                $duration = "day";
                                if( $data['public_holiday'] == 1 ){
                                    $data['rent_price'] = $bike['holiday_day_price'];
                                }
                                elseif( $data['weekend'] == 1 ){
                                    $data['rent_price'] = $bike['weekend_day_price'];
                                } else {
                                    $data['rent_price'] = $bike['week_day_price'];
                                }
                            } else {
                                $duration = "halfday";
                                if( $data['public_holiday'] == 1 ){
                                    $data['rent_price'] = $bike['holiday_day_half_price'];
                                } elseif( $data['weekend'] == 1 ){
                                    $data['rent_price'] = $bike['weekend_day_half_price'];
                                } else {
                                    $data['rent_price'] = $bike['week_day_half_price'];
                                } 
                            }

							break;
						}					
					    $data['cart_bikes'][$index] = $bike;
					}

					$response["data"] = $data;
					$response["error"] = 0;
					$response["success_message"] = "Availabile";
					die(json_encode($response)); 					
				}
            }
        }
        die(json_encode($response));
	}
}
