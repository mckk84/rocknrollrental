<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Contact_model
 * Contact model class to manage customer contact messages 
 */
class Contact_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('id', 'ASC');
        $this->db->select('*');
        $this->db->from('tbl_contact');
        $query = $this->db->get();
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
        $this->db->from('tbl_contact');
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
    function checkPhoneExists($phone)
    {
        $this->db->select('id');
        $this->db->where('phone', $phone);
        $query = $this->db->get('tbl_contact');

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
    function checkPhoneExists1($phone, $id)
    {
        $this->db->select('id');
        $this->db->where('phone', $phone);
        $this->db->where('id !=', $id);
        $query = $this->db->get('tbl_contact');

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
        $this->db->insert('tbl_contact', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_contact', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_contact');
        
        $this->db->trans_complete();
        
        return true;
    }

}

?>