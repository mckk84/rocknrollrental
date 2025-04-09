<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function signin()
	{
		$response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
		if ($this->input->is_ajax_request()) 
		{
            if ($this->input->method(TRUE) == "POST") 
            {
            	$this->load->model('customers_model');
            	$this->load->library('form_validation');   

            	$opt_login = $this->security->xss_clean($this->input->post('opt_login'));
            	$this->form_validation->set_rules('phone','Phone','trim|required|numeric|max_length[10]');

            	if( $opt_login == 1 )
            	{
            		$otp = $this->security->xss_clean($this->input->post('otp'));
            		$phone = $this->security->xss_clean($this->input->post('phone'));
            		
            		if( !$this->customers_model->checkPhoneExists($phone) )
            		{
            			$response["error"] = 1;
	            		$response["error_message"] = "Phone is not registered.";	
	            		die(json_encode($response));
            		}

            		if( isset($otp) && !is_null($otp) && $otp != "" )
            		{
            			$result = $this->customers_model->loginOtp($phone, $otp);
		                if (!empty($result))
		                {
		                    $response["error"] = 0;
		                    $response["error_message"] = "";
		                    $response["success_message"] = "Login successful";
		                    $sessionArray = array( 'userId'=>$result->id,
	                                        'name'=>$result->name,
	                                        'email'=>$result->email,
	                                        'phone'=>$result->phone,
	                                        'Authorization' => true
	                                );

	                		$this->session->set_userdata("Auth", $sessionArray);
	                		$response["error"] = 0;
		            		$response["error_message"] = "";
		            		$response["success_message"] = "Login successful";
		            		die(json_encode($response));
		                } 
		                else 
		                {
		                    $response["error"] = 1;
		                    $response["error_message"] = "OTP Incorrect";
		                    die(json_encode($response));
		                }
            		}
            		else
            		{
            			// Send whatsapp OTP
	            		$random6 = generateOtp();

	            		$api_response = sendOtpWhatsapp($phone, $random6);

	            		if( $api_response ){
		            		// insert OTP
		            		$result = $this->customers_model->insertOtp($phone, $random6);

		            		$response["error"] = 0;
		            		$response["error_message"] = "";
		            		$response["success_message"] = "Otp sent to your phone number.";
		            		die(json_encode($response));	
	            		}
	            		else
	            		{
	            			$response["error"] = 1;
		            		$response["error_message"] = "Otp login unavailable. Please use password.";
		            		$response["success_message"] = "";
		            		die(json_encode($response));	
	            		}
            		}            		
            	}

            	$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[20]');

            	$password = $this->security->xss_clean($this->input->post('password'));
            	$phone = $this->security->xss_clean($this->input->post('phone'));
            	if($this->form_validation->run() == FALSE)
		        {
		            $response["error"] = 1;
		            $response["error_message"] = $this->form_validation->error_string();
		            die(json_encode($response));
		        }

		        if(!preg_match('/^(?=.*\d)[0-9A-Za-z_!@#$%]{6,}$/', $password)) 
		        {
				    $response["error"] = 1;
		            $response["error_message"] = "Password is not strong.";
		            die(json_encode($response));
				}
				
				$recordInfo = array(
	                'phone' => $phone,
	                'password' => getHashedPassword($password) );

		        if( $this->customers_model->checkPhoneExists($phone) )
	            {
	                $result = $this->customers_model->loginMe($phone, $password);
	                if (!empty($result))
	                {
	                    $response["error"] = 0;
	                    $response["error_message"] = "";
	                    $response["success_message"] = "Login successful";
	                    $sessionArray = array( 'userId'=>$result->id,
                                        'name'=>$result->name,
                                        'email'=>$result->email,
                                        'phone'=>$result->phone,
                                        'Authorization' => true
                                );

                		$this->session->set_userdata("Auth", $sessionArray);
	                } 
	                else 
	                {
	                    $response["error"] = 1;
	                    $response["error_message"] = "Phone/Password Incorrect";
	                }
	            } 
	            else
	            {
	            	$response["error"] = 1;
	            	$response["error_message"] = "Phone is not registered.";
	            }
            }
        }
        die(json_encode($response));   
	}

	public function signup()
	{
		$response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
		if ($this->input->is_ajax_request()) 
		{
            if ($this->input->method(TRUE) == "POST") 
            {
            	$this->load->library('form_validation');   
            	$this->load->model('customers_model');

            	$opt_login = $this->security->xss_clean($this->input->post('opt_login'));
            	$this->form_validation->set_rules('phone','Phone','trim|required|numeric|max_length[10]');

            	if( $opt_login == 1 )
            	{
            		$otp = $this->security->xss_clean($this->input->post('otp'));
            		$phone = $this->security->xss_clean($this->input->post('phone'));
            		
            		if( $this->customers_model->checkPhoneExists($phone) )
            		{
            			$response["error"] = 1;
	            		$response["error_message"] = "Phone number is already registered.";	
	            		die(json_encode($response));
            		}

            		if( isset($otp) && !is_null($otp) && $otp != "" )
            		{
            			$otp_session = $this->session->userdata('signup_otp');
		                if ( $otp == $otp_session )
		                {
		                    $response["error"] = 0;
		                    $response["error_message"] = "";
		                    $response["success_message"] = "OTP Verified";
		                    die(json_encode($response));
		                } 
		                else 
		                {
		                    $response["error"] = 1;
		                    $response["error_message"] = "OTP Incorrect";
		                    die(json_encode($response));
		                }
            		}
            		else
            		{
            			// Send whatsapp OTP
	            		$random6 = generateOtp();

	            		$api_response = sendOtpWhatsapp($phone, $random6);

	            		if( $api_response ){
		            		// insert OTP
		            		$this->session->set_userdata('signup_otp', $random6);

		            		$response["error"] = 0;
		            		$response["error_message"] = "";
		            		$response["success_message"] = "Otp sent to your phone number.";
		            		die(json_encode($response));	
	            		}
	            		else
	            		{
	            			$response["error"] = 1;
		            		$response["error_message"] = "Otp login unavailable. Please use password.";
		            		$response["success_message"] = "";
		            		die(json_encode($response));	
	            		}
            		}            		
            	}

            	$this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
            	$this->form_validation->set_rules('email','Email','trim|required|max_length[128]');
            	$this->form_validation->set_rules('phone','Phone','trim|required|numeric|max_length[10]');
            	$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[20]');

            	$name = $this->security->xss_clean($this->input->post('name'));
            	$email = $this->security->xss_clean($this->input->post('email'));
            	$phone = $this->security->xss_clean($this->input->post('phone'));
            	$password = $this->security->xss_clean($this->input->post('password'));

            	if($this->form_validation->run() == FALSE)
		        {
		            $response["error"] = 1;
		            $response["error_message"] = $this->form_validation->error_string();
		            die(json_encode($response));
		        }
		        if(!preg_match('/^(?=.*\d)[0-9A-Za-z_!@#$%]{6,}$/', $password)) 
		        {
				    $response["error"] = 1;
		            $response["error_message"] = "Password contains invalid characters.";
		            die(json_encode($response));
				}
				$this->load->model('customers_model');
				$recordInfo = array(
                'name' => $name,
                'email' => $email, 
                'phone' => $phone,
                'password' => getHashedPassword($password) );

		        if( $this->customers_model->checkPhoneExists($phone) )
	            {
	                $response["error"] = 1;
	                $response["error_message"] = "User already registered.";
	            }
	            else
	            {
	                $result = $this->customers_model->addNew($recordInfo);
	                if($result > 0)
	                {
	                    $response["error"] = 0;
	                    $response["error_message"] = "";
	                    $response["success_message"] = "Signup successful";
	                    $sessionArray = array( 'userId'=>$result,
                                        'name'=>$name,
                                        'email'=>$email,
                                        'phone'=>$phone,
                                        'Authorization' => true
                                );

                		$this->session->set_userdata("Auth", $sessionArray);
	                } 
	                else 
	                {
	                    $response["error"] = 1;
	                    $response["error_message"] = "Signup Failed.";
	                }
	            } 
            }
        }
        die(json_encode($response));   
	}

	public function changepassword()
	{
		$response = array('error' => 0, 'error_message' => 'Invalid Request', 'success_message' => '');
		if ($this->input->is_ajax_request()) 
		{
            if ($this->input->method(TRUE) == "POST") 
            {
            	$this->load->library('form_validation');   

            	$this->form_validation->set_rules('current_password','Current Password','trim|required|min_length[6]|max_length[10]');
            	$this->form_validation->set_rules('new_password','New Password','trim|required|min_length[6]|max_length[10]');
            	$this->form_validation->set_rules('retype_password','Retype Password','trim|required|min_length[6]|max_length[10]');

            	$current_password = $this->security->xss_clean($this->input->post('current_password'));
            	$new_password = $this->security->xss_clean($this->input->post('new_password'));
            	$retype_password = $this->security->xss_clean($this->input->post('retype_password'));

            	if($this->form_validation->run() == FALSE)
		        {
		            $response["error"] = 1;
		            $response["error_message"] = $this->form_validation->error_string();
		            die(json_encode($response));
		        }
		        if(!preg_match('/^(?=.*\d)[0-9A-Za-z_!@#$%]{6,}$/', $new_password)) 
		        {
				    $response["error"] = 1;
		            $response["error_message"] = "New password contains invalid characters.";
		            die(json_encode($response));
				}

				if( $new_password != $retype_password)
		        {
	               	$response["error"] = 1;
		            $response["error_message"] = "Passwords did not match.";
		            die(json_encode($response));
	            }

				$this->load->model('customers_model');
				$user = $this->session->userdata();
				$record = $this->customers_model->getById($user['userId']);
			
		        if(!verifyHashedPassword($current_password, $record['password']))
		        {
	               	$response["error"] = 1;
		            $response["error_message"] = "Current password is incorrect.";
		            die(json_encode($response));
	            }

	            $result = $this->customers_model->createPasswordUser($user['userId'], $new_password);
                if( $result )
                {
                    $response["error"] = 0;
                    $response["error_message"] = "";
                    $response["success_message"] = "Password update successful";
                } 
                else 
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Password update failed.";
                }
            }
        }
        die(json_encode($response));  
	}

	function signoff()
	{
		$this->session->sess_destroy(); 
        $this->session->set_flashdata('success', 'Logged Out');
        redirect();
	}
}
