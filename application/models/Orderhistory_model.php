<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Orderhistory_model
 */
class Orderhistory_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->select('*');
        $this->db->from('tbl_order_history');
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
        $this->db->from('tbl_order_history');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        } else {
            return array();
        }
    }

    function addNew($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_order_history', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }


}

?>