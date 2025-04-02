<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function checkMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function checkOrderEdit($date, $time)
{
    return true;
    $date1=date_create($date." ".$time);
    $date2=date_create(date("Y-m-d H:i A"));
    $diff=date_diff($date2,$date1);
    $s = $diff->format("%R");
    $d = $diff->format("%a");
    if( $s == '-' )
    {
        return false;
    }
    if( $d == 0 )
    {
        return false;
    }
    return true;
}

function getNewImage($target_folder, $name, $imageFileType)
{
    $temp_image_name = ucwords(strtolower($name));
    $temp_image_name = preg_replace('/\s+/', '', $temp_image_name);
    $temp_image_name = preg_replace('/[^a-z\d ]/i', '', $temp_image_name);
    $new_image_name = $temp_image_name.".".$imageFileType;
    $target_file = $target_folder.$new_image_name;

    if( file_exists($target_file) )
    {
        for($i=0; $i < 25; $i++)
        {
            $concat = ( $i < 10 ) ? "0".$i: $i;
            $new_image_name = $temp_image_name."_".$concat.".".$imageFileType;
            if( !file_exists($target_folder.$new_image_name) )
            {
                $target_file = $target_folder.$new_image_name;
                break;
            }
        }
    }
    return array($new_image_name, $target_file);
}

if (!function_exists('getSocial'))
{
    function getSocial()
    {
        $CI =& get_instance();
        $CI->db->from('tbl_settings');
        $query = $CI->db->get();
        return $query->row_array();
    }
}

function getimagefile($img)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $img);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)) 
    {
        curl_close($ch);
        return "";
    }
    curl_close($ch); // Close the connection
    return $response;    
}

function get_google_reviews()
{
    $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJmeGuAdjZujsRPo7TwKigLB4&key=AIzaSyDFBhaeaWjnah9XEjmPx0uKlJ5ZNnPnYSk";
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

    $result = json_decode($response);
    $reviews = [];
    foreach($result->result->reviews as $row)
    {
        $image = $row->profile_photo_url;

        $img = getimagefile($image);

        $imageData = base64_encode($img);
        $src = 'data:png;base64,'.$imageData;
        $row->user_image = $src;
        $reviews[] = $row;
    }
    
    return $reviews;
}

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

// Send Message to Customer for pickup late by 1 Hr
function sendPickupReminderTodayToCustomer($phone, $customer_name, $pickup_date, $pickup_time)
{
    //rock_reminder
    $pickup_datetime = $pickup_date." ".$pickup_time;
    $url = "http://bhashsms.com/api/sendmsg.php?user=RNR_bw&pass=123456&sender=BUZWAP&phone=".$phone."&text=rnr_return_reminder&priority=wa&stype=normal&Params=".urlencode($customer_name).",".urlencode($pickup_datetime);
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

// Send Message to Customer for pickup late by 2 Hr
function sendPickupReminderTodayToCustomer2($phone, $customer_name, $pickup_date, $pickup_time)
{
    //rock_reminder
    $pickup_datetime = $pickup_date." ".$pickup_time;
    $url = "http://bhashsms.com/api/sendmsg.php?user=RNR_bw&pass=123456&sender=BUZWAP&phone=".$phone."&text=rnr_return_reminder_second&priority=wa&stype=normal&Params=".urlencode($customer_name).",".urlencode($pickup_datetime);
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

// Send Message to Customer for pickup before 1 Hr
function sendCancelReminderTodayToCustomer($phone, $customer_name, $pickup_date, $pickup_time)
{
    //rock_reminder
    $pickup_datetime = $pickup_date." ".$pickup_time;
    $url = "http://bhashsms.com/api/sendmsg.php?user=RNR_bw&pass=123456&sender=BUZWAP&phone=".$phone."&text=rnr_cancel&priority=wa&stype=normal&Params=".urlencode($customer_name).",".urlencode($pickup_datetime);
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
    if( $date == "" )
    {
        return "";
    }
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