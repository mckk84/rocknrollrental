<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Manufacturer_model (Manufacturer Model)
 * Manufacturer model class to manage Manufacturer master data 
 */
class Paymentmode_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_payment_mode.id', 'ASC');
        $this->db->select('tbl_payment_mode.*, tbl_users.name as created_by');
        $this->db->from('tbl_payment_mode');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_payment_mode.created_by');
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
        $this->db->from('tbl_payment_mode');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        } else {
            return array();
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkRecordExists($payment_mode)
    {
        $this->db->select('payment_mode');
        $this->db->where('payment_mode', $payment_mode);
        $query = $this->db->get('tbl_payment_mode');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    function getIdByMode($payment_mode)
    {
        $this->db->select('id');
        $this->db->where('payment_mode', $payment_mode);
        $query = $this->db->get('tbl_payment_mode');

        if ($query->num_rows() > 0){
            return $query->row_array();
        } else {
            return false;
        }
    }
    
    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkRecordExists1($payment_mode, $record_id)
    {
        $this->db->select('payment_mode');
        $this->db->where('payment_mode', $payment_mode);
        $this->db->where('id !=', $record_id);
        $query = $this->db->get('tbl_payment_mode');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNew($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_payment_mode', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_payment_mode', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_payment_mode');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>