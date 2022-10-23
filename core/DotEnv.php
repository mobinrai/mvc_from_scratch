<?php

namespace core;

use core\traits\ErrorsTraits;

class DotEnv
{
    use ErrorsTraits;
    protected string $path = '';
    protected Response $response;
    public function __construct(string $path)
    {
        $this->setPath($path);
    }
    public function setPath(string $path)
    {
        try{
            if(!is_file($path)){
                throw new \InvalidArgumentException(sprintf('%s file not found', $path), 404);
            }
        }catch(\Exception $e){
            echo $e->getMessage();
            $this->pageNotFound('.env file is not a file');
        }
        $this->path = $path;
    }
    public function readFile(){
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
                $this->pageNotFound('.Env file is not readable');
            }
        }
    }
    
}