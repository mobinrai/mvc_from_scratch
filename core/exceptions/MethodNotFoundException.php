<?php

namespace core\exceptions;


class MethodNotFoundException extends \Exception{
    protected $code = 405;
    public function __construct($message='Sorry, method not found')
    {
        parent::__construct($message);
    }
}