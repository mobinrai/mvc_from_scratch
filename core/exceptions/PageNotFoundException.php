<?php

namespace core\exceptions;


class PageNotFoundException extends \Exception{
    protected $code = 404;

    public function __construct($message = 'Page you are looking for not found')
    {
        parent::__construct($message);
    }
}