<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancelbooking extends CI_Controller {

	public function index()
	{
		$data['user'] = $this->session->userdata("Auth");
		$this->load->model('bookings_model');
		$this->load->model('bookingpayment_model');
		$this->load->model('users_model');
		$data['admin_phone'] = $this->users_model->getAdminPhone();
		
		$booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;
		if( $booking_id > 0 )
		{
			$data['order'] = $this->bookings_model->getById($booking_id);
			if( $data['order']['customer_id'] != $data['user']['userId'] )
			{
				$this->session->set_flashdata('error', "Booking Order cancel not permitted.");
				redirect('/Account');
			}
			if( $data['order']['status'] == 0 )
			{
				$booking_record = array(
					"status" => 3,
	            	"cancel" => 1,
	            	"cancel_by" => $data['user']['userId'],
	            	"cancel_date" => date("Y-m-d H:i:s")	
	            );
		        $this->bookings_model->updateRecord($booking_record, $booking_id);

		        $paid = $this->bookingpayment_model->getPaid($booking_id);

		        $total = $data['order']['total_amount'];
		        $res = sendCancelAlertToAdmin($data['admin_phone'], $data['user']['name'], $booking_id, $data['order']['pickup_date'], $data['order']['pickup_time'], $total, $paid, $data['user']['phone']);

		        $this->session->set_flashdata('success', "Booking Order cancelled successfully.");
		        redirect('/Account');
			}
			else
			{
				$this->session->set_flashdata('error', "Booking Order cancel not possible.");
				redirect('/Account');	
			}
		}
		else
		{
			$this->session->set_flashdata('error', "Booking Order not found.");
			redirect('/Account');
		}
	}
}