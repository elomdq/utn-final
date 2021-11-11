<?php

namespace Config;

class Autoload{

    public static function start(){

        //call al metodo spl_autoload_register para registrar una nueva funcion de autoload a la queue
        spl_autoload_register(function($className)
			{
                $classPath = ucwords(str_replace("\\", "/", ROOT.$className).".php");
                
				require_once($classPath);
			});

    }

}

?>