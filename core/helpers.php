<?php

if(!function_exists('getCurrentUrl')){
    function getCurrentUrl(){
       return filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL); 
    }
}