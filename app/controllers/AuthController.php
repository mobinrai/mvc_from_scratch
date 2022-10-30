<?php

namespace app\controllers;

use core\controllers\Controller;
use core\middlewares\AuthenticationMiddleware;
use core\Request;
use core\Validation;
use core\View;
use app\models\User;
use core\Application;
use core\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthenticationMiddleware(['login']));
    }
    public function login()
    {
        return $this->render('Home/login');
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }
    public function register(): string
    {
        return $this->render('Home/register');
    }
    public function checkCrediential(Request $request)
    {
        $validation = new Validation();                
        $rules=[
            'email' => ['required', 'email'],
            'password'=>  ['required']
        ];
        $errors = $validation->validate($rules);       
        $user = new User();
        $user->email = $request->getData()['email'];
        $user->password = $request->getData()['password'];
        if($errors && $user->login())
        {
            Application::$app->response->redirect('/');
        }
        else
        {
            return $this->render('Home/login');
        }
        
    }
    public function addCrediential(Request $request): string
    {
        $validation = new Validation();                
        $rules=[
            'user_name' => 'required|string|length:5',
            'email' => ['required', 'email', ['unique'=>'users', 'column'=>'email']],
            'password'=>  ['required'],
            'confirm_password'=>  ['required']
        ];
        if($validation->validate($rules))
        {
            $user = new User();
            $user->user_name = $request->getData()['user_name'];
            $user->email = strtolower($request->getData()['email']);
            $user->password = $request->getData()['password'];
            if($user->save())
            {
                return $this->render('Home/home');
            }
            else
            {
                return $this->render('Home/register');
            }            
        }
        else{
            return $this->render('Home/register');
        }        
    }
}