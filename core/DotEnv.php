<?php

namespace core;
use core\exceptions\PageNotFoundException;

class DotEnv
{
    protected string $path = '';
    protected Response $response;
    public function __construct(string $path)
    {
        $this->setPath($path);
    }
    public function setPath(string $path): void
    {
        try{
            if(!is_file($path)){
                throw new \InvalidArgumentException(sprintf('%s file not found', $path), 404);
            }
        }catch(\Exception $e){
            echo $e->getMessage();
            throw new PageNotFoundException(".env file not found");
        }
        $this->path = $path;
    }
    public function readFile(): void
    {
        try{
            if(!is_readable($this->path)){
                throw new \InvalidArgumentException(sprintf('%s file is not readable', $this->path), 404);
            }
            else{
                $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {

                    if (strpos(trim($line), '#') === 0) {
                        continue;
                    }
        
                    list($name, $value) = explode('=', $line, 2);
                    $name = trim($name);
                    $value = trim($value);
        
                    if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                        putenv(sprintf('%s=%s', $name, $value));
                        $_ENV[$name] = $value;
                    }
                }
            }
        }catch(\Exception $e){
            if($e->getCode()== 404){
                echo $e->getMessage();
                throw new PageNotFoundException(".env file is not readable");
            }
        }
    }
    
}