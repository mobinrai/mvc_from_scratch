<?php

namespace core\controllers;

use core\middlewares\BaseMiddleware;
use core\View;

class Controller
{
    public string $action = '';
    protected array $middlewares = [];
    public function __construct()
    {
    }
    public function render(string $page_name, array $params=[]): string
    {
        $view = new View;
        return $view->render($page_name, $params);
    }
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
