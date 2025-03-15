<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Subscribers_model (Subscribers Model)
 * Subscribers model class to manage Subscribers master data 
 */
class Subscribers_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_subscribers.id', 'DESC');
        $this->db->select('tbl_subscribers.*');
        $this->db->from('tbl_subscribers');
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
        $this->db->from('tbl_subscribers');
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
    function checkRecordExists($email)
    {
        $this->db->select('email');
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_subscribers');

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
        $this->db->insert('tbl_subscribers', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_subscribers', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_subscribers');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>