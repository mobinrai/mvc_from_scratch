<?php

namespace core;

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
class SendMail
{
    public static function sendMail($data=[])
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = $_ENV['MAIL_HOST'];
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = $_ENV['MAIL_PORT'];
        $phpmailer->Username = $_ENV['MAIL_USERNAME'];
        $phpmailer->Password = $_ENV['MAIL_PASSWORD'];
        $phpmailer->addAddress($data['to']);
        $phpmailer->Subject = $data['subject'];
        $phpmailer->isHTML();
        $phpmailer->msgHTML($data['message']);
        if(!$phpmailer->send())
        {
            throw new Exception("Unable to send mail");
        }
        return true;
    }
    
}