<?php

namespace app\controllers;

use core\Request;
use core\Validation;
use core\View;
use app\models\User;

class AuthController
{

    public function login()
    {
        return View::render('Home/login');
    }
    public function register(): string
    {
        return View::render('Home/register', ['errors'=>[]]);
    }
    public function checkCrediential(Request $request)
    {

    }
    public function addCrediential(Request $request): string
    {
        $validation = new Validation();                
        $rules=[
            'input_username' => 'required|string|length:5',
            'input_email' => ['required', 'email', ['unique'=>'users', 'column'=>'email']],
            'input_password'=>  ['required']
        ];
        $errors = $validation->validate($rules);
        if(!is_array($errors))
        {
            $user = new User();
            $user->user_name = $request->getData()['input_username'];
            $user->email = $request->getData()['input_email'];
            $user->password = $request->getData()['input_password'];
            $user->save();
            return View::render('Home/home');
        }
        else{
            return View::render('Home/register', ['errors'=>$errors]);
        }
        
    }
}