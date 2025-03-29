<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Searchbike_model
 * Searchbike model class to search available bikes for booking 
 */
class Searchbike_model extends CI_Model
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bike_model');
        $this->load->model('manufacturer_model');
        $this->load->model('biketypes_model');
        $this->load->model('prices_model');
        $this->load->model('publicholidays_model');
    }

    public function checkDay( $_date )
    {
        $weekday = false;
        $weekend = false;
        $public_holiday = false;
        $date = date_create($_date);
        $day = date_format($date, "D");
        if( $day == 'Fri' || $day == 'Sat' || $day == 'Sun' )
        {
            $weekend = true;
        }
        else
        {
            $weekday = true;
        }
        $res = $this->publicholidays_model->checkRecordExists(dateformatdb($_date));
        if( $res )
        {
            $public_holiday = true;
        }
        return array($weekday, $weekend, $public_holiday);
    }

    public function getDayPrice($_date, $h, $price)
    {
        $rent_price = 0;
        $day_type = $this->checkDay($_date);
        if( $h == 'half' ) {
            if( $day_type[2] ) {
                $rent_price = $price['holiday_day_half_price'];    
            } else if( $day_type[1] ) {
                $rent_price = $price['weekend_day_half_price'];
            } else {
                $rent_price = $price['week_day_half_price'];
            }
        } else {
            if( $day_type[2] ) {
                $rent_price = $price['holiday_day_price'];    
            } else if( $day_type[1] ) {
                $rent_price = $price['weekend_day_price'];
            } else {
                $rent_price = $price['week_day_price'];
            }
        }
        return $rent_price;
    }

    public function getRentPrice($bike_type_id, $pickup_date, $pickup_time, $dropoff_date, $dropoff_time)
    {
        $rent_price = 0;
        $this->db->select('*');
        $this->db->from('tbl_prices');
        $this->db->where('tbl_prices.type_id', $bike_type_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $price = $query->row_array();
            $d1= new DateTime($dropoff_date." ".$dropoff_time); // first date
            $d2= new DateTime($pickup_date." ".$pickup_time); // second date
            $interval= $d1->diff($d2); 
            $days = $interval->days;
            
            // Same Day
            if( $pickup_date == $dropoff_date ) 
            {
                //echo "Same day";
                $day_type = $this->checkDay($pickup_date);
                if( $interval->h < 4 ) 
                {
                    if( $day_type[2] ) {
                        $rent_price = $price['holiday_day_half_price'];    
                    } else if( $day_type[1] ) {
                        $rent_price = $price['weekend_day_half_price'];
                    } else {
                        $rent_price = $price['week_day_half_price'];
                    }
                } else {
                    if( $day_type[2] ) {
                        $rent_price = $price['holiday_day_price'];    
                    } else if( $day_type[1] ) {
                        $rent_price = $price['weekend_day_price'];
                    } else {
                        $rent_price = $price['week_day_price'];
                    }
                }
            }
            else
            {
                $d1= new DateTime($pickup_date." 08:00:00 PM"); // first date
                $d2= new DateTime($pickup_date." ".$pickup_time); // second date
                $interval= $d1->diff($d2); 
                if( $interval->h > 4 )
                {
                    $rent_price += $this->getDayPrice($pickup_date, 'full', $price);    
                }
                else
                {
                    $rent_price += $this->getDayPrice($pickup_date, 'half', $price);
                }
                
                $d1 = new DateTime($dropoff_date." 00:00:00"); // first date
                $d2 = new DateTime($pickup_date." 07:30:00"); // second date
                $interval = $d1->diff($d2); 

                if( $interval->days == 0 )
                {
                    if( $interval->h > 4 )
                    {
                        $rent_price += $this->getDayPrice($dropoff_date, 'full', $price);    
                    }
                    else
                    {
                        $rent_price += $this->getDayPrice($dropoff_date, 'half', $price);
                    }
                }
                else if( $interval->days > 0 )
                {
                    $days = $interval->days;
                    $nxt_date = $pickup_date;
                    for($i = 0; $i < $days; $i++)
                    {
                        $now = new DateTime($nxt_date." 23:59:59");
                        $nxt_date = $now->modify('+1 day')->format('Y-m-d');
                        $p = $this->getDayPrice($nxt_date, 'full', $price);
                        $rent_price += $this->getDayPrice($nxt_date, 'full', $price);
                        $nxt_date = $now->format("Y-m-d");
                    }

                    $d1 = new DateTime($dropoff_date." ".$dropoff_time); // second date
                    $d2 = new DateTime($dropoff_date." 00:00:00"); // first date
                    $interval= $d1->diff($d2);
                    if( $interval->h > 12 )
                    {
                        $rent_price += $this->getDayPrice($dropoff_date, 'full', $price);
                    }
                    else
                    {
                        $rent_price += $this->getDayPrice($dropoff_date, 'half', $price);
                    }
                }
                
            }            
        }
        return $rent_price;
    }

	public function getAvailableBikes($pickup_date, $pickup_time, $dropoff_date, $dropoff_time)
	{
        $this->db->group_by('tbl_bike_types.id');
		$this->db->order_by('tbl_bike_types.cc', 'ASC');
        $this->db->select('tbl_bike_types.image,tbl_bike_types.milage,tbl_bike_types.power,tbl_bike_types.cc,COUNT(tbl_bikes.id) as bikes_available, tbl_bike_types.type as bike_type_name,tbl_bike_types.id as bike_type_id, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id', 'left');
        $query = $this->db->get();

        $sub_query = "SELECT tbl_booking_bikes.type_id as bike_type_id, COUNT(tbl_booking_bikes.bike_id) as not_available FROM tbl_bookings LEFT JOIN tbl_booking_bikes ON tbl_booking_bikes.booking_id=tbl_bookings.id 
        LEFT JOIN tbl_bikes ON tbl_booking_bikes.bike_id=tbl_bikes.id 
        WHERE tbl_bookings.pickup_date >= '".dateformatdb($pickup_date)."' AND tbl_bookings.dropoff_date <= '".dateformatdb($dropoff_date)."' GROUP BY tbl_booking_bikes.type_id";

        $sub_query1 = $this->db->query($sub_query);
        $result1 = array();
        if( $sub_query1->num_rows() > 0 )
        {
            $result1 = $sub_query1->result_array();
        }
        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            foreach($result as $index => $row)
            {
                //echo "\n\n".$row['bike_type_id']."===".$row['bike_type_name'];
                $row['rent_price'] = $this->getRentPrice($row['bike_type_id'], $pickup_date, $pickup_time, $dropoff_date, $dropoff_time);
                //echo "\n======".$row['rent_price']."";
                $result[$index] = $row;
                foreach($result1 as $row1)
                {
                    if( $row['bike_type_id'] == $row1['bike_type_id'] )
                    {
                        $row['not_available'] = $row1['not_available'];
                    }
                    $result[$index] = $row;
                }
            }
            return $result;
        } 
        else 
        {
            return array();
        }
	}

    public function searchBikes($bike_type_ids, $pickup_date, $pickup_time, $dropoff_date, $dropoff_time)
    {
        if( $bike_type_ids == "" )
        {
            return array();
        }
        $this->db->order_by('tbl_bike_types.id', 'ASC');
        $this->db->select('tbl_bikes.id as bid,tbl_bike_types.image,tbl_bike_types.milage,tbl_bike_types.power,tbl_bike_types.cc,tbl_bikes.vehicle_number,tbl_bikes.available, tbl_bike_types.type as bike_type_name,tbl_bike_types.id as bike_type_id, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id', 'left');
        $this->db->where("tbl_bike_types.id IN (".$bike_type_ids.") ");

        $query = $this->db->get();

        $sub_query = "SELECT tbl_booking_bikes.type_id as bike_type_id, COUNT(tbl_booking_bikes.bike_id) as not_available FROM tbl_bookings LEFT JOIN tbl_booking_bikes ON tbl_booking_bikes.booking_id=tbl_bookings.id LEFT JOIN tbl_bikes ON tbl_booking_bikes.bike_id=tbl_bikes.id 
        WHERE ( tbl_bookings.pickup_date = '".dateformatdb($pickup_date)."' OR tbl_bookings.dropoff_date='".dateformatdb($dropoff_date)."') GROUP BY tbl_booking_bikes.type_id";

        $sub_query1 = $this->db->query($sub_query);
        $result1 = array();
        if( $sub_query1->num_rows() > 0 )
        {
            $result1 = $sub_query1->result_array();
        }

        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            foreach($result as $index => $row)
            {
                $row['rent_price'] = $this->getRentPrice($row['bike_type_id'], $pickup_date, $pickup_time, $dropoff_date, $dropoff_time);
                $result[$index] = $row;
            }
            return $result;
        } 
        else 
        {
            return array();
        }
    }

    public function getCartBikes($bike_ids, $pickup_date, $pickup_time, $dropoff_date, $dropoff_time)
    {
        if( $bike_ids == "" )
        {
            return array();
        }
        $this->db->group_by('tbl_bike_types.id');
        $this->db->order_by('tbl_bike_types.cc', 'ASC');
        $this->db->select('tbl_bike_types.image,tbl_bike_types.milage,tbl_bike_types.power,tbl_bike_types.cc, tbl_bikes.vehicle_number,COUNT(tbl_bikes.id) as bikes_available, tbl_bike_types.type as bike_type_name,tbl_bike_types.id as bike_type_id, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id', 'left');
        $this->db->where("tbl_bike_types.id IN (".$bike_ids.") ");
        $query = $this->db->get();

        $sub_query = "SELECT tbl_booking_bikes.type_id as bike_type_id, COUNT(tbl_booking_bikes.bike_id) as not_available FROM tbl_bookings LEFT JOIN tbl_booking_bikes ON tbl_booking_bikes.booking_id=tbl_bookings.id LEFT JOIN tbl_bikes ON tbl_booking_bikes.bike_id=tbl_bikes.id 
        WHERE ( tbl_bookings.pickup_date = '".dateformatdb($pickup_date)."' OR tbl_bookings.dropoff_date='".dateformatdb($dropoff_date)."') GROUP BY tbl_booking_bikes.type_id";

        $sub_query1 = $this->db->query($sub_query);
        $result1 = array();
        if( $sub_query1->num_rows() > 0 )
        {
            $result1 = $sub_query1->result_array();
        }

        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            foreach($result as $index => $row)
            {
                $row['rent_price'] = $this->getRentPrice($row['bike_type_id'], $pickup_date, $pickup_time, $dropoff_date, $dropoff_time);
                $result[$index] = $row;
                foreach($result1 as $row1)
                {
                    if( $row['bike_type_id'] == $row1['bike_type_id'] )
                    {
                        $row['bikes_available'] = $row['bikes_available'] - $row1['not_available'];
                    }
                    $result[$index] = $row;
                }
            }
            return $result;
        } 
        else 
        {
            return array();
        }
    }

    public function getBikesByType()
    {
        $this->db->group_by('tbl_bike_types.id');
        $this->db->order_by('tbl_bike_types.cc', 'ASC');
        $this->db->select('tbl_bike_types.id as bike_type_id,tbl_bike_types.type as bike_type_name, tbl_bike_types.image, tbl_bike_types.cc, tbl_bike_types.milage, tbl_bike_types.power, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_bike_types.id = tbl_prices.type_id', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

}