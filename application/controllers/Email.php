<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    
    public function sendmail($from, $from_name, $to, $subject, $mail_html, $alt_body)
    {
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        $mail->isSMTP();
        $mail->Host     = 'smtp.zoho.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'tours@rocknrollrentals.com';
        $mail->Password = 'Jvmtech@2010';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;

        $mail->setFrom($from, $from_name);
        $mail->addReplyTo($from, $from_name);

        // Add a recipient
        $mail->addAddress($to);

        // Email subject
        $mail->Subject = $subject;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        //$mailContent = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>RIGHT VIEW INFRA PROJECTS PRIVATE LIMITED</title><style type='text/css'> body{ font-size:14px;font-weight:500; } </style></head><body><h4>Dear Customer,</h4><p>Thank you for reaching out to <b>RIGHT VIEW INFRA PROJECTS PRIVATE LIMITED</b> for your house constructions project. <br/>We’re excited to assist you in creating your dream space. Our Engineer (<b>7026017777</b> / <b>7026018888</b>) will be in touch with you shortly to discuss your vision and how we can bring it to life.</p><p>We’re here to ensure a seamless and enjoyable work experience for you. Meantime you can visit our website to know more about the team. </p><p>Warm Regards,<br/><b>Team RIGHT VIEW INFRA PROJECTS PRIVATE LIMITED</b><br/><a target='_blank' href='http://www.rightviewinfraprojects.com'>rightviewinfraprojects.com</a></p></body></html>";
            
        $mail->Body = $mail_html;
        $mail->AltBody = $alt_body;
        //'Dear Customer, Thank you for reaching out to RIGHT VIEW INFRA PROJECTS PRIVATE LIMITED for your house constructions project. We’re excited to assist you in creating your dream space. Our Engineer (7026017777 / 7026018888) will be in touch with you shortly to discuss your vision and how we can bring it to life. Warm Regards,Team RIGHT VIEW INFRA PROJECTS PRIVATE LIMITED';

        if(!$mail->send())
        {
            return false;
        }
        return true;        
    }
    
    
}

?>