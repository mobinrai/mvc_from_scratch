<?php

namespace core\controllers;

use core\Application;
use core\View;

class ErrorController
{
    private View $view;
    public function __construct()
    { 
        $this->view = new View;
    }
    public function pageNotFound(string $message): string
    {
        Application::$app->response->setResponseCode(404);        
        return $this->view->render('errors/404_page', ['message' => $message], 'error_app');
    }
    public function methodNotFound(string $message): string
    {
        Application::$app->response->setResponseCode(404);
        return $this->view->render('errors/404_page', ['message' => $message], 'error_app');
    }
    public function displayErrorMessage(string $message): string
    {
        Application::$app->response->setResponseCode(404);
        return $this->view->render('errors/error_message', ['message' => $message], 'error_app');
    }
    public function forbidden(): string
    {
        Application::$app->response->setResponseCode(403);
        return $this->view->render('errors/403_page', [],'error_app');
    }
}