<?php

use app\models\Category;
use core\model\BaseModel;
use core\Request;
use core\SessionManager;
use core\Validation;

if(!function_exists('getCurrentUrl')){
    function getCurrentUrl(): string
    {
       return filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL); 
    }
}

if(!function_exists('old_value')){
    function old_value(string $inputname): string
    {
        $value = '';
        if(sizeof(Request::$formData)>0){
            $value = Request::$formData[$inputname];
        }
        return $value;
    }
}

if(!function_exists('getErrorMessage')){
    function getErrorMessage(string $inputname): string
    {
        $result = '';
        if(sizeof(Validation::$errorMessages) > 0 && key_exists($inputname, Validation::$errorMessages)){
            $result = Validation::$errorMessages[$inputname];
            if(is_array($result)){
                foreach($result as $key=>$value){
                    return $value;
                }
            }
        }
        return $result;
    }
}
if(!function_exists('isLogin')){
    function isLogin(): bool
    {
        $session_manager = new SessionManager();
        return !empty($session_manager->getSession('user_email'))? true : false;
    }
}

if(!function_exists('getCategories')){
    function getCategories(): array
    {
        $categories = [];
        $category = new Category;
        $query = Category::select('title', 'slug')->from($category->tableName())
                ->where('parent_id = :parent_id');
        $result = $category->dbExecute($query, ['parent_id' => 0]);
        $categories = $result->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
}

if(!function_exists('userEmail')){
    function userEmail(): string
    {
        $session_manager = new SessionManager();
        return !empty($session_manager->getSession('user_email'))? $session_manager->getSession('user_email'): '';
    }
}