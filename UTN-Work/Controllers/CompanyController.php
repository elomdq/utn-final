<?php 
namespace Controllers;

use Models\Company as Company;
use Models\User as User;
use DAO\CompanyDAO as CompanyDAO;
use DAO\UserDAO as UserDAO;

class CompanyController{

    private $companyDAO;
    private $userDAO;
    private $companiesList;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
        $this->userDAO = new UserDAO;   
    }

    public function addView($message = ""){
        require_once VIEWS_PATH . "validate-session.php";
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH . "nav.php";
        require_once VIEWS_PATH . "company-add.php";
        require_once(VIEWS_PATH."footer.php");
    }


    public function createCompany(...$values)  {
       
        if($_POST)
        {
            if($this->ValidateInputValues($_POST['companyName'], $_POST['telephone'], $_POST['city'], $_POST['address'], $_POST['cuit'], $_POST['email']))
            {

                
                $company = new Company;

                $company->setCompanyName($_POST['companyName']);
                $company->setTelephone($_POST['telephone']);
                $company->setAddress($_POST['city']);
                $company->setCity($_POST['address']);
                $company->setCuit($_POST['cuit']);
                $company->setEmail($_POST['email']);
                
                if (isset($_POST['active'])) 
                {
                    $companyParameters['active'] = true;
                } else {
                    $companyParameters['active'] = false;
                }

                $this->userDAO->add($company->getEmail(), $company->getActive());

                $company->setUserId($this->userDAO->getUserIdByEmail($company->getEmail()));

                $this->companyDAO->Add($company);

                $this->listCompanies();
            } else {
                $this->addView("Verifique que los campos se encuentren correctamente completos.");
            }
        } else {
            $this->addView("Incorrecto ingreso de datos.");
        }
    } 

    public function deleteCompany($companyId)
    {
        $this->companyDAO->remove($companyId);
        $this->listCompanies();
    }


    public function listCompanies(){
        require_once VIEWS_PATH . "validate-session.php";
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH . "nav.php";
        //$this->companiesList = $this->companyDAO->GetAll();
        require_once(VIEWS_PATH."companies-list.php");
        require_once(VIEWS_PATH."footer.php");
    }

    private function ValidateInputValues($companyName, $telephone, $city, $address, $cuit, $email){
        $validated = false;

        if(isset($companyName) && isset($telephone) && isset($city) && isset($address) && isset($cuit) && isset($email))
            if(!empty($companyName) && !empty($telephone) && !empty($city) && !empty($address) && !empty($cuit) && !empty($email))
                $validated = true;
        
        return $validated;
    }

    public function showCompanyDetails($companyId){
        require_once VIEWS_PATH . "validate-session.php";
        require_once(VIEWS_PATH."header.php");

        //paso la empresa por la variable superglobal SESSION
        $_SESSION['company'] = $this->companyDAO->getCompanyById($companyId);

        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "company-details.php";
        require_once(VIEWS_PATH."footer.php");
    }

    //acciona el proceso de edicion de una empresa
    public function editCompany($companyId)
    {
        require_once VIEWS_PATH . "validate-session.php";
        require_once(VIEWS_PATH."header.php");

        //paso la empresa por la variable superglobal SESSION
        $_SESSION['company'] = $this->companyDAO->getCompanyById($companyId);

        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "company-edit.php";
        require_once(VIEWS_PATH."footer.php");
    }

    //se encarga de recibir los datos de la empresa, validar, generar el objeto y sobreescribir el .json
    public function modifyCompany(...$values) //no concidero el active y el userId como params, aunque pueden ser enviados
    {
        if($_POST)
        {
            if($this->ValidateInputValues($_POST['companyName'], $_POST['telephone'], $_POST['city'], $_POST['address'], $_POST['cuit'], $_POST['email']))
            {
            
                $company = new Company;

                $company->setUserId($_POST['userId']);
                $company->setCompanyName($_POST['companyName']);
                $company->setTelephone($_POST['telephone']);
                $company->setAddress($_POST['address']);
                $company->setCity($_POST['city']);
                $company->setCuit($_POST['cuit']);
                $company->setEmail($_POST['email']);
               
                if (isset($_POST['active'])) 
                {
                    $company->setActive(true);
                } else {
                    $company->setActive(false);
                }

                $this->companyDAO->overwriteCompany($company);
                
                $this->showCompanyDetails($company->getUserId());
            } else {
                $this->addView("Verifique que los campos se encuentren correctamente completos.");
            }
        } else {
            $this->addView("Incorrecto ingreso de datos.");
        }
    }
}


?>