<?php

namespace core\controllers;

use core\Application;
use core\View;

class ErrorController{
    public function __construct()
    { }
    public function pageNotFound(string $message): string
    {
        Application::$app->response->setResponseCode(404);        
        return View::render('errors/404_page', ['message' => $message], 'error_app');
    }
    public function methodNotFound(string $message): string
    {
        Application::$app->response->setResponseCode(404);
        return View::render('errors/404_page', ['message' => $message], 'error_app');
    }
    public function displayErrorMessage(string $message): string
    {
        Application::$app->response->setResponseCode(404);
        return View::render('errors/error_message', ['message' => $message], 'error_app');
    }
}