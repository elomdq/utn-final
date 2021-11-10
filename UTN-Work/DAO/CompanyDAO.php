<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\UserDAO as UserDAO;

class CompanyDAO implements ICompanyDAO
{

    private $connection;
    private $tableName = 'companies';
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO;
    }

    public function add(Company $company)
    {
        try {
            $query = "INSERT INTO " . $this->tableName . " (companyName, id_user, adress, cuit, city) VALUES(:companyName, :id_user, :adress, :cuit, :city);";

            $parameters = array();
            $parameters['companyName'] = $company->getCompanyName();
            $parameters['id_user'] = $company->getUserId();
            $parameters['adress'] = $company->getAddress();
            $parameters['cuit'] = $company->getCuit();
            $parameters['city'] = $company->getCity();


            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getCompanyById($idCompany)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_company = " . $idCompany . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);

            $company = new Company;
            $company->setIdCompany($resultSet[0]['id_company']);
            $company->setCompanyName($resultSet[0]['companyName']);
            $company->setTelephone($resultSet[0]['phoneNumber']);
            $company->setCity($resultSet[0]['city']);
            $company->setCuit($resultSet[0]['cuit']);
            $company->setAddress($resultSet[0]['adress']);
            $company->setUserId($resultSet[0]['id_user']);
            

            $userRow = $this->userDAO->getUserById($resultSet[0]['id_user']);

            $company->setEmail($userRow['email']);
            $company->setPassword($userRow['pass']);
            $company->setActive($userRow['active']);

            return $company;
        } catch (Exception $e) {
        }
    }

    public function remove($companyId)
    {
        try {
            $query = "UPDATE users set active = 0";
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . ";";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);

            $companies = array();

            foreach ($resultSet as $row) {
                $company = new Company;
                $company->setUserId($row['id_user']);
                $company->setIdCompany($row['id_company']);
                $company->setCompanyName($row['companyName']);
                $company->setAddress($row['adress']);
                $company->setCuit($row['cuit']);
                $company->setCity($row['city']);
                $company->setTelephone($row['phoneNumber']);

                $userRow = $this->userDAO->getUserById($row['id_user']);

                $company->setEmail($userRow['email']);
                $company->setPassword($userRow['pass']);
                $company->setActive($userRow['active']);

                array_push($companies, $company);
            }

            return $companies;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function saveData()
    {
        /*$array_to_encode = array();

        foreach ($this->companies as $company) {
            $companyData['companyName'] = $company->getCompanyName();
            $companyData['telephone'] = $company->getTelephone();
            $companyData['city'] = $company->getCity();
            $companyData['address'] = $company->getAddress();
            $companyData['cuit'] = $company->getCuit();
            $companyData['email'] = $company->getEmail();
            $companyData['active'] = $company->getActive();
            $companyData['userId'] = $company->getUserId();

            array_push($array_to_encode, $companyData);
        }

        $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $jsonEnconde);*/
    }

    private function getLastId()
    {
        /*$this->retrieveAll();
        $auxList = $this->companies;
        $lastItem = end($auxList);
        return $lastItem->getUserId();*/
    }

    private function retrieveAll()
    {
        /*$this->companies = array();

        if (file_exists($this->filename)) {
            $jsonDecode = file_get_contents($this->filename);

            $array_to_decode = $jsonDecode ? json_decode($jsonDecode, true) : array();

            foreach ($array_to_decode as $companyData) {
                $company = new Company;
                $company->setCompanyName($companyData['companyName']);
                $company->setTelephone($companyData['telephone']);
                $company->setAddress($companyData['address']);
                $company->setCity($companyData['city']);
                $company->setCuit($companyData['cuit']);
                $company->setEmail($companyData['email']);
                $company->setUserId($companyData['userId']);
                $company->setActive($companyData['active']);

                array_push($this->companies, $company);
            }
        }*/
    }

    /*public function getCompanyById($companyId)
    {
        $query = "SELECT * FROM ".$this->tableName." WHERE id_company= \"".$companyId."\";";
        $this->connection = Connection::GetInstance();

        $resultSet=$this->connection->execute($query);

        var_dump($resultSet) . "<br>";

        $company = new Company;

        
                $company->setUserId($resultSet[0]['id_user']);
                $company->setIdCompany($resultSet[0]['id_company']);
                $company->setCompanyName($resultSet[0]['companyName']);
                $company->setAddress($resultSet[0]['adress']);
                $company->setCuit($resultSet[0]['cuit']);
                $company->setCity($resultSet[0]['city']);
                $company->setTelephone($resultSet[0]['phoneNumber']);

                $userRow = $this->userDAO->getUserById($resultSet[0]['id_user']);
                
                $company->setEmail($userRow['email']);
                $company->setPassword($userRow['pass']);
                $company->setActive($userRow['active']);
    

        return $company;
    }*/

    public function overwriteCompany($company)
    {
        $query = "UPDATE " . $this->tableName . " SET companyName =\"" .$company->getCompanyName(). "\", adress =\"" . $company->getAddress()."\", cuit = \"". $company->getCuit()."\", phoneNumber = \"". $company->getTelephone()."\", city = \"".$company->getCity()."\" WHERE id_company = " . $company->getIdCompany() . ";" ;

        
        $this->connection = Connection::GetInstance();
        $this->connection->executeNonQuery($query);
    }
}

?>
