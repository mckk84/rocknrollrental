<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{
		$data['page_title'] = 'Rock N Roll Bike Rentals | Bike rentals in Chikmangaluru | Unlimited Kilometers | Contact';
		$data['user'] = $this->session->userdata("Auth");
        $this->load->view('layout/header', $data);
        $this->load->view('front/contact', $data);
        $this->load->view('layout/footer');
	}

    public function subscribe()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 
        $this->load->model('subscribers_model');
 
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');

        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $email = $this->security->xss_clean($this->input->post('email'));
            $recordInfo = array(
                'email' => $email
            );

            if( $this->subscribers_model->checkRecordExists($email) )
            {
                $response["error"] = 1;
                $response["error_message"] = "You have already subscribed.";
            }
            else
            {
                $result = $this->subscribers_model->addNew($recordInfo);
                if($result > 0)
                {
                    $response["error"] = 0;
                    $response["error_message"] = "";
                    $response["success_message"] = "You have Subscribed successfully.";
                } 
                else 
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Oops!! Error Occured. Please try again later.";
                }
            }                
            die(json_encode($response)); 
        }
    }

	public function savequery()
	{
		$response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 
        $this->load->model('contact_model');
 
        $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('phone','Phone','trim|required|max_length[10]');
        $this->form_validation->set_rules('subject','Subject','trim|required|max_length[100]');
        $this->form_validation->set_rules('message','Message','trim|required|max_length[255]');
                        
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $name = $this->security->xss_clean($this->input->post('name'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $phone = $this->security->xss_clean($this->input->post('phone'));
            $subject = $this->security->xss_clean($this->input->post('subject'));
            $message = $this->security->xss_clean($this->input->post('message'));

            $recordInfo = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject,
                'message' => $message
            );

            if( $this->contact_model->checkPhoneExists($phone) )
            {
                $response["error"] = 1;
                $response["error_message"] = "Query already submitted. We are looking into it.";
            }
            else
            {
                $result = $this->contact_model->addNew($recordInfo);
                if($result > 0)
                {
                    $response["error"] = 0;
                    $response["error_message"] = "";
                    $response["success_message"] = "Query submitted successfully";
                } 
                else 
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Oops!! Error Occured. Please try again later.";
                }
            }                
            die(json_encode($response));            
        }
	}
}
