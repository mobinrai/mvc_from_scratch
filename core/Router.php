<?php

namespace core;

use core\traits\ErrorsTraits;
use ReflectionClass;
use ReflectionMethod;

class Router{
    use ErrorsTraits;
    protected static array $routes=[];
    protected Request $request;

    protected Response $response;
    
    public function __construct(Request $request, Response $response)
    {
        include_once ROOTH_PATH.'/public/router.php';
        $this->request = $request;
        $this->response = $response;
    }

    public static function get($param, $callback): void
    {
        self::$routes['get'][$param] = $callback;
    }
    public static function post($param, $callback): void
    {
        self::$routes['post'][$param] = $callback;
    }
    public function getCurrentRoute(): array
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $callback = $this->replacePath($method, $path);        
        $reflactionClass = new $callback['class'][0]();
        $reflextionMethod =  $callback['class'][1];       

        if((new ReflectionClass($reflactionClass))->hasMethod($reflextionMethod) 
            && (new ReflectionMethod($reflactionClass, $reflextionMethod))->isPublic())
        {
            $method = new ReflectionMethod($reflactionClass, $reflextionMethod);
            $paramList = $method->getParameters();
            if(sizeof($paramList) > 0)
            {
                $args = [];
                foreach($paramList as $list)
                {
                    if($list->name === 'request')
                    {
                        $args[$list->name] = $this->request;
                    }
                    else if(key_exists($list->name, $callback['param'])){
                        $args[$list->name] = $callback['param'][$list->name];
                    }
                }
                $callback['param'] = $args; 
                return ($callback);
            }
            else
            {
                return ($callback);
            }
        }
        $this->methodNotFound['param']['message'] = $path; 
        return $this->methodNotFound;
    }
    private function replacePath($method, $path): array
    {
        if(self::$routes[$method][$path] != null)
        {
            return ['class'=>self::$routes[$method][$path]];
        }
        foreach(self::$routes[$method] as $param=>$route)
        {
            if(strpos($param, '{')>0)
            {
                $route = $this->explodeRoute($param);
                if(preg_match($route, $path, $matches))
                {
                    $values = [];
                    foreach($matches as $key=>$value)
                    {
                        if(is_string($key))
                        {
                            $values[$key] = $value;
                        }                        
                    }
                    return ['class'=> self::$routes[$method][$param], 'param'=>$values];
                }
            }            
        }
        $this->methodNotFound['param']['message'] = $path; 
        return $this->methodNotFound;
    }
    private function explodeRoute($param): string
    {
        $explodeParam = array_diff(explode('/', $param),['']);
        $route = '';
        foreach($explodeParam as $expParam){
            if(strpos($expParam, '{')===0)
            {
                $route.= '/'.preg_replace('/\{([a-z]+):([^.]+)\}/', '(?P<\1>($2))', $expParam);
            }else{
                $route.= '/'.$expParam;
            }
        }
        $route = '/^'.preg_replace('/\//','\\/', $route).'$/i';
        return $route;
    }
}
