<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bookings
 * Bookings class to control to manage Bookings data
 */
class Bookings extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bike_model');
        $this->load->model('bookings_model');
        $this->load->model('biketypes_model');
        $this->load->model('bookingbikes_model');
        $this->load->model('bookingpayment_model');
        $this->load->model('paymentmode_model');
        $this->load->model('holidays_model');
        $this->load->model('publicholidays_model');
        $this->load->model('searchbike_model');
        $this->load->model('customers_model');
        $this->load->model('users_model');
        $this->load->model('orderhistory_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('admin');
        }
        else
        {
            $data['status'] = isset($_GET['status']) ? $_GET['status'] : ""; 
            $data['daterange'] = isset($_GET['daterange']) ? $_GET['daterange'] : ""; 

            $data['user'] = $this->session->userdata();
            $data['page_title'] = "Bookings";
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            if( gettype($data['status']) === 'string' && $data['status'] == "new" )
            {
                $data['records'] = $this->bookings_model->getAll("0,1");
            } 
            elseif ( $data['status'] != "" ) 
            {
                $data['records'] = $this->bookings_model->searchBookings($data['status'], $data['daterange']);
            }
            elseif ( $data['daterange'] != "" ) 
            {
                $data['records'] = $this->bookings_model->searchBookings($data['status'], $data['daterange']);
            }
            else
            {
                $data['records'] = $this->bookings_model->getAll();
            }
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/bookings', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function new()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('admin');
        }
        else
        {
            $data['user'] = $this->session->userdata();
            $data['page_title'] = "New Booking";
            $data['customers'] = $this->customers_model->getAll();
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/new_booking', $data);
            $this->load->view('layout_admin/footer');
        }
    }

    public function view()
    {
        $booking_id = (isset($_GET['bid']) && $_GET['bid'] != "") ? intval($_GET['bid']) : 0;
        if( $booking_id == 0 )
        {
            redirect('admin/Bookings');
        } 
        $data['user'] = $this->session->userdata();
        $data['page_title'] = "Bookings";
        $data['booking_id'] = $booking_id;
        $biketypes = $this->biketypes_model->getAll();
        $data['biketypes'] = result_to_array($biketypes);
        $data['order'] = $this->bookings_model->getById($booking_id);
        $data['order_bike_types'] = $this->bookingbikes_model->getByBookingId($booking_id);
        $data['order_payment'] = $this->bookingpayment_model->getByBookingId($booking_id);
        $data['customer'] = $this->customers_model->getById($data['order']['customer_id']);

        $bike_assigned_ids = [];
        $bike_type_ids = "";
        $bike_type_names = "";
        $bike_type_array = [];
        $bike_type_qty = [];
        foreach($data['order_bike_types'] as $i => $row)
        {
          if( !in_array($row['type_id'], $bike_type_array) )
          {
            array_push($bike_type_array, $row['type_id']); 
            $bike_type_names .= ( $bike_type_names == "" ) ? $row['type'] : ",".$row['type'];
            $bike_type_qty[ $row['type'] ] = 1;
          }
          else
          {
            $bike_type_qty[ $row['type'] ] = $bike_type_qty[ $row['type'] ] + 1;
          }
          if( $row['bike_id'] != 0 && !in_array($row['bike_id'], $bike_assigned_ids) )
          {
            array_push($bike_assigned_ids, $row['bike_id']);
          }

          $row['rent_price'] = $this->searchbike_model->getRentPrice($row['type_id'], $data['order']['pickup_date'], $data['order']['pickup_time'], $data['order']['dropoff_date'], $data['order']['dropoff_time']);
          $data['order_bike_types'][$i] = $row;
        }
        $bike_type_ids = implode(",", $bike_type_array);
        $ordered_bike_qty = "";
        foreach($bike_type_qty as $btype => $bq)
        {
           $ordered_bike_qty .= "<span class='w-100 text-dark font-bold d-block'>".$btype." ( ".$bq." )</span>";
        }

        $d1= new DateTime($data['order']['dropoff_date']." ".$data['order']['dropoff_time']); // first date
        $d2= new DateTime($data['order']['pickup_date']." ".$data['order']['pickup_time']); // second date
        $interval= $d1->diff($d2); // get difference between two dates
        $data['period_days'] = $interval->days;
        $data['period_hours'] = $interval->h; 

        $data['weekend'] = 0;
        $data['public_holiday'] = 0;
        $data['holiday'] = 0;
        $date=date_create($data['order']['pickup_date']);
        $day = date_format($date,"D");
        if( $day == 'Fri' || $day == 'Sat' || $day == 'Sun' )
        {
            $data['weekend'] = 1;
        }
        $res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['order']['pickup_date']));
        if( $res )
        {
            $data['public_holiday'] = 1;
        }

        $res = $this->holidays_model->checkRecordExists(dateformatdb($data['order']['pickup_date']));
        if( $res )
        {
            $data['holiday'] = 1;
        }
        
        $data['ordered_bikes'] = $ordered_bike_qty;
        $data['bike_url'] = base_url('bikes/');

        $this->load->view('layout_admin/header', $data);
        $this->load->view('backend/view_booking', $data);
        $this->load->view('layout_admin/footer');
    }

    public function getOrderBikeTypes()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('type_id','Bike Type','trim|required|max_length[128]');
        $this->form_validation->set_rules('booking_id','Booking Id','trim|required|max_length[128]');
        
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $data['booking_id'] = trim($this->input->post('booking_id'));
            $data['type_id'] = trim($this->input->post('type_id'));
            $data['order'] = $this->bookings_model->getById($data['booking_id']);
            
            $data['available_bikes'] = $this->searchbike_model->searchBikes($data['type_id'], $data['order']['pickup_date'], $data['order']['pickup_time'], $data['order']['dropoff_date'], $data['order']['dropoff_time']);

            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Success";
            $response["data"] = $data;
            die(json_encode($response));
        }
    }

    public function getBikeTypes()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        
        $data['biketypes'] = $this->biketypes_model->getAll();

        $response["error"] = 0;
        $response["error_message"] = "";
        $response["success_message"] = "Success";
        $response["data"] = $data;
        die(json_encode($response));
    }

    public function getAvailableBikes()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('type_ids','Bike Type','trim|required|max_length[128]');
        $this->form_validation->set_rules('booking_id','Booking Id','trim|required|max_length[128]');
        
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $data['booking_id'] = trim($this->input->post('booking_id'));
            $data['type_id'] = trim($this->input->post('type_ids'));
            $data['order'] = $this->bookings_model->getById($data['booking_id']);
            $data['pickup_date'] = trim($this->input->post('pickup_date'));
            $data['pickup_time'] = trim($this->input->post('pickup_time'));
            $data['dropoff_date'] = trim($this->input->post('dropoff_date'));
            $data['dropoff_time'] = trim($this->input->post('dropoff_time'));
            
            $data['available_bikes'] = $this->searchbike_model->searchBikes($data['type_id'], $data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);

            $data['bikes'] = [];
            foreach($data['available_bikes'] as $row)
            {
                if( array_key_exists( $row['bike_type_id'], $data['bikes'] ) )
                {
                    $data['bikes'][$row['bike_type_id']][] = $row;
                }
                else
                {
                    $data['bikes'][$row['bike_type_id']][] = $row;
                }
            }
            unset($data['available_bikes']);

            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Success";
            $response["data"] = $data;
            die(json_encode($response));
        }
    }

    public function getRecord()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $booking_id = (isset($_GET['id']) && $_GET['id'] != "") ? intval($_GET['id']) : 0;
        if( $booking_id == 0 )
        {
            $response['error'] = 1;
            $response['error_message'] = "Record not found";
            die(json_encode($response));
        } 

        $biketypes = $this->biketypes_model->getAll();
        $data['biketypes'] = result_to_array($biketypes);
        $data['order'] = $this->bookings_model->getById($booking_id);
        $data['order_bike_types'] = $this->bookingbikes_model->getByBookingId($booking_id);
        $data['order_payment'] = $this->bookingpayment_model->getByBookingId($booking_id);
        $data['customer'] = $this->customers_model->getById($data['order']['customer_id']);

        $bike_assigned_ids = [];
        $bike_type_ids = "";
        $bike_type_names = "";
        $bike_type_array = [];
        $bike_type_qty = [];
        foreach($data['order_bike_types'] as $i => $row)
        {
          if( !in_array($row['type_id'], $bike_type_array) )
          {
            array_push($bike_type_array, $row['type_id']); 
            $bike_type_names .= ( $bike_type_names == "" ) ? $row['type'] : ",".$row['type'];
            $bike_type_qty[ $row['type'] ] = 1;
          }
          else
          {
            $bike_type_qty[ $row['type'] ] = $bike_type_qty[ $row['type'] ] + 1;
          }
          if( $row['bike_id'] != 0 && !in_array($row['bike_id'], $bike_assigned_ids) )
          {
            array_push($bike_assigned_ids, $row['bike_id']);
          }
        }
        $bike_type_ids = implode(",", $bike_type_array);
        $ordered_bike_qty = "";
        foreach($bike_type_qty as $btype => $bq)
        {
           $ordered_bike_qty .= ($ordered_bike_qty == "") ? "": ",";
           $ordered_bike_qty .= $btype." ( ".$bq." )";
        }

        if( count($bike_assigned_ids) == 0 )
        {
            $data['available_bikes'] = $this->searchbike_model->searchBikes($bike_type_ids, $data['order']['pickup_date'], $data['order']['pickup_time'], $data['order']['dropoff_date'], $data['order']['dropoff_time']);
        }
        else
        {
            $data['available_bikes'] = $this->bike_model->getBikes($bike_assigned_ids);
            foreach($data['available_bikes'] as $index => $row)
            {
                $row['rent_price'] = $this->searchbike_model->getRentPrice($row['bike_type_id'], $data['order']['pickup_date'], $data['order']['pickup_time'], $data['order']['dropoff_date'], $data['order']['dropoff_time']);
                $data['available_bikes'][$index] = $row;
            }
        }


        $d1= new DateTime($data['order']['dropoff_date']." ".$data['order']['dropoff_time']); // first date
        $d2= new DateTime($data['order']['pickup_date']." ".$data['order']['pickup_time']); // second date
        $interval= $d1->diff($d2); // get difference between two dates
        $data['period_days'] = $interval->days;
        $data['period_hours'] = $interval->h; 

        $data['weekend'] = 0;
        $data['public_holiday'] = 0;
        $data['holiday'] = 0;
        $date=date_create($data['order']['pickup_date']);
        $day = date_format($date,"D");
        if( $day == 'Fri' || $day == 'Sat' || $day == 'Sun' )
        {
            $data['weekend'] = 1;
        }
        $res = $this->publicholidays_model->checkRecordExists(dateformatdb($data['order']['pickup_date']));
        if( $res )
        {
            $data['public_holiday'] = 1;
        }

        $res = $this->holidays_model->checkRecordExists(dateformatdb($data['order']['pickup_date']));
        if( $res )
        {
            $data['holiday'] = 1;
        }

        foreach($data['available_bikes'] as $index => $bike)
        {
            if( in_array($bike['bike_type_id'], $bike_type_array))
            {
                $bike['bike_image'] = "";
                $bike_row = $this->bike_model->getImageForType($bike['bike_type_id']);
                if( count($bike_row) > 0 )
                {
                    $bike['bike_image'] = $bike_row['image'];
                }
            }                   
            $data['available_bikes'][$index] = $bike;
        }
        
        $data['ordered_bikes'] = $ordered_bike_qty;
        $data['bike_url'] = base_url('bikes/');

        $response['error'] = 0;
        $response['success_message'] = "Record found";
        $response['data'] = $data;
        die(json_encode($response));
    }

    public function whatsapp()
    {
        $booking_id = (isset($_GET['bid']) && $_GET['bid'] != "") ? intval($_GET['bid']) : 0;
        if( $booking_id == 0 )
        {
            redirect('admin/Bookings');
        } 
        $data['user'] = $this->session->userdata();
        $data['admin_phone'] = $this->users_model->getAdminPhone();
        $data['booking_id'] = $booking_id;
        $biketypes = $this->biketypes_model->getAll();
        $data['biketypes'] = result_to_array($biketypes);
        $data['order'] = $this->bookings_model->getById($booking_id);
        $data['order_bike_types'] = $this->bookingbikes_model->getByBookingId($booking_id);
        $data['customer'] = $this->customers_model->getById($data['order']['customer_id']);

        $bike_type_array = [];
        $bike_type_qty = [];
        foreach($data['order_bike_types'] as $i => $row)
        {
          if( !in_array($row['type_id'], $bike_type_array) )
          {
            array_push($bike_type_array, $row['type_id']); 
            $bike_type_qty[ $row['type'] ] = 1;
          }
          else
          {
            $bike_type_qty[ $row['type'] ] = $bike_type_qty[ $row['type'] ] + 1;
          }
        }
        $ordered_bike_qty = "";
        foreach($bike_type_qty as $btype => $bq)
        {
           $ordered_bike_qty .= ($ordered_bike_qty == "") ? $btype."(".$bq.")" : ";".$btype."(".$bq.")";
        }
        
        echo sendNewOrdertoCustomer($data['customer']['phone'], $data['customer']['name'], $booking_id, $ordered_bike_qty, dateformatuser($data['order']['pickup_date']), $data['order']['  pickup_time'], dateformatuser($data['order']['dropoff_date']), $data['order']['dropoff_time'], $data['order']['total_amount'], $data['order']['booking_amount']);
        echo sendNewOrderAlertToAdmin($admin['admin_phone'], $data['customer']['name'], $booking_id, $ordered_bike_qty, dateformatuser($data['order']['pickup_date'])." ".$data['order']['pickup_time'], $data['customer']['phone']);
    }

    public function whatsapp_reminder()
    {
        $booking_id = (isset($_GET['bid']) && $_GET['bid'] != "") ? intval($_GET['bid']) : 0;
        if( $booking_id == 0 )
        {
            redirect('admin/Bookings');
        } 
        $data['user'] = $this->session->userdata();
        $data['admin_phone'] = $this->users_model->getAdminPhone();
        $data['booking_id'] = $booking_id;
        $data['order'] = $this->bookings_model->getById($booking_id);
        $data['customer'] = $this->customers_model->getById($data['order']['customer_id']);
        
        echo sendReturnReminderTodayToCustomer($data['customer']['phone'], $data['customer']['name'], dateformatuser($data['order']['dropoff_date']), $data['order']['dropoff_time']);
    }

    public function whatsapp_pickup()
    {
        $booking_id = (isset($_GET['bid']) && $_GET['bid'] != "") ? intval($_GET['bid']) : 0;
        if( $booking_id == 0 )
        {
            redirect('admin/Bookings');
        } 
        $data['user'] = $this->session->userdata();
        $data['admin_phone'] = $this->users_model->getAdminPhone();
        $data['booking_id'] = $booking_id;
        $data['order'] = $this->bookings_model->getById($booking_id);
        $data['customer'] = $this->customers_model->getById($data['order']['customer_id']);
        
        echo sendPickupReminderTodayToCustomer($data['customer']['phone'], $data['customer']['name'], dateformatuser($data['order']['pickup_date']), $data['order']['pickup_time']);
    }

    public function whatsapp_pickup_second()
    {
        $booking_id = (isset($_GET['bid']) && $_GET['bid'] != "") ? intval($_GET['bid']) : 0;
        if( $booking_id == 0 )
        {
            redirect('admin/Bookings');
        } 
        $data['user'] = $this->session->userdata();
        $data['admin_phone'] = $this->users_model->getAdminPhone();
        $data['booking_id'] = $booking_id;
        $data['order'] = $this->bookings_model->getById($booking_id);
        $data['customer'] = $this->customers_model->getById($data['order']['customer_id']);
        
        echo sendPickupReminderTodayToCustomer2($data['customer']['phone'], $data['customer']['name'], dateformatuser($data['order']['pickup_date']), $data['order']['pickup_time']);
    }

    public function whatsapp_cancel()
    {
        $booking_id = (isset($_GET['bid']) && $_GET['bid'] != "") ? intval($_GET['bid']) : 0;
        if( $booking_id == 0 )
        {
            redirect('admin/Bookings');
        } 
        $data['user'] = $this->session->userdata();
        $data['admin_phone'] = $this->users_model->getAdminPhone();
        $data['booking_id'] = $booking_id;
        $data['order'] = $this->bookings_model->getById($booking_id);
        $data['customer'] = $this->customers_model->getById($data['order']['customer_id']);
        
        echo sendCancelReminderTodayToCustomer($data['customer']['phone'], $data['customer']['name'], dateformatuser($data['order']['pickup_date']), $data['order']['pickup_time']);
    }

    public function search()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 
        
        $this->form_validation->set_rules('bikeId','Bike','trim|required|max_length[128]');
        $this->form_validation->set_rules('pickup_date','pickup_date','trim|required|max_length[18]');
        $this->form_validation->set_rules('pickup_time','pickup_time','trim|required|max_length[15]');
        $this->form_validation->set_rules('dropoff_date','dropoff_date','trim|required|max_length[18]');
        $this->form_validation->set_rules('dropoff_time','dropoff_time','trim|required|max_length[15]');
                        
        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $data['bike_ids'] = $this->security->xss_clean($this->input->post('bikeId'));
            $data['pickup_date'] = $this->security->xss_clean($this->input->post('pickup_date'));
            $data['pickup_time'] = $this->security->xss_clean($this->input->post('pickup_time'));
            $data['dropoff_date'] = $this->security->xss_clean($this->input->post('dropoff_date'));
            $data['dropoff_time'] = $this->security->xss_clean($this->input->post('dropoff_time'));

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
            $data['holiday'] = 0;
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

            $res = $this->holidays_model->checkRecordExists(dateformatdb($data['pickup_date']));
            if( $res )
            {
                $data['holiday'] = 1;
            }

            $data['bike_availability'] = 0;
            $data['cart_bikes'] = $this->searchbike_model->searchBikes($data['bike_ids'], $data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);
            $bike_ids = explode(",", $data['bike_ids']);

            foreach($data['cart_bikes'] as $index => $bike)
            {
                if( in_array($bike['bike_type_id'], $bike_ids))
                {
                    $bike['quantity'] = $bike['available'];
                    if( $bike['available'] == "1" )
                    {
                        $data['bike_availability'] = intval($data['bike_availability']) + 1;
                    }
                }                   
                $data['cart_bikes'][$index] = $bike;
            }
            $response = array('error' => 0, 'error_message' => '', 'success_message' => 'success', 'data' => $data);
            die(json_encode($response));
        }
    }

    public function save()
    {
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 

        $this->form_validation->set_rules('pickup_date','Pickup date','trim|required|max_length[128]');
        $this->form_validation->set_rules('pickup_time','Pickup time','trim|required|max_length[128]');

        $this->form_validation->set_rules('dropoff_date','Dropoff date','trim|required|max_length[128]');
        $this->form_validation->set_rules('dropoff_time','Dropoff time','trim|required|max_length[128]');

        $this->form_validation->set_rules('biketype','Bike','trim|required|max_length[128]');
        $this->form_validation->set_rules('customer_id','Customer','trim|required|max_length[128]');
        $this->form_validation->set_rules('pickup_status','Pickup status','trim|required|max_length[128]');

        if($this->form_validation->run() == FALSE)
        {
            $response["error"] = 1;
            $response["error_message"] = $this->form_validation->error_string();
            die(json_encode($response));
        }
        else
        {
            $user = $this->session->userdata();
            $bike_id_string = trim($this->input->post('biketype'));
            $bike_count = trim($this->input->post('vehicle_count'));
            $bids = $this->input->post('vehicle_numbers');
            $bike_ids = json_decode($bids);
            if( gettype($bike_ids) == "string" )
            {
                $bike_ids = json_decode($bike_ids);
            }

            $data['pickup_date'] = trim($this->input->post('pickup_date'));
            $data['pickup_time'] = trim($this->input->post('pickup_time'));
            $data['dropoff_date'] = trim($this->input->post('dropoff_date'));
            $data['dropoff_time'] = trim($this->input->post('dropoff_time'));
            $data['helmets_qty'] = trim($this->input->post('helmets_qty'));
            $data['free_helmet'] = trim($this->input->post('free_helmet'));
            $data['early_pickup'] = trim($this->input->post('early_pickup'));
            $data['customer_id'] = trim($this->input->post('customer_id'));
            $data['paid'] = trim($this->input->post('paid'));
            $data['paymentOption'] = trim($this->input->post('paymentOption'));
            $data['delivery_notes'] = trim($this->input->post('delivery_notes'));
            $data['pickup_status'] = trim($this->input->post('pickup_status'));
            $data['refund_status'] = trim($this->input->post('refund_status'));

            $d1= new DateTime($data['dropoff_date']." ".$data['dropoff_time']); // first date
            $d2= new DateTime($data['pickup_date']." ".$data['pickup_time']); // second date
            $interval= $d1->diff($d2);
            $data['period_days'] = $interval->days;
            $data['period_hours'] = $interval->h; 
        
            $data['search_bikes'] = $this->searchbike_model->searchBikes($bike_id_string, $data['pickup_date'], $data['pickup_time'], $data['dropoff_date'], $data['dropoff_time']);

            $subtotal = 0;
            $total = 0;
            $gst = 0;
            $helmets_total = 0;
            $early_pickup = 0;
            $bikes_quantity = $bike_count;
            $refund_total = $bike_count * 1000;

            $data['cart_bikes'] = array();
            foreach($data['search_bikes'] as $bike) 
            {
                $rent_price = 0;
                foreach($bike_ids as $i => $obj) 
                {
                    if($obj->bike_id == $bike['bid'])
                    {
                        $subtotal += $obj->rent_price;
                        array_push($data['cart_bikes'], $bike);
                        break;
                    }
                }   
            }
            if( isset($data['helmets_qty']) && $data['helmets_qty'] > 0 )
            {
                //
            }
            else
            {
                $data['helmets_qty'] = 0;
            }

            if( isset($data['early_pickup']) && $data['early_pickup'] > 0 )
            {
                $early_pickup = 1;
            }
            else
            {
                $early_pickup = 0;
            }
            
            $gst = round($subtotal * 0.05, 2);
            $pmode_row = $this->paymentmode_model->getIdByMode($data['paymentOption']);

            $order_snap = [];

            // INSERT RECORDS
            $booking_record = array(
                    "customer_id" => $data['customer_id'],
                    "quantity" => $bikes_quantity,
                    "helmet_quantity" => $data['helmets_qty'],
                    "free_helmet" => $data['free_helmet'],
                    "booking_amount" => $data['paid'],
                    "total_amount" => $subtotal,
                    "gst" => $gst,
                    "refund_amount" => $refund_total,
                    "refund_status" => $data['refund_status'],
                    "payment_mode" => $pmode_row['id'],
                    "status" => $data['pickup_status'],
                    "pickup_date" => dateformatdb($data['pickup_date']),
                    "pickup_time" => $data['pickup_time'],
                    "dropoff_date" => dateformatdb($data['dropoff_date']),
                    "dropoff_time" => $data['dropoff_time'],
                    "early_pickup" => $early_pickup,
                    "delivery_notes" => $data['delivery_notes'],
                    "created_by" => $user['userId'],  
                );

            $order_snap['booking_record'] = $booking_record;
            
            $booking_id = $this->bookings_model->addNew($booking_record);
            if( $booking_id != "" )
            {
                $order_history["booking_id"] = $booking_id;
                foreach($data['cart_bikes'] as $bike) 
                {
                    $bookingbikes_record = array(
                        "booking_id" => $booking_id,
                        "type_id" => $bike['bike_type_id'],
                        "bike_id" => $bike['bid'],
                        "quantity" => 1,
                        "created_by" => $user['userId'],  
                    );
                    $this->bookingbikes_model->addNew($bookingbikes_record);

                    // update bike to unavailable
                    $this->bike_model->updateRecord(array("available" => 0), $bike['bid']);
                    $order_snap['booking_bikes_records'][] = $booking_record;
                }

                // Add Payment Record
                $booking_payment = array(
                    "booking_id" => $booking_id,
                    "amount" => $data['paid'],
                    "payment_mode" => $pmode_row['id'],
                    "created_by" => $user['userId']
                );
                $this->bookingpayment_model->addNew($booking_payment);
                $order_snap['booking_payment_record'] = $booking_payment;

                $data['payment_status'] = "Success";
                
                $response['booking_id'] = $booking_id;            
                $response["error"] = 0;
                $response["error_message"] = "";
                $response["success_message"] = "Record inserted successfully";

                // Save Snapshot
                $order_history["order_json"] = json_encode($order_snap);
                $order_history["created_by"] = $user['userId'];
                $this->orderhistory_model->addNew($order_history);

                die(json_encode($response));
            }
            else
            {
                $response["error"] = 1;
                $response["error_message"] = "Record insert failed.";
                die(json_encode($response));
            }

        }
    }

    public function update()
    {

        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $this->load->library('form_validation'); 

        if( isset($_POST['pickup_date']) && $_POST['pickup_date'] != "" )
        {
            $this->form_validation->set_rules('booking_id','Booking Id','trim|required|max_length[128]');
            $this->form_validation->set_rules('pickup_date','Pickup date','trim|required|max_length[128]');
            $this->form_validation->set_rules('pickup_time','Pickup time','trim|required|max_length[128]');

            $this->form_validation->set_rules('dropoff_date','Dropoff date','trim|required|max_length[128]');
            $this->form_validation->set_rules('dropoff_time','Dropoff time','trim|required|max_length[128]');
            $this->form_validation->set_rules('pickup_status','Pickup status','trim|required|max_length[128]');
            $this->form_validation->set_rules('refund_status','Refund status','trim|required|max_length[128]');

            if($this->form_validation->run() == FALSE)
            {
                $response["error"] = 1;
                $response["error_message"] = $this->form_validation->error_string();
                die(json_encode($response));
            }
            else
            {
                $data['pickup_date'] = trim($this->input->post('pickup_date'));
                $data['pickup_time'] = trim($this->input->post('pickup_time'));
                $data['dropoff_date'] = trim($this->input->post('dropoff_date'));
                $data['dropoff_time'] = trim($this->input->post('dropoff_time'));
                $data['helmets_qty'] = trim($this->input->post('helmets_qty'));
                $data['free_helmet'] = trim($this->input->post('free_helmet'));
                $data['early_pickup'] = trim($this->input->post('early_pickup'));
                $data['booking_id'] = trim($this->input->post('booking_id'));
                $data['order'] = $this->bookings_model->getById($data['booking_id']);
                $data['bike_types'] = $this->bookingbikes_model->getByBookingId($data['booking_id']);
                if( count($data['order']) == 0 )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Booking Id ".$data['booking_id']." not found.";
                    die(json_encode($response));
                }

                $user = $this->session->userdata();

                if( $this->input->post('free_helmet') != null ){
                    $data['free_helmet'] = trim($this->input->post('free_helmet'));
                }else{
                    $data['free_helmet'] = 0;
                }

                if( $this->input->post('extra_helemts') != null ){
                    $data['helmets_qty'] = trim($this->input->post('helmets_qty'));
                }else{
                    $data['helmets_qty'] = 0;
                }
                $data['delivery_notes'] = trim($this->input->post('delivery_notes'));
                $data['pickup_status'] = trim($this->input->post('pickup_status'));
                $data['refund_status'] = trim($this->input->post('refund_status'));
                $data['new_payment'] = trim($this->input->post('new_payment'));
                $data['order_bike_types'] = trim($this->input->post('order_bike_types'));
                
                $old_biketypes = [];
                foreach($data['bike_types'] as $obs)
                {
                    $old_biketypes[] = $obs['type_id'];
                }
                
                $obt_rows = explode(",", $data['order_bike_types']);
                $bikes_assigned = [];
                $bike_types_assigned = [];
                foreach($obt_rows as $row_id)
                {
                    if( !isset($_POST['assign_bike_row_'.$row_id]))
                    {
                        $response["error"] = 1;
                        $response["error_message"] = "Please assign vehicles.";
                        die(json_encode($response));
                    }
                    else if( isset($_POST['assign_bike_row_'.$row_id]) && $_POST['assign_bike_row_'.$row_id] == 0 )
                    {
                        $response["error"] = 1;
                        $response["error_message"] = "Please assign vehicles.";
                        die(json_encode($response));
                    }
                    else
                    {
                        if( !in_array( $_POST['assign_bike_row_'.$row_id], $bikes_assigned ) )
                        {
                            $bikes_assigned[] = $_POST['assign_bike_row_'.$row_id];
                            $bike_types_assigned[] = $_POST['assign_biketype_row_'.$row_id];
                        }
                        else
                        {
                            $response["error"] = 1;
                            $response["error_message"] = "Assigned same vehicle multiple times.";
                            die(json_encode($response));
                        }
                    }
                }
                $order_snap = [];
                $diff = array_diff_assoc($old_biketypes, $bike_types_assigned);
                if( count($diff) > 0 )
                {
                    // New Bikes assigned
                    $total = 0;
                    $gst = 0;

                    // OLD BIKES FREE
                    foreach($data['bike_types'] as $obs)
                    {
                        if( $obs['bike_id'] != 0 )
                        {
                            $this->bike_model->updateRecord(array("available" => 1), $obs['bike_id']);
                        }
                    }
                    $this->bookingbikes_model->deleteByBookingId($data['booking_id']);

                    $bike_total = 0;
                    // INSERT NEW BIKE TYPES
                    foreach($obt_rows as $row_id)
                    {
                        $bike_id = $_POST['assign_bike_row_'.$row_id];
                        $bike_type_id = $_POST['assign_biketype_row_'.$row_id];
                        $rent = $_POST['assign_bike_rent_'.$row_id];

                        $bookingbikes_record = array(
                            "booking_id" => $data['booking_id'],
                            "type_id" => $bike_type_id,
                            "bike_id" => $bike_id,
                            "quantity" => 1,
                            "created_by" => $user['userId'],  
                        );
                        $this->bookingbikes_model->addNew($bookingbikes_record);
                        $order_snap['booking_bikes_records'][] = $bookingbikes_record;

                        if( $data['pickup_status'] == 1 )
                        {
                            // update bikerecord to unavailable
                            $this->bike_model->updateRecord(array("available" => 0), $bike_id);
                        }
                        else
                        {
                            // update bikerecord to available
                            $this->bike_model->updateRecord(array("available" => 1), $bike_id);
                        }

                        $bike_total += $rent;
                    }

                    $total = $bike_total;
                    $gst = round(($bike_total * 0.05), 2);

                    $booking_record = array(
                        "pickup_date" => dateformatdb($data['pickup_date']),
                        "pickup_time" => $data['pickup_time'],
                        "dropoff_date" => dateformatdb($data['dropoff_date']),
                        "dropoff_time" => $data['dropoff_time'],
                        "total_amount" => $total,
                        "gst" => $gst,
                        "helmet_quantity" => $data['helmets_qty'],
                        "free_helmet" => $data['free_helmet'],
                        "refund_status" => $data['refund_status'],
                        "status" => $data['pickup_status'],
                        "delivery_notes" => $data['delivery_notes'],  
                    );
                    $this->bookings_model->updateRecord($booking_record, $data['booking_id']);
                    $order_snap['booking_record'] = $booking_record;
                }
                else
                {
                    $booking_record = array(
                        "pickup_date" => dateformatdb($data['pickup_date']),
                        "pickup_time" => $data['pickup_time'],
                        "dropoff_date" => dateformatdb($data['dropoff_date']),
                        "dropoff_time" => $data['dropoff_time'],
                        "helmet_quantity" => $data['helmets_qty'],
                        "free_helmet" => $data['free_helmet'],
                        "refund_status" => $data['refund_status'],
                        "status" => $data['pickup_status'],
                        "delivery_notes" => $data['delivery_notes'],  
                    );
                
                    $this->bookings_model->updateRecord($booking_record, $data['booking_id']);
                    $order_snap['booking_record'] = $booking_record;
                    
                    foreach($obt_rows as $row_id)
                    {
                        $old_row = $this->bookingbikes_model->getById($row_id);

                        $bike_id = $_POST['assign_bike_row_'.$row_id];
                        $bike_type_id = $_POST['assign_biketype_row_'.$row_id];

                        if( $old_row['type_id'] !== $bike_type_id )
                        {
                            if( $old_row['bike_id'] != 0 )
                            {
                                $this->bike_model->updateRecord(array("available" => 1), $old_row['bike_id']);
                            }
                        }

                        $this->bookingbikes_model->updateRecord(array("bike_id" => $bike_id, "type_id" => $bike_type_id), $row_id);
                        $order_snap['booking_bikes_records'][] = array("bike_id" => $bike_id, "type_id" => $bike_type_id);
                        if( $data['pickup_status'] == 1 )
                        {
                            // update bikerecord to unavailable
                            $this->bike_model->updateRecord(array("available" => 0), $bike_id);
                        }
                        else
                        {
                            // update bikerecord to available
                            $this->bike_model->updateRecord(array("available" => 1), $bike_id);
                        }
                    }
                }
                

                if( $data['new_payment'] != "" && $data['new_payment'] != 0 )
                {
                    $booking_payment = array(
                        "booking_id" => $data['booking_id'],
                        "amount" => $data['new_payment'],
                        "payment_mode" => 1,
                        "created_by" => $user['userId']
                    );
                    $this->bookingpayment_model->addNew($booking_payment);
                    $order_snap['booking_payment_record'] = $booking_payment;
                }

                // Save Snapshot
                $order_history["booking_id"] = $data['booking_id'];
                $order_history["order_json"] = json_encode($order_snap);
                $order_history["created_by"] = $user['userId'];
                $this->orderhistory_model->addNew($order_history);
                
                $response["error"] = 0;
                $response["error_message"] = "";
                $response["success_message"] = "Record updated successfully";

                die(json_encode($response));
            }
        }
        else
        {
            $this->form_validation->set_rules('booking_id','Booking Id','trim|required|max_length[128]');
            $this->form_validation->set_rules('pickup_status','Pickup status','trim|required|max_length[128]');
            $this->form_validation->set_rules('refund_status','Refund status','trim|required|max_length[128]');

            if($this->form_validation->run() == FALSE)
            {
                $response["error"] = 1;
                $response["error_message"] = $this->form_validation->error_string();
                die(json_encode($response));
            }
            else
            {
                // check booking id
                $data['booking_id'] = trim($this->input->post('booking_id'));
                $data['order'] = $this->bookings_model->getById($data['booking_id']);
                $data['bike_types'] = $this->bookingbikes_model->getByBookingId($data['booking_id']);
                if( count($data['order']) == 0 )
                {
                    $response["error"] = 1;
                    $response["error_message"] = "Booking Id ".$data['booking_id']." not found.";
                    die(json_encode($response));
                }

                $user = $this->session->userdata();

                if( $this->input->post('free_helmet') != null ){
                    $data['free_helmet'] = trim($this->input->post('free_helmet'));
                }else{
                    $data['free_helmet'] = 0;
                }

                if( $this->input->post('extra_helemts') != null ){
                    $data['helmets_qty'] = trim($this->input->post('helmets_qty'));
                }else{
                    $data['helmets_qty'] = 0;
                }

                $data['delivery_notes'] = trim($this->input->post('delivery_notes'));
                $data['pickup_status'] = trim($this->input->post('pickup_status'));
                $data['refund_status'] = trim($this->input->post('refund_status'));
                $data['new_payment'] = trim($this->input->post('new_payment'));
                $data['order_bike_types'] = trim($this->input->post('order_bike_types'));

                $old_biketypes = [];
                foreach($data['bike_types'] as $obs)
                {
                    $old_biketypes[] = $obs['type_id'];
                }
                
                $obt_rows = explode(",", $data['order_bike_types']);
                $bikes_assigned = [];
                $bike_types_assigned = [];
                foreach($obt_rows as $row_id)
                {
                    if( !isset($_POST['assign_bike_row_'.$row_id]))
                    {
                        $response["error"] = 1;
                        $response["error_message"] = "Please assign vehicles.";
                        die(json_encode($response));
                    }
                    else if( isset($_POST['assign_bike_row_'.$row_id]) && $_POST['assign_bike_row_'.$row_id] == 0 )
                    {
                        $response["error"] = 1;
                        $response["error_message"] = "Please assign vehicles.";
                        die(json_encode($response));
                    }
                    else
                    {
                        if( !in_array( $_POST['assign_bike_row_'.$row_id], $bikes_assigned ) )
                        {
                            $bikes_assigned[] = $_POST['assign_bike_row_'.$row_id];
                            $bike_types_assigned[] = $_POST['assign_biketype_row_'.$row_id];
                        }
                        else
                        {
                            $response["error"] = 1;
                            $response["error_message"] = "Assigned same vehicle multiple times.";
                            die(json_encode($response));
                        }
                    }
                }
                $order_snap = [];
                $diff = array_diff_assoc($old_biketypes, $bike_types_assigned);
                if( count($diff) > 0 )
                {
                    // New Bikes assigned
                    $total = 0;
                    $gst = 0;

                    // OLD BIKES FREE
                    foreach($data['bike_types'] as $obs)
                    {
                        if( $obs['bike_id'] != 0 )
                        {
                            $this->bike_model->updateRecord(array("available" => 1), $obs['bike_id']);
                        }
                    }
                    $this->bookingbikes_model->deleteByBookingId($data['booking_id']);

                    $bike_total = 0;
                    // INSERT NEW BIKE TYPES
                    foreach($obt_rows as $row_id)
                    {
                        $bike_id = $_POST['assign_bike_row_'.$row_id];
                        $bike_type_id = $_POST['assign_biketype_row_'.$row_id];
                        $rent = $_POST['assign_bike_rent_'.$row_id];

                        $bookingbikes_record = array(
                            "booking_id" => $data['booking_id'],
                            "type_id" => $bike_type_id,
                            "bike_id" => $bike_id,
                            "quantity" => 1,
                            "created_by" => $user['userId'],  
                        );
                        $this->bookingbikes_model->addNew($bookingbikes_record);
                        $order_snap['booking_bikes_records'][] = $bookingbikes_record;

                        if( $data['pickup_status'] == 1 )
                        {
                            // update bikerecord to unavailable
                            $this->bike_model->updateRecord(array("available" => 0), $bike_id);
                        }
                        else
                        {
                            // update bikerecord to available
                            $this->bike_model->updateRecord(array("available" => 1), $bike_id);
                        }

                        $bike_total += $rent;
                    }

                    $total = $bike_total;
                    $gst = round(($bike_total * 0.05), 2);

                    $booking_record = array(
                        "total_amount" => $total,
                        "gst" => $gst,
                        "helmet_quantity" => $data['helmets_qty'],
                        "free_helmet" => $data['free_helmet'],
                        "refund_status" => $data['refund_status'],
                        "status" => $data['pickup_status'],
                        "delivery_notes" => $data['delivery_notes'],  
                    );
                    $this->bookings_model->updateRecord($booking_record, $data['booking_id']);
                    $order_snap['booking_record'] = $booking_record;
                }
                else
                {
                    $booking_record = array(
                        "helmet_quantity" => $data['helmets_qty'],
                        "free_helmet" => $data['free_helmet'],
                        "refund_status" => $data['refund_status'],
                        "status" => $data['pickup_status'],
                        "delivery_notes" => $data['delivery_notes'],  
                    );
                
                    $this->bookings_model->updateRecord($booking_record, $data['booking_id']);
                    $order_snap['booking_record'] = $booking_record;
                    
                    foreach($obt_rows as $row_id)
                    {
                        $old_row = $this->bookingbikes_model->getById($row_id);

                        $bike_id = $_POST['assign_bike_row_'.$row_id];
                        $bike_type_id = $_POST['assign_biketype_row_'.$row_id];

                        if( $old_row['type_id'] !== $bike_type_id )
                        {
                            if( $old_row['bike_id'] != 0 )
                            {
                                $this->bike_model->updateRecord(array("available" => 1), $old_row['bike_id']);
                            }
                        }

                        $this->bookingbikes_model->updateRecord(array("bike_id" => $bike_id, "type_id" => $bike_type_id), $row_id);
                        $order_snap['booking_bikes_records'][] = array("bike_id" => $bike_id, "type_id" => $bike_type_id);
                        if( $data['pickup_status'] == 1 )
                        {
                            // update bikerecord to unavailable
                            $this->bike_model->updateRecord(array("available" => 0), $bike_id);
                        }
                        else
                        {
                            // update bikerecord to available
                            $this->bike_model->updateRecord(array("available" => 1), $bike_id);
                        }
                    }
                }
                

                if( $data['new_payment'] != "" && $data['new_payment'] != 0 )
                {
                    $booking_payment = array(
                        "booking_id" => $data['booking_id'],
                        "amount" => $data['new_payment'],
                        "payment_mode" => 1,
                        "created_by" => $user['userId']
                    );
                    $this->bookingpayment_model->addNew($booking_payment);
                    $order_snap['booking_payment_record'] = $booking_payment;
                }

                // Save Snapshot
                $order_history["booking_id"] = $data['booking_id'];
                $order_history["order_json"] = json_encode($order_snap);
                $order_history["created_by"] = $user['userId'];
                $this->orderhistory_model->addNew($order_history);
                
                $response["error"] = 0;
                $response["error_message"] = "";
                $response["success_message"] = "Record updated successfully";

                die(json_encode($response));
            }
        }
    }

    public function cancel()
    {
        $record_id = intval($this->uri->segment(4));
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $user = $this->session->userdata();

        if( $user['user_type'] !== "Admin" )
        {
            $response["error"] = 1;
            $response["error_message"] = "Your have no permission.";   
            die(json_encode($response));
        }
        if( $record_id == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Invalid Request";
            die(json_encode($response));
        }
        
        $data['record'] = $this->bookings_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            if( $data['record']['status'] == 0 )
            {
                $order_snap = [];

                $booking_record = array(
                    "status" => 3,
                    "cancel" => 1,
                    "cancel_by" => $user['userId'],
                    "cancel_date" => date("Y-m-d H:i:s")  
                );
                $this->bookings_model->updateRecord($booking_record, $record_id);
                $order_snap['booking_record'] = $booking_record;

                $order_history["booking_id"] = $record_id;
                $order_history["order_json"] = json_encode($order_snap);
                $order_history["created_by"] = $user['userId'];
                $this->orderhistory_model->addNew($order_history);
            }

            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record updated successfully";
        }
        
        die(json_encode($response));
    }

    public function deleteRecord()
    {
        $record_id = intval($this->uri->segment(4));
        $response = array("error" => 0, "error_message" => "", "success_message" => "");
        $user = $this->session->userdata();

        if( $user['user_type'] !== "Admin" )
        {
            $response["error"] = 1;
            $response["error_message"] = "Your have no permission.";   
            die(json_encode($response));
        }
        if( $record_id == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Invalid Request";
            die(json_encode($response));
        }
        
        $data['record'] = $this->bookings_model->getById($record_id);
        if( count($data['record']) == 0 )
        {   
            $response["error"] = 1;
            $response["error_message"] = "Record not found";
        }
        else
        {
            if( $data['record']['status'] >= 1 )
            {
                $data['order_bike_types'] = $this->bookingbikes_model->getByBookingId($record_id);
                foreach($data['order_bike_types'] as $row)
                {
                    // update bikerecord to unavailable
                    $this->bike_model->updateRecord(array("available" => 1), $row['bike_id']);
                }
            }

            $this->bookingpayment_model->deleteByBookingId($record_id);
            $this->bookingbikes_model->deleteByBookingId($record_id);
            $this->bookings_model->deleteRecord($record_id);
            $response["error"] = 0;
            $response["error_message"] = "";
            $response["success_message"] = "Record deleted successfully";
        }
        
        die(json_encode($response));
    }
    
}

?>