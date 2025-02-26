<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Prices (Prices Model)
 * Prices model class to manage bike rental price master data 
 */
class Prices_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_prices.id', 'ASC');
        $this->db->select('tbl_prices.*, tbl_bike_types.type as bike_type, tbl_users.name as created_by');
        $this->db->from('tbl_prices');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_prices.created_by');
        $this->db->join('tbl_bike_types', 'tbl_bike_types.id = tbl_prices.type_id');
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
        $this->db->from('tbl_prices');
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
    function checkRecordExists($type_id)
    {
        $this->db->select('type_id');
        $this->db->where('type_id', $type_id);
        $query = $this->db->get('tbl_prices');

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
    function checkRecordExists1($type_id, $record_id)
    {
        $this->db->select('type_id');
        $this->db->where('type_id', $type_id);
        $this->db->where('id !=', $record_id);
        $query = $this->db->get('tbl_prices');

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
        $this->db->insert('tbl_prices', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_prices', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_prices');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>