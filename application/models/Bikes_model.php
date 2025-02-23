<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bikes_model (Bikes Model)
 * Bikes model class to manage bikes mastaer data 
 */
class Bikes_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tbl_bikes');
        
        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }
            
    function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_bikes');
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
    function checkProjectExist($project_id)
    {
        $this->db->select('project_id');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('tbl_bikes');

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
    function checkProjectExist1($project_id, $record_id)
    {
        $this->db->select('project_id');
        $this->db->where('project_id', $project_id);
        $this->db->where('id !=', $record_id);
        $query = $this->db->get('tbl_bikes');

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
        $this->db->insert('tbl_bikes', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_bikes', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_bikes');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>