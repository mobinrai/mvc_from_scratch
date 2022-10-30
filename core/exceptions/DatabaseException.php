<?php

namespace core\exceptions;


class DatabaseException extends \Exception{
    protected $message = 'Could not connect with database';
    protected $code = 500;
}