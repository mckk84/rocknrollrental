<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Bike_model (Bike Model)
 * Bike model class to manage bike master data 
 */
class Bike_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_bikes.id', 'ASC');
        $this->db->select('tbl_bikes.*, tbl_users.name as created_by,tbl_manufacturer.name as manufacturer,tbl_bike_types.type as bike_type');
        $this->db->from('tbl_bikes');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_bikes.created_by');
        $this->db->join('tbl_manufacturer', 'tbl_manufacturer.id = tbl_bikes.manufacturer_id');
        $this->db->join('tbl_bike_types', 'tbl_bike_types.id = tbl_bikes.type_id');
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return array();
        }
    }
            
    function getById($id)
    {
        $this->db->select('tbl_bikes.*,tbl_manufacturer.name as manufacturer,tbl_bike_types.type as bike_type');
        $this->db->from('tbl_bikes');
        $this->db->join('tbl_manufacturer', 'tbl_manufacturer.id = tbl_bikes.manufacturer_id');
        $this->db->join('tbl_bike_types', 'tbl_bike_types.id = tbl_bikes.type_id');
        $this->db->where('tbl_bikes.id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        } else {
            return array();
        }
    }

    function getBikes($bike_ids)
    {
        $bike_id_string = implode(",", $bike_ids);
        $this->db->select('tbl_bikes.*,tbl_bikes.id as bid, tbl_bikes.type_id as bike_type_id, tbl_bike_types.type as bike_type, tbl_prices.*');
        $this->db->from('tbl_bikes');
        $this->db->join('tbl_prices', 'tbl_prices.type_id = tbl_bikes.type_id', 'left');
        $this->db->join('tbl_bike_types', 'tbl_bike_types.id = tbl_bikes.type_id', 'left');
        $this->db->where('tbl_bikes.id IN ('.$bike_id_string.')');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0)
        {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function getImageForType($type_id)
    {
        $this->db->limit(1);
        $this->db->select('tbl_bikes.image');
        $this->db->from('tbl_bikes');
        $this->db->where('tbl_bikes.type_id', $type_id);
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