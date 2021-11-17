<?php 

namespace Models;

use Models\User as User;

class Admin extends User{

    private $adminId;
    private $firstName;
    private $lastName;

    function __construct(){
       
    }

    public function getFirstName(){ return $this->firstName; }
    public function getLastName(){ return $this->lastName; }
    
    public function setFirstName($name): self { $this->firstName = $name; return $this; }
    public function setLastName($lastName): self { $this->lastName = $lastName; return $this; }

    public function getAdminId(){ return $this->adminId; }
    public function setAdminId($adminId): self { $this->adminId = $adminId; return $this; }
}

?>