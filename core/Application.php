<?php

namespace core;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public DotEnv $dotEnt;
    public static Application $app;
    public Database $db;
    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->router = new Router($this->request, $this->response);
        self::$app = $this;
        $this->db = new Database();
    }

    public function run(): void
    {
        if($this->request->checkAllowedMethods())
        {
            $route = $this->router->getCurrentRoute();
            echo ($this->response->_callback($route));
        }
        else
        {
            $this->response->setResponseCode(502);
            exit;
        }        
    }
}