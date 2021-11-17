<?php 
namespace Controllers;

use Models\User as User;

class MailController{

    private $to;
    private $subject;
    private $message;
    private $headers;

    public function __construct()
    {
        
    }

    public function getTo(){ return $this->to; }
    public function setTo($to): self { $this->to = $to; return $this; }

    public function getSubject(){ return $this->subject; }
    public function setSubject($subject): self { $this->subject = $subject; return $this; }

    public function getMessage(){ return $this->message; }
    public function setMessage($message): self { $this->message = $message; return $this; }

    public function getHeaders(){ return $this->headers; }
    public function setHeaders($headers): self { $this->headers = $headers; return $this; }


    public function sendEmailChain(){

    }

    public function sendEmail($email, $subject, $message){
        $headers = "From: admin@gmail.com" . "\r\n" .
        "CC: anymail@example.com";
        mail($email, $subject, $message);
    }
}

?>