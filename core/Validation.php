<?php

namespace core;

class Validation
{
    const EMAIL_VALIDATION = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    const TEXT = '/^([a-zA-Z 0-9]+)([! ,.])?$/';
    // ([, _!]?)
    const NUMBERS = '/^[0-9]+$/';
    const STRINGS = '/^[a-zA-z\s]+$/';
    const PHONE_NUMBER = '/^[+]?(\d{1,2})?[\s.-]?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/';
    private array $errorMessages = [];

    public function __construct()
    {}

    public function validate(array $rules)
    {
        $errors=[];
        foreach($rules as $key=>$validation_rule)
        {
            if(is_array($validation_rule))
            {
                $data = Application::$app->request->getData()[$key];
                foreach($validation_rule as $rule)
                {
                    if($rule === 'required' && empty($data)){
                        $errors[$key][$rule] = str_replace('{field}', $key, $this->errorMessages()[$rule]);
                    }
                    if($rule === 'email' && !preg_match(Validation::EMAIL_VALIDATION, $data) && !empty($data)){
                        $errors[$key][$rule] = str_replace('{field}', $key, $this->errorMessages()[$rule]);
                    }
                    if($rule === 'number' && !preg_match(Validation::NUMBERS, $data) && !empty($data)){
                        $errors[$key][$rule] = str_replace('{field}', $key, $this->errorMessages()[$rule]);
                    }
                    if($rule === 'string' && !preg_match(Validation::STRINGS, $data) && !empty($data)){
                        $errors[$key][$rule] = str_replace('{field}', $key, $this->errorMessages()[$rule]);
                    }
                    if(strpos($rule, ':') && !empty($data)){
                        list($ruleName, $pattern) = explode(':', $rule);
                        if(in_array($ruleName, ['max', 'min', 'length', 'size']) && is_string($this->checkLength($key, $data, $pattern))){
                            $errors[$key][$rule] = $this->checkLength($key, $data, $pattern);
                        }
                    }
                }
            }
        }
        $this->errorMessages = $errors;
        return !empty($errors) ? $errors: true;        
    }
    private function errorMessages(){
        // return str_replace('{field}', $key, $this->errorMessages[$rule]);
        return [
            'required'=> 'This {field} is required.',
            'email' => 'This {field} must be a valid email address.',
            'number' => 'This {field} must be a valid numbers.',
            'string' => 'This {field} must be valid string.'
        ];
    }

    public function getErrorMessage($key){
        return $this->errorMessages[$key];
    }
    private function checkLength(string $input_name, string $key, string $size){
        if(strlen($key)>$size || strlen($key)< $size){
            return $this->replaceInputUnderline($input_name).' must be same as '.$size;
        }
        return true;
    }
    private function replaceInputUnderline(string $input_name){
        return str_replace("_", ' ',$input_name);
    }
}