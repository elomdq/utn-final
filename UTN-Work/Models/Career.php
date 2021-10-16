<?php 

namespace Models;

class Career{

    private $idCareer;
    private $description;
    private $active;

  
    public function getIdCareer(){ return $this->idCareer; }
    public function setIdCareer($idCareer): self { $this->idCareer = $idCareer; return $this; }

    public function getDescription(){ return $this->description; }
    public function setDescription($description): self { $this->description = $description; return $this; }

    public function getActive(){ return $this->active; }
    public function setActive($active): self { $this->active = $active; return $this; }
}

?>