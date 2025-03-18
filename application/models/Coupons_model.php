<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Coupons_model (Login Model)
 * Coupons model class to get manage Coupons 
 */
class Coupons_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_coupons.id', 'DESC');
        $this->db->select('tbl_coupons.*, tbl_users.name as created_by');
        $this->db->from('tbl_coupons');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_coupons.created_by',  'left');
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
        $this->db->from('tbl_coupons');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        } else {
            return array();
        }
    }

    function getByCode($code)
    {
        $this->db->select('*');
        $this->db->from('tbl_coupons');
        $this->db->where('code', $code);
        $this->db->where('status', 1);
        $this->db->where('start_date <=', date('Y-m-d'));
        $this->db->where('end_date >=', date('Y-m-d'));
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
    function checkRecordExists($code)
    {
        $this->db->select('id');
        $this->db->where('code', $code);
        $query = $this->db->get('tbl_coupons');

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
    function checkRecordExists1($code, $id)
    {
        $this->db->select('id');
        $this->db->where('code', $code);
        $this->db->where('id !=', $id);
        $query = $this->db->get('tbl_coupons');

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
        $this->db->insert('tbl_coupons', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_coupons', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_coupons');
        
        $this->db->trans_complete();
        
        return true;
    }

}

?>