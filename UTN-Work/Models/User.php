<?php 

namespace Model;

abstract class User{

    private $userId;
    private $email;
    private $password;
    private $active;

    abstract function viewProfile();

    

    public function getUserId(){ return $this->userId; }
    public function setUserId($userId): self { $this->userId = $userId; return $this; }

    public function getEmail(){ return $this->email; }
    public function setEmail($email): self { $this->email = $email; return $this; }

    public function getPassword(){ return $this->password; }
    public function setPassword($password): self { $this->password = $password; return $this; }

    public function getActive(){ return $this->active; }
    public function setActive($active): self { $this->active = $active; return $this; }
}

?>