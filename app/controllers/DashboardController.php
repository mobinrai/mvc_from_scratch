<?php

namespace app\controllers;

use core\controllers\Controller;
use core\middlewares\AuthenticationMiddleware;
use core\Request;
use core\Validation;
use core\View;
use app\models\User;
use core\Application;
use core\auth\EmailVerification;
use core\Response;
use core\SendMail;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthenticationMiddleware());
    }
    public function dashboard()
    {
        return $this->render('users/dashboard');
    }
}