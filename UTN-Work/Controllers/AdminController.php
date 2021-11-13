<?php 
namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use Models\Company as Company;
use DAO\CompanyDAO as CompanyDAO;
use Models\Alert as Alert;

class AdminController{

    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
    }

    public function showCompaniesList(Alert $alert = null)
    {
        SystemFunctions::validateSession();
        require_once(VIEWS_PATH."header.php");
        require_once VIEWS_PATH . "nav.php";
        require_once VIEWS_PATH . "companies-list.php";
        require_once(VIEWS_PATH."footer.php");
    }

}


?>