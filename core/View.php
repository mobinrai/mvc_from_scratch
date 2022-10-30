<?php

namespace core;
use core\traits\ErrorsTraits;

class View
{
    use ErrorsTraits;
    
    public function render(string $view, array $params=[], string $layoutName='app'): string
    {
        $viewFile = ROOTH_PATH.'/public/views/'.$view.'.php';

        if(is_file($viewFile))
        {
            return self::renderLayout($view, $params, $layoutName);
        }
        else
        {
            return $this->pageNotFound('View file not found');
        }
    }
    private function renderLayout(string $view, array $params=[], string $layoutName='app'): string
    {
        $viewContent = self::renderView($view, $params);
        ob_start();
        include_once ROOTH_PATH."/public/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    private function renderView(string $view, array $params=[]): string
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