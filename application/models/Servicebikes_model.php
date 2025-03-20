<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Servicebikes_model
 * Servicebikes model class to manage Service bikes data 
 */
class Servicebikes_model extends CI_Model
{
    function getByServiceId($service_id)
    {
        $this->db->select('tbl_service_bikes.*, tbl_bike_types.type, tbl_bikes.vehicle_number, tbl_bikes.image');
        $this->db->from('tbl_service_bikes');
        $this->db->join('tbl_bikes', 'tbl_service_bikes.bike_id = tbl_bikes.id', 'left');
        $this->db->where('service_id', $service_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }  
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNew($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_service_bikes', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_service_bikes', $info);
        
        $this->db->trans_complete();
        
        return true;
    }

    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_service_bikes');
        
        $this->db->trans_complete();
        
        return true;
    }

    function deleteByServiceId($service_id)
    {
        $this->db->trans_start();
        
        $this->db->where('service_id', $service_id);
        $this->db->delete('tbl_service_bikes');
        
        $this->db->trans_complete();
        
        return true;
    }

}

?>