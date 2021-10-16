<?php 

    namespace DAO;

    use Models\Company as Company;

    interface ICompanyDAO{
        
        public function add(Company $company);
        public function remove($companyId);
        public function getAll();

    }

?>