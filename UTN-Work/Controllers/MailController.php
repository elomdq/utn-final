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
        $headers = "From: carlos@gmail.com" . "\r\n";

        mail($email, $subject, $message);
    }

    public function sendThanksEmails($emailList, $offerTitle){
        $message = wordwrap("La publicacion de la oferta laboral" . $offerTitle . " a cerrado. Muchas gracias por su postulación. La empresa se estará comunicando a su tiempo. Saludos", 70) ;
        
        foreach($emailList as $email){
            $this->sendEmail($email, "Oferta cerrada", $message);
        }
    }

    public function sendDeclineEmail($email, $offerTitle){
        $message = wordwrap("Tu postulación a la oferta laboral" . $offerTitle . " a sido declinada.", 70);

        $this->sendEmail($email, "Postulacion a oferta \"".$offerTitle."\" declinada", $message);
    }

}


/*
$user = $userController->GetUserById((int) $parameters["userId"]);
$to_email = $user->getEmail();
$subject = APPLY_DELETE_EMAIL_SUBJECT;
$body = APPLY_DELETE_EMAIL;
$headers = APPLY_DELETE_EMAIL_HEADER;

mail($to_email, $subject, $body, $headers);
*/

?>

