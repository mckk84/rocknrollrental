<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Manufacturer_model (Manufacturer Model)
 * Manufacturer model class to manage Manufacturer master data 
 */
class Manufacturer_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_manufacturer.id', 'ASC');
        $this->db->select('tbl_manufacturer.*, tbl_users.name as created_by');
        $this->db->from('tbl_manufacturer');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_manufacturer.created_by');
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
        $this->db->from('tbl_manufacturer');
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
    function checkRecordExists($name)
    {
        $this->db->select('name');
        $this->db->where('name', $name);
        $query = $this->db->get('tbl_manufacturer');

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
    function checkRecordExists1($name, $record_id)
    {
        $this->db->select('name');
        $this->db->where('name', $name);
        $this->db->where('id !=', $record_id);
        $query = $this->db->get('tbl_manufacturer');

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
        $this->db->insert('tbl_manufacturer', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_manufacturer', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_manufacturer');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>