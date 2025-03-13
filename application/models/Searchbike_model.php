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
    }

	public function getAvailableBikes($pickup_date, $pickup_time, $dropoff_date, $dropoff_time)
	{
        $this->db->group_by('tbl_bike_types.id');
		$this->db->order_by('tbl_bikes.cc', 'ASC');
        $this->db->select('tbl_bikes.image,tbl_bikes.milage,tbl_bikes.power,tbl_bikes.cc,COUNT(tbl_bikes.id) as bikes_available, tbl_bike_types.type as bike_type_name,tbl_bike_types.id as bike_type_id, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id', 'left');
        $query = $this->db->get();

        //echo "<pre>".$this->db->last_query();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
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
        $this->db->select('tbl_bikes.id as bid,tbl_bikes.image,tbl_bikes.model,tbl_bikes.milage,tbl_bikes.power,tbl_bikes.cc, tbl_bikes.vehicle_number,tbl_bikes.available, tbl_bike_types.type as bike_type_name,tbl_bike_types.id as bike_type_id, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id', 'left');
        $this->db->where("tbl_bike_types.id IN (".$bike_type_ids.") ");
        $this->db->where("tbl_bikes.id NOT IN (SELECT tbl_booking_bikes.bike_id FROM tbl_bookings
        LEFT JOIN tbl_booking_bikes ON tbl_booking_bikes.booking_id=tbl_bookings.id
        LEFT JOIN tbl_bikes ON tbl_booking_bikes.bike_id=tbl_bikes.id
        WHERE pickup_date >= '".$pickup_date."' AND dropoff_date <= '".$dropoff_date."' AND tbl_bikes.available = 0)
        ");

        $query = $this->db->get();

        //echo "<pre>".$this->db->last_query();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
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
        $this->db->order_by('tbl_bikes.cc', 'ASC');
        $this->db->select('tbl_bikes.image,tbl_bikes.model,tbl_bikes.milage,tbl_bikes.power,tbl_bikes.cc, tbl_bikes.vehicle_number,COUNT(tbl_bikes.id) as bikes_available, tbl_bike_types.type as bike_type_name,tbl_bike_types.id as bike_type_id, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id', 'left');
        $this->db->where("tbl_bike_types.id IN (".$bike_ids.") ");
        $query = $this->db->get();

        //echo "<pre>".$this->db->last_query();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getBikesByType()
    {
        $this->db->group_by('tbl_bike_types.id');
        $this->db->order_by('tbl_bikes.cc', 'ASC');
        $this->db->select('tbl_bike_types.id as bike_type_id,tbl_bike_types.type as bike_type_name, tbl_bikes.image, tbl_bikes.cc, tbl_bikes.milage, tbl_bikes.power, tbl_prices.*');
        $this->db->from('tbl_bike_types');
        $this->db->join('tbl_bikes', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_prices', 'tbl_bike_types.id = tbl_prices.type_id', 'left');
        $query = $this->db->get();

        //echo "<pre>".$this->db->last_query();
        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

}