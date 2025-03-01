<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Publicholidays Model
 * Publicholidays_model class to manage Public Holidays data 
 */
class Publicholidays_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_public_holidays.id', 'ASC');
        $this->db->select('tbl_public_holidays.*, tbl_users.name as created_by');
        $this->db->from('tbl_public_holidays');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_public_holidays.created_by');
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
        $this->db->from('tbl_public_holidays');
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
    function checkRecordExists($holiday_date)
    {
        $this->db->select('holiday_date');
        $this->db->where('holiday_date', $holiday_date);
        $query = $this->db->get('tbl_public_holidays');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkRecordExists1($holiday_date, $record_id)
    {
        $this->db->select('holiday_date');
        $this->db->where('holiday_date', $holiday_date);
        $this->db->where('id !=', $record_id);
        $query = $this->db->get('tbl_public_holidays');

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
        $this->db->insert('tbl_public_holidays', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_public_holidays', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_public_holidays');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>