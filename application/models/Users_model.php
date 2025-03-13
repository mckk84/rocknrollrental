<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Users
 * Users model class to manage admin users master data 
 */
class Users_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('userId', 'ASC');
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('user_type !=', "SuperAdmin");
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
        $this->db->from('tbl_users');
        $this->db->where('userId', $id);
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
    function checkRecordExists($username)
    {
        $this->db->select('name');
        $this->db->where('username', $username);
        $query = $this->db->get('tbl_users');

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
    function checkRecordExists1($username, $record_id)
    {
        $this->db->select('name');
        $this->db->where('username', $username);
        $this->db->where('userId !=', $record_id);
        $query = $this->db->get('tbl_users');

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
        $this->db->insert('tbl_users', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('userId', $id);
        $this->db->update('tbl_users', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('userId', $id);
        $this->db->delete('tbl_users');
        
        $this->db->trans_complete();
        
        return true;
    }

    // This function used to create new password by reset link
    function createPasswordUser($userId, $password)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
        return true;
    }

    function getAdminPhone()
    {
        $this->db->limit(1);
        $this->db->select('phone');
        $this->db->where('user_type', 'SuperAdmin');
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0){
            $row = $query->row_array();
            return $row['phone'];
        } else {
            return false;
        }
    }


}

?>