<?php

namespace core;
use core\traits\ErrorsTraits;

class View
{
    use ErrorsTraits;
    
    public static function render(string $view, array $params=[], string $layoutName='app'): string
    {
        $viewFile = ROOTH_PATH.'/public/views/'.$view.'.php';

        if(is_file($viewFile))
        {
            return self::renderLayout($view, $params, $layoutName);
        }
        else
        {
            return Application::$app->response->_callback(['class'=>[ErrorController::class, 'pageNotFound']]);
        }
    }
    private static function renderLayout(string $view, array $params=[], string $layoutName='app'): string
    {
        $viewContent = self::renderView($view, $params);
        ob_start();
        include_once ROOTH_PATH."/public/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    private static function renderView(string $view, array $params=[]): string
    {
        foreach($params as $key=>$value)
        {
            $$key = $value;
        }
        ob_start();
        include_once ROOTH_PATH."/public/views/$view.php";
        return ob_get_clean();
    }
}