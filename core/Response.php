<?php

namespace core;

class Response{
    public function __construct()
    {
    }
    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }
    public function getResponseCode(): int
    {
       return http_response_code();
    }
    public function _callback($callback)
    {
        $className = $callback['class'][0];
        $methodNmae =$callback['class'][1];
        if(key_exists('param', $callback) && sizeof($callback['param'])>0) {
            return call_user_func_array([$className, $methodNmae], $callback['param']);
        }
        else {
            return call_user_func([$className, $methodNmae]);
        }
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