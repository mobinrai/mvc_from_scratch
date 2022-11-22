<?php

namespace app\controllers;

use core\controllers\Controller;
use core\Request;
use core\Validation;

class HomeController extends Controller
{
    public function index(): string
    {       
        return $this->render('Home/home');
    }
    public function about(): string
    {
        return $this->render('Home/about');
    }
    public function contact(): string
    {
        return $this->render('Home/contact');
    }
    public function blog(): string
    {
        return $this->render('Home/blog');
    }
    public function resume(): string
    {
        return $this->render('Home/resume');
    }
    public function postContact(Request $request): string
    {
        $data = $request->getData();
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
        return $this->render('Home/contact');
    }
}