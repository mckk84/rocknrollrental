<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function sendOtpWhatsapp($phone, $otp)
{
    $param = "otp will be ".$otp;
    $url = "http://bhashsms.com/api/sendmsg.php?user=RNR_bw&pass=123456&sender=BUZWAP&phone=".$phone."&text=rnr_login&priority=wa&stype=normal&Params=".urlencode($param);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)) 
    {
        curl_close($ch);
        return false;
    }
    curl_close($ch); // Close the connection
    return true;
}

// To send whatsapp message to customer on successful booking of vehicle.
function sendNewOrdertoCustomer($phone, $customer_name, $booking_id, $bike, $pickup_date, $pickup_time, $dropoff_date, $dropoff_time, $total_cost, $paid)
{
    //rock_booking
    $pickup_datetime = $pickup_date." ".$pickup_time;
    $dropoff_datetime = $dropoff_date." ".$dropoff_time;
    //$params = urlencode($customer_name);
    $params = $booking_id;
    $params .= ",".urlencode($bike);
    $params .= ",".urlencode($pickup_datetime);
    $params .= ",".urlencode($dropoff_datetime);
   // $params .= ",".$total_cost;
    $params .= ",".urlencode('https://maps.app.goo.gl/NADx1UkaGtiDcoDU6?g_st=i');
    $params .= ",".$paid;
    $params .= ",".($total_cost - $paid);

    $url = "http://bhashsms.com/api/sendmsg.php?user=RNR_bw&pass=123456&sender=BUZWAP&phone=".$phone."&text=rnr_new_booking&priority=wa&stype=normal&Params=".$params;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    echo $url;
    $response = curl_exec($ch);
    if(curl_errno($ch)) 
    {
        curl_close($ch);
        return false;
    }
    curl_close($ch); // Close the connection
    return true;
}

// To send message to admin on new order
function sendNewOrderAlertToAdmin($phone, $customer_name, $booking_id, $bike, $datetime, $customer_phone)
{
    //rock_booking_alert
    $params = urlencode($customer_name);
    $params .= ",".$booking_id;
    $params .= ",".urlencode($bike);
    $params .= ",".urlencode($datetime);
    $params .= ",".$customer_phone;
    
    $url = "http://bhashsms.com/api/sendmsg.php?user=RNR_bw&pass=123456&sender=BUZWAP&phone=".$phone."&text=rnr_booking_alert&priority=wa&stype=normal&Params=".$params;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)) 
    {
        curl_close($ch);
        return false;
    }
    curl_close($ch); // Close the connection
    return true;
}

// Send Message to Customer on Return date is today
function sendReturnReminderTodayToCustomer($phone, $customer_name, $return_date, $return_time)
{
    //rock_reminder
    $return_datetime = $return_date." ".$return_time;
    $url = "http://bhashsms.com/api/sendmsg.php?user=RNR_bw&pass=123456&sender=BUZWAP&phone=".$phone."&text=rnr_reminder&priority=wa&stype=normal&Params=".urlencode($customer_name).",".urlencode($return_datetime);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)) 
    {
        curl_close($ch);
        return false;
    }
    curl_close($ch); // Close the connection
    return true;
}

function sendSafetyMessageCustomer($customer_name)
{
    //rnr_safetys
}

function generateOtp() {
    $key = "";
    for ($x = 1; $x <= 6; $x++) {
        $key .= random_int(0, 9);
    }
    return $key;
}

function dateformatdb($date)
{
    $d = explode("-", $date);
    if( strlen($d[2]) > 2 ){
        return $d[2]."-".$d[1]."-".$d[0];
    }else{
        return $date;
    }
}

function dateformatuser($date)
{
    $d = explode("-", $date);
    if( strlen($d[0]) > 2 ){
        return $d[2]."-".$d[1]."-".$d[0];
    }else{
        return $date;
    }
}

function result_to_array($result)
{
    $data = array();
    foreach($result as $index => $row) 
    {
        $data[ $row['id'] ] = $row['type'];
    }
    return $data;
}

/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('email');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;
        
        $CI = setProtocol();        
        
        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();
        
        return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

function getClientIpAddress()
{
    $ipaddress = '';
    if ( isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '127.0.0.1')
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&  $_SERVER['HTTP_X_FORWARDED_FOR'] != '127.0.0.1')
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if ( isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED'] != '127.0.0.1')
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if ( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '127.0.0.1')
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    
    return $ipaddress;
}

?>