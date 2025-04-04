<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bookings_model (Bookings Model)
 * Bookings model class to manage Bookings master data 
 */
class Bookingpayment_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_booking_payment.id', 'ASC');
        $this->db->select('tbl_booking_payment.*, tbl_customers.name,tbl_customers.email, tbl_customers.phone, tbl_users.name as created_by');
        $this->db->from('tbl_booking_payment');
        $this->db->join('tbl_bookings', 'tbl_booking_payment.booking_id = tbl_bookings.id', 'left');
        $this->db->join('tbl_customers', 'tbl_bookings.customer_id = tbl_customers.id', 'left');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_booking_payment.created_by', 'left');
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
        $this->db->from('tbl_booking_payment');
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
        $this->db->select('*');
        $this->db->from('tbl_booking_payment');
        $this->db->where('booking_id', $booking_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }     

    function getPaid($booking_id)
    {
        $this->db->select('amount');
        $this->db->from('tbl_booking_payment');
        $this->db->where('booking_id', $booking_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            $total_paid = 0;
            $result = $query->result_array();
            foreach ($result as $key => $row) 
            {
                $total_paid += floatval($row['amount']);
            }
            return $total_paid;
        } else {
            return 0;
        }
    }
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNew($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_booking_payment', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_booking_payment', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_booking_payment');
        
        $this->db->trans_complete();
        
        return true;
    }

    function deleteByBookingId($booking_id)
    {
        $this->db->trans_start();
        
        $this->db->where('booking_id', $booking_id);
        $this->db->delete('tbl_booking_payment');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>