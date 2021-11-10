<?php 
namespace Connections;

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

    public function getUrl(){ return $this->url; }
    public function setUrl($url): self { $this->url = $url; return $this; }

    public function getCurlHandler(){ return $this->curlHandler; }
    public function setCurlHandler($curlHandler): self { $this->curlHandler = $curlHandler; return $this; }

    public function getHeader(){ return $this->header; }
    public function setHeader($header): self { $this->header = $header; return $this; }

    
}

?>

