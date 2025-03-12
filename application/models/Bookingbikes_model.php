<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bookings_model (Bookings Model)
 * Bookings model class to manage Bookings master data 
 */
class Bookingbikes_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_booking_bikes.id', 'ASC');
        $this->db->select('tbl_booking_bikes.*, tbl_users.name as created_by');
        $this->db->from('tbl_booking_bikes');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_booking_bikes.created_by');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }
            
    function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_booking_bikes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        } else {
            return array();
        }
    }

    function getByBookingId($booking_id)
    {
        $this->db->select('tbl_booking_bikes.*, tbl_bike_types.type, tbl_bikes.vehicle_number');
        $this->db->from('tbl_booking_bikes');
        $this->db->join('tbl_bike_types', 'tbl_booking_bikes.type_id = tbl_bike_types.id', 'left');
        $this->db->join('tbl_bikes', 'tbl_booking_bikes.bike_id = tbl_bikes.id', 'left');
        $this->db->where('booking_id', $booking_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }  

    
    function getByTypeId($booking_id, $type_id)
    {
        $this->db->limit(1);
        $this->db->select('tbl_booking_bikes.*, tbl_bike_types.type');
        $this->db->from('tbl_booking_bikes');
        $this->db->join('tbl_bike_types', 'tbl_booking_bikes.type_id = tbl_bike_types.id', 'left');
        $this->db->where('booking_id', $booking_id);
        $this->db->where('type_id', $type_id);
        $this->db->where('bike_id =', 0);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    } 
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNew($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_booking_bikes', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_booking_bikes', $info);
        
        $this->db->trans_complete();
        
        return true;
    }

    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_booking_bikes');
        
        $this->db->trans_complete();
        
        return true;
    }

    function deleteByBookingId($booking_id)
    {
        $this->db->trans_start();
        
        $this->db->where('booking_id', $booking_id);
        $this->db->delete('tbl_booking_bikes');
        
        $this->db->trans_complete();
        
        return true;
    }

}

?>