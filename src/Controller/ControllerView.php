<?php

namespace Soccer\Api\Controller;

use Exception;
use League\Plates\Engine;

abstract class ControllerView
{
    public static function view()
    {
        //apontar para caminho da pasta onde serão armazenadas as views
        $viewPath = dirname(__FILE__, 2)."/Views";
      
        if(!file_exists($viewPath. DIRECTORY_SEPARATOR.$view.".php")){
            throw new Exception("A view {$view} não foi encontrada.");        
        }
        $templates = new Engine($viewPath);
        //echo $templates->render($view, $data);
        return $templates;
    }
}