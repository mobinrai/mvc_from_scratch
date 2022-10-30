<?php

namespace core;

class Validation
{
    const EMAIL_VALIDATION = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    const TEXT = '/^([a-zA-Z 0-9]+)([! ,.])?$/';
    // ([, _!]?)
    const NUMBERS = '/^\d+$/';
    const ALPHABETS = '/^[a-zA-z\s]+$/';
    const PHONE_NUMBER = '/^[+]?(\d{1,2})?[\s.-]?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/';
    public static array $errorMessages = [];
    public function __construct()
    {}

    public function validate(array $validation_rules): bool
    {
        $errors = [];
        foreach($validation_rules as $key=>$validation_rule)
        {
            $rules = $validation_rule;
            if(is_string($validation_rule) && strpos($validation_rule, '|') >0)
            {
                $rules = array_diff(explode('|', $validation_rule), ['']);
            }
            $data = Application::$app->request->getData()[$key];
            
            foreach($rules as $rule)
            {
                if(is_array($rule)){

                }else
                {
                    if($rule === 'required' && empty($data))
                    {
                        $errors[$key][$rule] = $this->replaceFieldInErrorMessage($key, $rule);
                    }
                    if($rule === 'email' && !preg_match(Validation::EMAIL_VALIDATION, $data) && !empty($data))
                    {
                        $errors[$key][$rule] = $this->replaceFieldInErrorMessage($key, $rule);
                    }
                    if($rule === 'number' && !preg_match(Validation::NUMBERS, $data) && !empty($data))
                    {
                        $errors[$key][$rule] =  $this->replaceFieldInErrorMessage($key, $rule);
                    }
                    if($rule === 'alpha' && !preg_match(Validation::ALPHABETS, $data) && !empty($data))
                    {
                        $errors[$key][$rule] =  $this->replaceFieldInErrorMessage($key, $rule);
                    }
                    if(strpos($rule, ':') && !empty($data))
                    {
                        list($ruleName, $pattern) = explode(':', $rule);
                        if($ruleName ==='length' && !empty($data) && strlen($data) < $pattern)
                        {
                            $errors[$key][$rule] = str_replace('{pattern}', $pattern, $this->replaceFieldInErrorMessage($key, $rule));
                        }
                    }
                }
            }
        }
        self::$errorMessages= $errors;
        return !empty($errors) ? false: true;
    }
    private function replaceFieldInErrorMessage(string $key, string $rule){
        return str_replace('{field}', $this->replaceInputUnderline($key), $this->errorMessages()[$rule]);
    }
    private function errorMessages(): array
    {
        return [
            'required'=> 'The {field} field is required.',
            'email' => 'The {field} field must be a valid email address.',
            'number' => 'The {field} field must be a valid numbers.',
            'string' => 'The {field} field must be valid string.',
            'length' => 'The {field} field must be at least {pattern}'
        ];
    }

    public function getErrorMessage($key): string
    {
        return $this->errorMessages[$key];
    }
    private function replaceInputUnderline(string $input_name): string
    {
        return str_replace("_", ' ',$input_name);
    }
    
}