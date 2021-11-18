<?php 
namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use \Exception as Exception;

use Models\Company as Company;
use Models\User as User;
use DAO\CompanyDAO as CompanyDAO;
use DAO\UserDAO as UserDAO;
use Models\Alert as Alert;

class CompanyController{

    private $companyDAO;
    private $userDAO;
    private $userType = 2;
    private $passDefault = 123456;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
        $this->userDAO = new UserDAO;   
    }

    public function addView(Alert $alert = null){
        SystemFunctions::validateSession();
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH . "nav.php";
        require_once VIEWS_PATH . "company-add.php";
        require_once VIEWS_PATH."footer.php";
    }


    public function createCompany(...$values)  {
       
        try{
            $alert = new Alert();
            if($_POST)
            {
                if($this->ValidateInputValues($_POST['companyName'], $_POST['telephone'], $_POST['city'], $_POST['address'], $_POST['cuit'], $_POST['email']))
                {  
                    $company = new Company;

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

                    $this->userDAO->add($company->getEmail(), $company->getActive(), $this->userType, $this->passDefault);

                    $company->setUserId($this->userDAO->getUserIdByEmail($company->getEmail()));

                    $this->companyDAO->Add($company);

                    $alert->setType('success');
                    $alert->setMessage("La empresa se creo con exito.");

                    $this->addView($alert);
                } else {
                    $alert->setType("danger");
                    $alert->setMessage("danger", "Verifique que los campos se encuentren correctamente completos.");
                    $this->addView($alert);
                }
            } else {
                $alert->setType("danger");
                $alert->setMessage("Hubo un fallo con el envío del formulario");
                $this->addView($alert);
            }
        } catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            //$this->addView($alert);
            ViewController::erroConnectionView($alert);
        }
        
    } 

    public function deleteCompany($companyId)
    {
        $alert = new Alert();

        try{
            $this->companyDAO->remove($companyId);
            $alert->setType("succes");
            $alert->setMessage("Eliminada con exito!");
        }
        catch(Exception $e){
            $alert = new Alert("danger", $e->getMessage());
        } finally{
            $this->listCompanies($alert);
        }
    }


    public function listCompanies(){
        SystemFunctions::validateSession();

        $alert = new Alert;

        try{
            $companiesList = array();

            if(isset($_GET['searchKey']) && $_GET['searchKey']!= null)
            {
                foreach($this->companyDAO->getAll() as $company){
                    if(stristr($company->getCompanyName(), $_GET['searchKey'])){
                        array_push($companiesList, $company); 
                    }
                }
                unset($_SESSION['searchKey']);
            } else {
                if($_SESSION['userType'] != 1) {
                    foreach($this->companyDAO->getAll() as $company){
                        if($company->getActive()){
                            array_push($companiesList, $company);
                        }
                    }
                } else{
                    $companiesList = $this->companyDAO->getAll();
                }  
            }

            require_once VIEWS_PATH."header.php";
            require_once VIEWS_PATH . "nav.php";
            require_once VIEWS_PATH."companies-list.php";
            require_once VIEWS_PATH."footer.php";

        } catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
            ViewController::erroConnectionView($alert);
        }
    }

    private function ValidateInputValues($companyName, $telephone, $city, $address, $cuit, $email){
        $validated = false;
        if(isset($companyName) && isset($telephone) && isset($city) && isset($address) && isset($cuit) && isset($email))
            if(!empty($companyName) && !empty($telephone) && !empty($city) && !empty($address) && !empty($cuit) && !empty($email))
                $validated = true;
        
        return $validated;
    }

    public function showCompanyDetails($companyId, Alert $alert = null){
        SystemFunctions::validateSession();
        $company = $this->companyDAO->getCompanyById($companyId);
        
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "company-details.php";
        require_once VIEWS_PATH."footer.php";
    }

    //acciona el proceso de edicion de una empresa
    public function editCompany($companyId)
    {
        SystemFunctions::validateSession();
        $company = $this->companyDAO->getCompanyById($companyId);

        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH . "nav.php" ;
        require_once VIEWS_PATH . "company-edit.php";
        require_once VIEWS_PATH."footer.php";
    }

    //se encarga de recibir los datos de la empresa, validar, generar el objeto y sobreescribir el .json
    public function modifyCompany(...$values) //no concidero el active y el userId como params, aunque pueden ser enviados
    {
        $alert = new Alert();

        try{
            if($_POST)
            {
                if($this->ValidateInputValues($_POST['companyName'], $_POST['telephone'], $_POST['city'], $_POST['address'], $_POST['cuit'], $_POST['email']))
                {

                    $company = new Company;

                    $company->setCompanyName($_POST['companyName']);
                    $company->setTelephone($_POST['telephone']);
                    $company->setAddress($_POST['address']);
                    $company->setCity($_POST['city']);
                    $company->setCuit($_POST['cuit']);
                    $company->setEmail($_POST['email']);
                    $company->setIdCompany($_POST['companyId']);
                    $company->setUserId($_POST['userId']);
                
                    if (isset($_POST['active'])) 
                    {
                        $company->setActive(true);
                    } else {
                        $company->setActive(false);
                    }

                    $this->companyDAO->overwriteCompany($company);
                    $this->showCompanyDetails($company->getIdCompany());

                    $alert->setType('success');
                    $alert->setMessage("Se agrego con exito.");
                } else {
                    $alert->setType('danger');
                    $alert->setMessage("Dato faltante");
                    $this->addView($alert);
                }
            } else {
                $alert->setType('danger');
                $alert->setMessage("Algo fallo en el envio de datos. Intentelo nuevamente");
                $this->addView($alert);
            }
        }
        catch(Exception $e){
            $alert->setType('danger');
            $alert->setMessage($e->getMessage());
        }
        finally{
            $this->addView($alert);
        }
    }
}

?>