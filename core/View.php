<?php

namespace core;

class View
{
    public function __construct()
    {
        // self::$response = self::responseObj();
    }
    public static function render(string $view, array $params=[], string $layoutName='app')
    {
        $viewFile = ROOTH_PATH.'/public/views/'.$view.'.php';

        if(is_file($viewFile))
        {
            return self::renderLayout($view, $params, $layoutName);
        }
        else {
            Application::$app->response->setResponseCode(404);
            Application::$app->response->_callback(['class'=>[controllers\ErrorController::class, 'pageNotFound']]);
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
        foreach($params as $key=>$value){
            $$key = $value;
        }
        ob_start();
        include_once ROOTH_PATH."/public/views/$view.php";
        return ob_get_clean();
    }
}