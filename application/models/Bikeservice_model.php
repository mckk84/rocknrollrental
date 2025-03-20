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
        $this->db->group_by('tbl_bikeservice.id', 'DESC');
        $this->db->select('tbl_bikeservice.*, tbl_users.name as created_by, GROUP_CONCAT(tbl_service_bikes.bike_id) as bike_ids, GROUP_CONCAT(tbl_bikes.name) as names,GROUP_CONCAT(tbl_bikes.vehicle_number) as vehicle_numbers');
        $this->db->from('tbl_bikeservice');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_bikeservice.created_by');
        $this->db->join('tbl_service_bikes', 'tbl_service_bikes.service_id = tbl_bikeservice.id');
        $this->db->join('tbl_bikes', 'tbl_service_bikes.bike_id = tbl_bikes.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getById($record_id)
    {
        $this->db->select('*');
        $this->db->where('id', $record_id);
        $query = $this->db->get('tbl_bikeservice');

        if ($query->num_rows() > 0){
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkRecordExists($bike_ids)
    {
        $this->db->select('bike_id');
        $this->db->where('tbl_service_bikes.bike_id IN ('.$bike_ids.')');
        $this->db->join('tbl_service_bikes', 'tbl_bikeservice.id = tbl_service_bikes.service_id');
        $query = $this->db->get('tbl_bikeservice');

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
    function checkRecordExists1($bike_ids, $record_id)
    {
        $this->db->select('bike_id');
        $this->db->where('tbl_service_bikes.bike_id IN ('.$bike_ids.')');
        $this->db->where('tbl_service_bikes.service_id != ', $record_id);
        $this->db->join('tbl_service_bikes', 'tbl_bikeservice.id = tbl_service_bikes.service_id');
        $query = $this->db->get('tbl_bikeservice');

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
        $this->db->insert('tbl_bikeservice', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    
    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_bikeservice', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_bikeservice');
        
        $this->db->trans_complete();
        
        return true;
    }


}

?>