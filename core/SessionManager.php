<?php

namespace core;

class SessionManager
{
    public function __construct()
    {
        $this->sessionStartIfNot();
    }
    public function sessionStartIfNot()
    {
        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }
    public function getSession($name)
    {
        return isset($_SESSION[$name])?$_SESSION[$name]:null;   
    }
    public function setSession($name, $value)
    {
        if(!isset($_SESSION[$name]))
        {
            $_SESSION[$name] = $value;
        }
    }
    public function unsetSession($name){
        unset($_SESSION[$name]);
        session_destroy();
    }
}