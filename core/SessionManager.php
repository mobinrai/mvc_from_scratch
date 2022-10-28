<?php

namespace core;

class SessionManager
{
    private array $flashMessages = [];
     
    public function __construct()
    {
        $this->sessionStartIfNot();
    }
    public function sessionStartIfNot(): void
    {
        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }
    public function getSession($name): string
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : '';   
    }
    public function setSession($name, $value): void
    {
        if(!isset($_SESSION[$name]))
        {
            $_SESSION[$name] = $value;
        }
    }
    public function unsetSession($name): void
    {
        unset($_SESSION[$name]);
        session_destroy();
    }
}