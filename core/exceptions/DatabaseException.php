<?php

namespace core\exceptions;


class DatabaseException extends \Exception{
    protected $code = 500;

    public function __construct($message='Could not connect with database')
    {
        parent::__construct($message);
    }
}