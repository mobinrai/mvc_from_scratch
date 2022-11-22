<?php

namespace core\exceptions;


class BadMailException extends \Exception{
    protected $code = 500;

    public function __construct($message='Unable to send mail')
    {
        parent::__construct($message);
    }
}