<?php

namespace core\exceptions;


class MethodNotFoundException extends \Exception{
    protected $message = 'Sorry, method not found';
    protected $code = 405;
}