<?php

namespace core\middlewares;

use core\Application;
use core\exceptions\ForbiddenException;

class EmailMiddleware extends BaseMiddleware
{
    protected array $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::$app->sessionManager->getSession('registerEmail') == '') {
            if (empty($this->actions) || in_array(Application::$app->controllerAction, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}
?>