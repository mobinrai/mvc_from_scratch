<?php

namespace core\traits;

use core\controllers\ErrorController;

trait ErrorsTraits
{
    private string $message='';

    private function errorController(){
        return new ErrorController;
    }
    public function pageNotFound(string $message=''): string
    {
        return ($this->errorController()->pageNotFound($message));
    }
    
    public function errorMessage(string $message=''): string
    {
        return ($this->errorController()->displayErrorMessage($message));
    }
    public function mathodNotFound(string $message=''): string
    {
        return ($this->errorController()->methodNotFound($message));
    }
}