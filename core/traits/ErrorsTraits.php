<?php

namespace core\traits;

use core\Application;
use core\controllers\ErrorController;

trait ErrorsTraits
{
    private $pageNotFound = ['class'=>[ErrorController::class, 'pageNotFound']];
    private $errorMessage = ['class'=>[ErrorController::class, 'displayErrorMessage']];
    private $methodNotFound = ['class'=>[ErrorController::class, 'methodNotFound']];
    
    public function pageNotFound(string $message=''): callable
    {
        if($message!==''){
            $this->pageNotFound['param']['message']=$message;
        }
        return (Application::$app->response->_callback($this->errorMessage));
    }
    
    public function errorMessage(string $message=''): callable
    {
        if($message!==''){
            $this->errorMessage['param']['message']=$message;
        }
        return (Application::$app->response->_callback($this->errorMessage));
    }
    public function mathodNotFound(string $message=''): callable
    {
        if($message!==''){
            $this->pageNotFound['param']['message'] =$message;
        }
        return (Application::$app->response->_callback($this->errorMessage));
    }
}