<?php

namespace app\controllers;

use core\Request;
use core\Validation;
use core\View;

class AuthController{
    public function login(){
        return View::render('Home/login');
    }
    public function register(){
        return View::render('Home/register', ['errors'=>[]]);
    }
    public function checkCrediential(Request $request){

    }
    public function addCrediential(Request $request){
        $validation = new Validation();
        $rules=[
            'input_username' => ['required', 'string', 'length:5'],
            'input_email' => ['required', 'email'],
            'input_password'=>  ['required']
        ];
        $errors = $validation->validate($rules);
        if(!is_array($errors))
        {
            var_dump($request->getData());
        }
        else{
            return View::render('Home/register', ['errors'=>$errors]);
        }
        
    }
}