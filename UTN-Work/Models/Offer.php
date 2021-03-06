<?php 

namespace Models;


class Offer{

    private $offerId;
    private $title;
    private $description;
    private $companyId;
    private $salary;
    private $active;
    private $publicationDate;
    private $dueDays;
    private $careerId;
    private $jobPosition;
    private $city;

    private $applicants;


    public function showDetails(){
        $this->applicants = array();
    }

    
    public function getOfferId(){ return $this->offerId; }
    public function setOfferId($offerId): self { $this->offerId = $offerId; return $this; }

    public function getTitle(){ return $this->title; }
    public function setTitle($title): self { $this->title = $title; return $this; }

    public function getJobPosition(){ return $this->jobPosition; }
    public function setJobPosition($jobPosition): self { $this->jobPosition = $jobPosition; return $this; }

    public function getDescription(){ return $this->description; }
    public function setDescription($description): self { $this->description = $description; return $this; }

    public function getCompanyId(){ return $this->companyId; }
    public function setCompanyId($companyId): self { $this->companyId = $companyId; return $this; }

    public function getSalary(){ return $this->salary; }
    public function setSalary($salary): self { $this->salary = $salary; return $this; }

    public function getActive(){ return $this->active; }
    public function setActive($active): self { $this->active = $active; return $this; }

    public function getPublicationDate(){ return $this->publicationDate; }
    public function setPublicationDate($publicationDate): self { $this->publicationDate = $publicationDate; return $this; }

    public function getCareerId(){ return $this->careerId; }
    public function setCareerId($careerId): self { $this->careerId = $careerId; return $this; }

    public function getApplicants(){ return $this->applicants; }
    public function setApplicants($applicants): self { $this->applicants = $applicants; return $this; }

    public function getDueDays(){ return $this->dueDays; }
    public function setDueDays($dueDays): self { $this->dueDays = $dueDays; return $this; }

    public function getCity(){ return $this->city; }
    public function setCity($city): self { $this->city = $city; return $this; }
}

?>