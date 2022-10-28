<?php

namespace app\controllers;

use core\Request;
use core\Validation;
use core\View;

class HomeController
{
    public function index(): string
    {
        $params = ['personal_details'=> self::getPersonalData(),
                    'social_links' => self::getSocialLinks(),
                    'skills'=> self::getSkills()];

        return View::render('Home/home', $params);
    }
    public function about(): string
    {
        $params = ['personal_details'=> self::getPersonalData(),
        'social_links' => self::getSocialLinks(),
        'skills'=> self::getSkills()];
        return View::render('Home/about', $params);
    }
    public function contact(): string
    {
        return View::render('Home/contact');
    }

    public function resume(): string
    {
        return View::render('Home/resume');
    }
    public function postContact(Request $request): string
    {
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
    private static function getPersonalData(): array
    {
        return [
            'Email'=> 'mobinraee@gmail.com',
            'Phone'=> '',
            'Github' => 'https://github.com/mobinrai',
            'Address'=> '',
        ];
    }
    private static function getSocialLinks(): array
    {
        return [
            'ti-twitter' => '',
            'ti-google' => '',
            'ti-github' => '',
            'ti-instagram'=>'',
            'ti-facebook' => ''
        ];
    }    
    private static function getSkills(): array
    {
        return [
            'Html & Css'=>'75%',
            'PHP' => "80%",
            'Python' => '60%',
            'Node.js' => '60%',
            'MySql' => '70%',
            'Js' => '70%'
        ];
    }
}