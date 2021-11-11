<?php 

namespace Models;

use Models\User as User;

class Admin extends User{

    private $name;
    private $lastName;

    function __construct(){
       
    }

    public function getFirstName(){ return $this->name; }
    public function getLastName(){ return $this->lastName; }
    
    public function setFirstName($name): self { $this->name = $name; return $this; }
    public function setLastName($lastName): self { $this->lastName = $lastName; return $this; }

}

?>