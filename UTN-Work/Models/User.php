<?php 

namespace Models;

class User{

    private $userId;
    private $email;
    private $password;
    private $active;
    private $userType;

    public function __construct()
    {
    }  

    public function getUserId(){ return $this->userId; }
    public function setUserId($userId): self { $this->userId = $userId; return $this; }

    public function getEmail(){ return $this->email; }
    public function setEmail($email): self { $this->email = $email; return $this; }

    public function getPassword(){ return $this->password; }
    public function setPassword($password): self { $this->password = $password; return $this; }

    public function getActive(){ return $this->active; }
    public function setActive($active): self { $this->active = $active; return $this; }
    
    public function getUserType(){ return $this->userType; }
    public function setUserType($userType): self { $this->userType = $userType; return $this; }

    //public static function getIdCounter(){ return self::$idCounter; }
}

?>