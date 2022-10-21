<?php

namespace core;

class Request{
    private string $action;
    private string $path;
    private array $data = [];
    private array $allowedMethods=['get', 'post', 'delete'];
    public function __construct()
    {
        $this->setMethod();
        $this->setPath();
    }
    public function setMethod(): void
    {
        $this->action = $_SERVER['REQUEST_METHOD'];
    }
    public function setPath(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        if(strlen($requestUri)>1){
            $path = $requestUri[strlen($requestUri)-1] === '/' ? substr_replace($requestUri, '', -1): $requestUri;
        }else{
            $path = $requestUri;
        } 
        $this->path = htmlspecialchars($path);
    }
    public function getMethod(): string
    {
        return strtolower($this->action);
    }
    public function getPath(): string 
    {
        return strtolower($this->path);
    }
    public function getData(): array
    {
        $this->data = $this->clearData();
        return $this->data;
    }
    private function clearData(): array
    {
        $result = [];
        if($this->getMethod() === 'get') {
            foreach($_GET as $key => $value){
                $result[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->getMethod() === 'post') {
            foreach($_POST as $key => $value){
                $result[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $result;
    }
    public function checkAllowedMethods(): bool
    {
        return in_array($this->getMethod(), $this->allowedMethods);
    }
}