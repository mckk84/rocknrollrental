<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bookings_model (Bookings Model)
 * Bookings model class to manage Bookings master data 
 */
class Bookings_model extends CI_Model
{
    function getAll($status = "",  $limit = 0)
    {
        if( $limit != 0 )
        {
            $this->db->limit($limit);
        }
        $this->db->group_by('tbl_bookings.id');
        $this->db->order_by('tbl_bookings.id', 'DESC');
        $this->db->select('tbl_bookings.*, tbl_customers.name, tbl_customers.email, tbl_customers.phone,tbl_payment_mode.payment_mode as paymentmode, GROUP_CONCAT(tbl_booking_bikes.type_id) as bikes_types, GROUP_CONCAT(tbl_booking_bikes.quantity) as bikes_qty, tbl_users.name as created_by');
        $this->db->from('tbl_bookings');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_bookings.created_by', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.id = tbl_bookings.customer_id', 'left');
        $this->db->join('tbl_payment_mode', 'tbl_payment_mode.id = tbl_bookings.payment_mode', 'left');
        $this->db->join('tbl_booking_bikes', 'tbl_booking_bikes.booking_id = tbl_bookings.id', 'left');
        if( $status != "" )
        {
            $this->db->where('tbl_bookings.status IN ( '.$status.' )');    
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function searchBookings($status='', $daterange='')
    {
        $this->db->group_by('tbl_bookings.id');
        $this->db->order_by('tbl_bookings.id', 'DESC');
        $this->db->select('tbl_bookings.*, tbl_customers.name, tbl_customers.email, tbl_customers.phone,tbl_payment_mode.payment_mode as paymentmode, GROUP_CONCAT(tbl_booking_bikes.type_id) as bikes_types, GROUP_CONCAT(tbl_booking_bikes.quantity) as bikes_qty, tbl_users.name as created_by');
        $this->db->from('tbl_bookings');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_bookings.created_by', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.id = tbl_bookings.customer_id', 'left');
        $this->db->join('tbl_payment_mode', 'tbl_payment_mode.id = tbl_bookings.payment_mode', 'left');
        $this->db->join('tbl_booking_bikes', 'tbl_booking_bikes.booking_id = tbl_bookings.id', 'left');
        if( $status != "" )
        {
            $this->db->where('tbl_bookings.status IN ( '.$status.' )');    
        }
        if( $daterange != "" )
        {
            $dr = explode(" - ", $daterange);
            $start_date = trim($dr[0]);
            $end_date = trim($dr[1]);
            $this->db->where(" CONCAT(tbl_bookings.dropoff_date, ' ', STR_TO_DATE(tbl_bookings.dropoff_time, '%l:%i %p')) <= '".$end_date."' AND CONCAT(tbl_bookings.pickup_date, ' ', STR_TO_DATE(tbl_bookings.pickup_time, '%l:%i %p')) >= '".$start_date."' ");    
        }

        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

    
    function getAllReturnsToday()
    {
        $this->db->group_by('tbl_bookings.id');
        $this->db->order_by('tbl_bookings.dropoff_date', 'DESC');
        $this->db->select('tbl_bookings.*, tbl_customers.name, tbl_customers.email, tbl_customers.phone,tbl_payment_mode.payment_mode as paymentmode, GROUP_CONCAT(tbl_booking_bikes.type_id) as bikes_types, GROUP_CONCAT(tbl_booking_bikes.quantity) as bikes_qty, tbl_users.name as created_by');
        $this->db->from('tbl_bookings');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_bookings.created_by', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.id = tbl_bookings.customer_id', 'left');
        $this->db->join('tbl_payment_mode', 'tbl_payment_mode.id = tbl_bookings.payment_mode', 'left');
        $this->db->join('tbl_booking_bikes', 'tbl_booking_bikes.booking_id = tbl_bookings.id', 'left');
        $this->db->where('tbl_bookings.status', 1);
        $this->db->where('tbl_bookings.dropoff_date = ', 'DATE(CURDATE())',FALSE);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getAllPickupsToday()
    {
        $this->db->group_by('tbl_bookings.id');
        $this->db->order_by('tbl_bookings.pickup_date', 'DESC');
        $this->db->select('tbl_bookings.*, tbl_customers.name, tbl_customers.email, tbl_customers.phone,tbl_payment_mode.payment_mode as paymentmode, GROUP_CONCAT(tbl_booking_bikes.type_id) as bikes_types, GROUP_CONCAT(tbl_booking_bikes.quantity) as bikes_qty, tbl_users.name as created_by');
        $this->db->from('tbl_bookings');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_bookings.created_by', 'left');
        $this->db->join('tbl_customers', 'tbl_customers.id = tbl_bookings.customer_id', 'left');
        $this->db->join('tbl_payment_mode', 'tbl_payment_mode.id = tbl_bookings.payment_mode', 'left');
        $this->db->join('tbl_booking_bikes', 'tbl_booking_bikes.booking_id = tbl_bookings.id', 'left');
        $this->db->where('tbl_bookings.status', 0);
        $this->db->where('tbl_bookings.pickup_date <= ', 'DATE(CURDATE())',FALSE);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }

            
    function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_bookings');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        } else {
            return array();
        }
    }

    function getByCustomerId($customer_id, $limit = 0)
    {
        if( $limit != 0 )
        {
            $this->db->limit($limit);    
        }
        $this->db->group_by('tbl_bookings.id');
        $this->db->order_by('tbl_bookings.id', 'DESC');
        $this->db->select('tbl_bookings.*, GROUP_CONCAT(tbl_booking_bikes.type_id) as bikes_types, GROUP_CONCAT(tbl_booking_bikes.quantity) as bikes_qty');
        $this->db->from('tbl_bookings');
        $this->db->join('tbl_booking_bikes', 'tbl_booking_bikes.booking_id = tbl_bookings.id', 'left');
        $this->db->where('customer_id', $customer_id);
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
        $this->db->insert('tbl_bookings', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_bookings', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_bookings');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>