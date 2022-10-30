<?php

namespace core;

class Response{
    
    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }
    public function getResponseCode(): int
    {
       return http_response_code();
    }
    public function redirect(string $redirect){
        header("Location: $redirect ");
    }
    // private static function responseObj(): object
    // {
    //     /** 
    //     * equivalent to...
    //     * self::$response = isset(self::$response) ? self::$response : new Response();
    //     * self::$response = self::$response ?? new Response();
    //     */
    //     return self::$response ??= new Response();
    // }
}