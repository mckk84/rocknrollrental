<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookaride extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Bookaride';
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('biketypes_model');
		$this->load->model('searchbike_model');
		$this->load->model('publicholidays_model');
		$data['biketypes'] = $this->biketypes_model->getAll();

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
			if( $day == 'Sat' || $day == 'Sun' )
			{
				$data['weekend'] = 1;
			}
			$res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['pickup_date']));
			if( $res )
			{
				$data['public_holiday'] = 1;
			}

			$data['available_bikes'] = $this->searchbike_model->getAvailableBikes($data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);
		}
	
        $this->load->view('layout/header', $data);
        $this->load->view('front/bookaride', $data);
        $this->load->view('layout/footer');
	}

	public function view()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Bike';
		$data['user'] = $this->session->userdata();
		$this->load->model('bike_model');
		$data['bike'] = $this->bike_model->getById($id);

        $this->load->view('layout/header', $data);
        $this->load->view('front/viewbike', $data);
        $this->load->view('layout/footer');
	}

}
