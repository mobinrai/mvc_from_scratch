<?php

namespace core\middlewares;

use core\Application;
use core\controllers\ErrorController;
use core\exceptions\ForbiddenException;

class AuthenticationMiddleware extends BaseMiddleware
{
    protected array $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::$app->isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controllerAction, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}