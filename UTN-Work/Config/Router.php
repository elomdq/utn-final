<?php

namespace Config;

use Config\Request as Request;

class Router{

    public static function route(Request $request){
        $controllerName = $request->getController();
        $methodName = $request->getMethod();
        $methodParameters = $request->getparameters();

        $controllerClassName = 'Controllers\\' . $controllerName;

        $controller = new $controllerClassName;

        //hago lamada de la funcion enviada en el Request 
        if(!isset($methodParameters))            
            call_user_func(array($controller, $methodName));
        else
            call_user_func_array(array($controller, $methodName), $methodParameters);
    }

}

?>