<?php 
namespace Models;

class JobPosition {
    
    private $idJobPosition;
    private $description;
    private $careerId;

    public function getIdJobPosition(){ return $this->idJobPosition; }
    public function setIdJobPosition($jobId): self { $this->idJobPosition = $jobId; return $this; }

    public function getCareerId(){ return $this->careerId; }
    public function setCareerId($careerId): self { $this->careerId = $careerId; return $this; }

    public function getDescription(){ return $this->description; }
    public function setDescription($description): self { $this->description = $description; return $this; }
}
?>