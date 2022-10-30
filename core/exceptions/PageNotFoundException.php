<?php

namespace core\exceptions;


class PageNotFoundException extends \Exception{
    protected $message = 'Page you are looking for not found';
    protected $code = 404;
}