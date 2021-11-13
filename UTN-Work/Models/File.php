<?php 
namespace Models;

class File{
    
    private $idFile;
    private $idOwner;
    private $url;
    
    public function getIdFile()
    {
        return $this->idFile;
    }

    public function setIdFile($idFile)
    {
        $this->idFile = $idFile;

        return $this;
    }

    public function getIdOwner()
    {
        return $this->idOwner;
    }

    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
?>