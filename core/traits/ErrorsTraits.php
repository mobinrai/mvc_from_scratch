<?php

namespace core\traits;

use core\Application;
use core\controllers\ErrorController;

trait ErrorsTraits
{
    private $pageNotFound = ['class'=>[ErrorController::class, 'pageNotFound']];
    private $errorMessage = ['class'=>[ErrorController::class, 'displayErrorMessage']];
    private $methodNotFound = ['class'=>[ErrorController::class, 'methodNotFound']];
    
    public function pageNotFound(string $message='')
    {
        if($message!==''){
            $this->pageNotFound['param']['message']=$message;
        }
        echo(Application::$app->response->_callback($this->errorMessage));
        die();
    }
    
    public function errorMessage(string $message='')
    {
        if($message!==''){
            $this->errorMessage['param']['message']=$message;
        }
        echo(Application::$app->response->_callback($this->errorMessage));
        die();
    }
    public function mathodNotFound(string $message='')
    {
        if($message!==''){
            $this->pageNotFound['param']['message'] =$message;
        }
        echo(Application::$app->response->_callback($this->errorMessage));
        die();
    }
}