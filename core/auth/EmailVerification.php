<?php

namespace core\auth;

use core\SendMail;
use app\models\EmailVerify;
use core\View;
use InvalidArgumentException;

class EmailVerification{

    public static function sendEmailVerification(object $data, string $htmlFile): bool
    {
        $details = self::getEmail($data);       
        $to = $details['email'] ? $details['email'] : $details['to'];
        if($to === '')
        {
            throw new InvalidArgumentException("Please add to address, to send mail");
        }
        $code = self::saveVerificationCode($data, $to);
        $link = $_ENV['APP_URL'].'/email/verify/'.$code;
        $details['link'] = $link;
        $message  = (new View)->renderView($htmlFile, $details);       
        $subject = $details['subject'] ?? 'Email verification';        
        return SendMail::sendMail(['to'=> $to, 'subject'=> $subject, 'message'=> $message]);
    }
    private static function getEmail($data)
    {
        $details = [];
        foreach($data as $obj){
            if(is_array($obj))
            {
                foreach($obj as $key=>$val){
                    $details[$key] = $val;
                }    
            }
        }
        return $details;
    }
    private static function saveVerificationCode($data, string $email)
    {
        $query = $data->select('id')
                    ->from($data->tableName())
                    ->where('email = :email');
        $result = $data->dbExecute($query, ['email' => $email]);

        $user = $result->fetchObject(self::class);
        
        $verification = new EmailVerify();
        $verification->user_id = $user->id;
        $verification->verification_code = random_int(100000, 9999999);
        $verification->save();

        return $verification->verification_code;
        
    }
}