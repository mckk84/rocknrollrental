<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Customers_model (Login Model)
 * Customers model class to get to authenticate user credentials 
 */
class Customers_model extends CI_Model
{
    function getAll()
    {
        $this->db->order_by('tbl_customers.id', 'ASC');
        $this->db->select('tbl_customers.*, tbl_users.name as created_by');
        $this->db->from('tbl_customers');
        $this->db->join('tbl_users', 'tbl_users.userId = tbl_customers.created_by',  'left');
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
        $this->db->from('tbl_customers');
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
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($phone, $password)
    {
        $this->db->select('id, name, email, phone, password');
        $this->db->from('tbl_customers');
        $this->db->where('phone', $phone);
        
        $query = $this->db->get();
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function loginOtp($phone, $otp)
    {
        $this->db->select('id, name, email, phone, password');
        $this->db->from('tbl_customers');
        $this->db->where('phone', $phone);
        $this->db->where('otp', $otp);
        $query = $this->db->get();
        $user = $query->row();
        
        if(!empty($user)){
            return $user;
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
        $query = $this->db->get('tbl_customers');

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
        $query = $this->db->get('tbl_customers');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function insertOtp($phone, $otp)
    {
        $info = array(
                'otp' => $otp
            );

        $this->db->trans_start();
        
        $this->db->where('phone', $phone);
        $this->db->update('tbl_customers', $info);
        
        $this->db->trans_complete();
        
        return true;
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNew($info)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_customers', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function updateRecord($info, $id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('tbl_customers', $info);
        
        $this->db->trans_complete();
        
        return true;
    }
    
    function deleteRecord($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('tbl_customers');
        
        $this->db->trans_complete();
        
        return true;
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('userId, email, name');
        $this->db->from('tbl_customers');
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($id, $password)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_customers', array('password' => getHashedPassword($password)));
        return true;
    }

}

?>