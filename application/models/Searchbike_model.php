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

	public function getAvailableBikes()
	{
		$this->db->order_by('tbl_bikes.id', 'ASC');
        $this->db->select('tbl_bikes.*, tbl_manufacturer.name as manufacturer,tbl_bike_types.type as bike_type, tbl_prices.*');
        $this->db->from('tbl_bikes');
        $this->db->join('tbl_manufacturer', 'tbl_manufacturer.id = tbl_bikes.manufacturer_id');
        $this->db->join('tbl_bike_types', 'tbl_bike_types.id = tbl_bikes.type_id');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
	}

}