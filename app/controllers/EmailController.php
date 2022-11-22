<?php

namespace app\controllers;

use app\models\EmailVerify;
use app\models\User;
use core\Application;
use core\auth\EmailVerification;
use core\controllers\Controller;
use core\middlewares\EmailMiddleware;
use core\model\Select;
use core\Request;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new EmailMiddleware());
    }
    // resendCode
    public function emailVerification()
    {
        return $this->render('email/email_verification_send');
    }

    public function resendCode()
    {
        return $this->render('email/resend_code');
    }
    public function sendVerificationCode()
    {
        $email = Application::$app->sessionManager->getSession('registerEmail');
        if(isset($email))
        {
            $query = (new Select(['id', 'email']))->from('users')
                        ->where('email = :email');
            $user = new User();         
            
            $result = $user->dbExecute($query, ['email' => $email]);
            
            $data = $result->fetchObject(self::class);
            $user->id = $data->id;
            $user->email = $data->email;

            $sendMail = EmailVerification::sendEmailVerification($user,  'email/email_verification');

            if($sendMail)
            {
                Application::$app->response->redirect('resend-code');
            }
        }
    }
    public function verifyEmail(Request $request, $code)
    {
        $verification = new EmailVerify();
        $query = $verification::select('emails.user_id', 'users.email')
                    ->from($verification->tableName(), 'emails')
                    ->join('left join',' users ', 'users.id = emails.user_id')
                    ->where('emails.verification_code = :verification_code', 'users.verified = :status', " TIMESTAMPDIFF(MINUTE, emails.created_at, now()) <= 30");
        $result = $verification->dbExecute($query, ['verification_code' => $code, 'status' => '0']);
        
        $data = $result->fetchObject(self::class);
        var_dump($data);
        if($data)
        {
            var_dump($data->user_id);
            $user = new User();            
            $query = $user->update($user->tableName())
                ->where('id = :id')
                ->set('verified = :verified');
            var_dump($query->__toString());
            $result = $user->dbExecute($query, ['id'=> $data->user_id, 'verified'=> true]);

            if($result){
                Application::$app->sessionManager->setSession('user_id', $data->user_id);
                Application::$app->sessionManager->setSession('user_email', $data->email);
                Application::$app->sessionManager->unsetSession('registerEmail');
                Application::$app->response->redirect('/users/dashboard');
            }
        }
        return $this->render('email/email_verification_send');
    }
}
