<?php

namespace Config;

class Request{

    
    private $controller;
    private $method;
    private $parameters = array();

    public function __construct()
    {

        //Filtrado de URL que nos envia el .htaccess y armado de array con los datos (controller, method y parameters)
        $url = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
        $urlArray = explode("/", $url);
        $urlArray = array_filter($urlArray);

        //Obtenemos primero el nombre del controller a usar
        if(empty($urlArray))
            $this->controller = "Home";            
        else
            $this->controller = ucwords(array_shift($urlArray));

        //Luego obtenemos el nombre del method elegido
        if(empty($urlArray))
            $this->method = "Index";
        else
            $this->method = array_shift($urlArray);

        //Ahora vamos por los parametros
        $methodRequest = $this->getMethodRequest();

        if($methodRequest == "GET")
        {
            unset($_GET["url"]); //Descarto el Key 'url' y su valor

            if(!empty($_GET)) 
            {                    
                foreach($_GET as $key => $value)                    
                    array_push($this->parameters, $value);
            }
            else
                $this->parameters = $urlArray;
        }
        elseif ($_POST)
            $this->parameters = $_POST;

        //Para manejo de Files ver framework modelo de catedra
    }

    public function getController(){ return $this->controller; }
    public function setController($controller): self { $this->controller = $controller; return $this; }

    public function getMethod(){ return $this->method; }
    public function setMethod($method): self { $this->method = $method; return $this; }

    public function getParameters(){ return $this->parameters; }
    public function setParameters($parameters): self { $this->parameters = $parameters; return $this; }
}


?>