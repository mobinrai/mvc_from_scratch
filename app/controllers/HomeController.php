<?php

namespace app\controllers;

use core\Request;
use core\Validation;
use core\View;

class HomeController{
    public function index()
    {
        $personal_data = [
            'Email'=> 'mobinraee@gmail.com',
            'Phone'=> '',
            'Github' => 'https://github.com/mobinrai',
            'Address'=> '',
        ];
        $social_links = [
            'ti-twitter' => '',
            'ti-google' => '',
            'ti-github' => '',
            'ti-instagram'=>'',
            'ti-facebook' => ''
        ];
        $skills = [
            'Html & Css'=>'75%',
            'PHP' => "80%",
            'Python' => '60%',
            'Node.js' => '60%',
            'MySql' => '70%',
            'Js' => '70%'
        ];
        $params = ['personal_details'=> $personal_data,
                    'social_links' => $social_links,
                    'skills'=> $skills];

        return View::render('Home/home', $params);
    }
    public function about()
    {
        return View::render('Home/about');
    }
    public function contact()
    {
        return View::render('Home/contact');
    }
    public function postContact(Request $request){
        $data = $request->getData();
        var_dump($data);
        $validation = new Validation();
        $rules = [
            'input_name' =>'/^[a-z A-Z]+$/',
            'input_email' => Validation::EMAIL_VALIDATION,
            'input_company' =>'/^[a-zA-Z 0-9]+$/',
            'input_phone' => Validation::PHONE_NUMBER,
            'input_subject' => '',
            'input_message' => Validation::TEXT
        ];
        $validation->validate($rules);
        return View::render('Home/contact');
    }
}