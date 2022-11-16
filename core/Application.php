<?php

namespace core;

use core\model\BaseModel;

class Application
{
    public Router $router;
    public Request $request;
    public Response $response;
    public DotEnv $dotEnt;
    
    public string $controllerAction = '';
    public SessionManager $sessionManager;
    public static Application $app;
    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->router = new Router($this->request, $this->response);
        $this->sessionManager = new SessionManager;
        self::$app = $this;
    }

    public function run()
    {
        if($this->request->checkAllowedMethods())
        {
            try
            {
                echo $this->router->getCurrentRoute();
            }
            catch(\Exception $ex)
            {
                $view = new View;
                echo $view->render('errors/error_message', ['message'=>$ex->getMessage()], 'error_app');
            }                     
        }
        else
        {
            $this->response->setResponseCode(502);
            exit;
        }        
    }

    public function userLogin(BaseModel $user): bool
    {
        $this->sessionManager->setSession('user_id', $user->__get('id'));
        $this->sessionManager->setSession('user_email', $user->__get('email'));
        return true;
    }
    public function logout(): bool
    {
        $this->sessionManager->unsetSession('user_id');
        $this->sessionManager->unsetSession('user_email');
        return true;
    }

    public function isGuest():bool
    {
        return $this->sessionManager->getSession('user_id') == ''? true: false;
    }
}