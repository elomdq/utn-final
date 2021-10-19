<?php 
namespace Controllers;

use Models\Company as Company;
use DAO\CompanyDAO as CompanyDAO;

class AdminController{

    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO;
    }

    public function showCompaniesList()
    {
        require_once VIEWS_PATH . "validate-session.php";
        require_once VIEWS_PATH . "nav.php";
        require_once VIEWS_PATH . "companies-list.php";
    }

}


?>