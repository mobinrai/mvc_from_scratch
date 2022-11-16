<?php

namespace core\exceptions;


class ForbiddenException extends \Exception{
    protected $code = 403;

    public function __construct($message="You don\'t have permission to access this page")
    {
        parent::__construct($message);
    }
}