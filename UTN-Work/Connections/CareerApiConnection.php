<?php 
namespace Connections;

use DAO\CareerDAO as CareerDAO;
use Models\Career as Career;

class CareerApiConnection{

    private $url;
    private $curlHandler;
    private $header;

    public function __construct()
    {
        //Conexion a API alumnos
        $this->url = "https://utn-students-api.herokuapp.com/api/Career" ;

        $this->curlHandler = curl_init();
        $this->header = array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08");

        //seteo
        curl_setopt($this->curlHandler, CURLOPT_URL, $this->url);
        curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER, $this->header);
    }

    //ejecuto el curl handler y guardo el string que retorna
    public function executeCurl(){
        return curl_exec($this->curlHandler);
    }

    
}

?>

