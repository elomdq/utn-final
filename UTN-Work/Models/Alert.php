<?php 
namespace Models;


class Alert{
    private $type;
    private $message;

    function __construct($type ="",$message = ""){
     $this->setType($type);
     $this->setMessage($message); 
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
?>