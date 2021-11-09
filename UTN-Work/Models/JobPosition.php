<?php 
namespace Models;

class JobPosition {
    
    private $idJobPosition;
    private $descripcion;
    private $careerId;

    public function getIdJobPosition(){ return $this->idJobPosition; }
    public function setIdJobPosition($jobId): self { $this->idJobPosition = $jobId; return $this; }

    public function getDescripcion(){ return $this->descripcion; }
    public function setDescripcion($descripcion): self { $this->descripcion = $descripcion; return $this; }

    public function getCareerId(){ return $this->careerId; }
    public function setCareerId($careerId): self { $this->careerId = $careerId; return $this; }
}
?>