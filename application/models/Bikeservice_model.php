<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bike_model (Bike Model)
 * Bike model class to manage bike master data 
 */
class Bikeservice_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_bikeservice.id', 'DESC');
        $this->db->select('tbl_bikeservice.*, tbl_users.name as created_by,tbl_bikes.id as bike_id');
        $this->db->from('tbl_bikeservice');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_bikeservice.created_by');
        $this->db->join('tbl_bikes', 'tbl_bikes.id = tbl_bikeservice.bike_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkRecordExists($name, $vehicle_number)
    {
        $this->db->select('name');
        $this->db->where('name', $name);
        $this->db->where('vehicle_number', $vehicle_number);
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
    function checkRecordExists1($name, $vehicle_number, $record_id)
    {
        $this->db->select('name');
        $this->db->where('name', $name);
        $this->db->where('vehicle_number', $vehicle_number);
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