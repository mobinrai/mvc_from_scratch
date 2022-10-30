<?php

namespace core;

use core\exceptions\PageNotFoundException;
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
    public function getCurrentRoute(): string
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $callback = $this->replacePath($method, $path);
        if(!key_exists('message', $callback)){
            $controllerName = new $callback['class'][0]();
            $methodName =  $callback['class'][1];

            if((new ReflectionClass($controllerName))->hasMethod($methodName) 
                && (new ReflectionMethod($controllerName, $methodName))->isPublic())
            {
                Application::$app->controllerAction = $methodName;
                foreach($controllerName->getMiddlewares() as $middleware)
                {
                    $middleware->execute();
                }
                if(key_exists('param', $callback) && sizeof($callback['param']) > 0)
                {
                    return call_user_func([$controllerName,$methodName], $this->request, implode(',',$callback['param']));
                }
                else
                {
                    return call_user_func([$controllerName,$methodName], $this->request);
                }
            }
        }
        throw new PageNotFoundException;
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
        return ['message' => 'page not found'];
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
