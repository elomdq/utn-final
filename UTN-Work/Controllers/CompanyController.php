<?php 
namespace Controllers;

use Models\Company as Company;
use DAO\CompanyDAO as CompanyDAO;

class CompanyController{

    private $companyDAO;
    private $companiesList;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
        
    }

    public function addView($message = ""){
        require_once VIEWS_PATH . "nav.php";
        require_once VIEWS_PATH . "company-add.php";
    }

    public function createCompany($companyName,$telephone,$city,$direction,$cuit,$email)  {
        if($_POST)
        {
            if($this->ValidateInputValues($companyName, $telephone, $city, $direction, $cuit, $email))
            {

                $company = new Company;
                $company->setCompanyName($companyName);
                $company->setTelephone($telephone);
                $company->setDirection($city);
                $company->setCity($direction);
                $company->setCuit($cuit);

                $this->companyDAO->Add($company);

                $this->listCompanies();
            } else {
                $this->addView("Verifique que los campos se encuentren correctamente completos.");
            }
        } else {
            $this->addView("Incorrecto ingreso de datos.");
        }
    } 

    public function listCompanies(){
        require_once VIEWS_PATH . "validate-session.php";
        require_once VIEWS_PATH . "nav.php";
        $this->companiesList = $this->companyDAO->GetAll();
        require_once(VIEWS_PATH."companies-list.php");
    }

    private function ValidateInputValues($companyName, $telephone, $city, $direction, $cuit, $email){
        $validated = false;

        if(isset($companyName) && isset($telephone) && isset($city) && isset($direction) && isset($cuit) && isset($email))
            if(!empty($companyName) && !empty($telephone) && !empty($city) && !empty($direction) && !empty($cuit) && !empty($email))
                $validated = true;
        
        return $validated;
    }
}


?>