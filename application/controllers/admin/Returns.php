<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Returns
 * Returns class to control to manage Returns data
 */
class Returns extends CI_Controller
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
            $data['user'] = $this->session->userdata();
            $data['page_title'] = "Vehicle Returns";
            $biketypes = $this->biketypes_model->getAll();
            $data['biketypes'] = result_to_array($biketypes);
            $data['records'] = $this->bookings_model->getAllReturnsToday();
            
            $this->load->view('layout_admin/header', $data);
            $this->load->view('backend/returns', $data);
            $this->load->view('layout_admin/footer');
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
          if( !in_array($row['bike_id'], $bike_assigned_ids) )
          {
            array_push($bike_assigned_ids, $row['bike_id']);
          }
        }
        $bike_type_ids = implode(",", $bike_type_array);
        $ordered_bike_qty = "";
        foreach($bike_type_qty as $btype => $bq)
        {
           $ordered_bike_qty .= "<span class='w-100 text-danger font-bold d-block'>".$btype." ( ".$bq." Nos. )</span>";
        }

        if( count($bike_assigned_ids) == 0 )
        {
            $data['available_bikes'] = $this->searchbike_model->searchBikes($bike_type_ids, $data['order']['pickup_date'], $data['order']['pickup_time'], $data['order']['dropoff_date'], $data['order']['dropoff_time']);
        }
        else
        {
            $data['available_bikes'] = $this->bike_model->getBikes($bike_assigned_ids);
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
        if( $day == 'Sat' || $day == 'Sun' )
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
                $bike['rent_price'] = 0;
                $bike['bike_image'] = "";
                $bike_row = $this->bike_model->getImageForType($bike['bike_type_id']);
                if( count($bike_row) > 0 )
                {
                    $bike['bike_image'] = $bike_row['image'];
                }

                if( $data['period_days'] > 0 || $data['period_hours'] > 4  ){
                    $duration = "day";
                    if( $data['public_holiday'] == 1 ){
                        $bike['rent_price'] = $bike['holiday_day_price'];
                    }
                    elseif( $data['weekend'] == 1 ){
                        $bike['rent_price'] = $bike['weekend_day_price'];
                    } else {
                        $bike['rent_price'] = $bike['week_day_price'];
                    }
                } else {
                    $duration = "halfday";
                    if( $data['public_holiday'] == 1 ){
                        $bike['rent_price'] = $bike['holiday_day_half_price'];
                    } elseif( $data['weekend'] == 1 ){
                        $bike['rent_price'] = $bike['weekend_day_half_price'];
                    } else {
                        $bike['rent_price'] = $bike['week_day_half_price'];
                    } 
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
    
}

?>