<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use \Exception as Exception;
use DAO\Connection as Connection;

class CompanyDAO implements ICompanyDAO
{

    private $connection;
    private $tableName = 'companies';

    public function __construct()
    {
        
    }

    public function add(Company $company)
    {
        try{
            $query = "INSERT INTO ".$this->tableName." (companyName, id_user, adress, cuit, active, city, email, adress) VALUES(:companyName, :id_user, :adress, :cuit, :active, :city, :email, :adress);";

            $parameters = array();
            $parameters['companyName'] = $company->getCompanyName();
            $parameters['id_user'] = $company->getUserId();
            $parameters['adress'] = $company->getAddress();
            $parameters['cuit'] = $company->getCuit();
            $parameters['active'] = $company->getActive();
            $parameters['city'] = $company->getCity();
            $parameters['email'] = $company->getEmail();
            $parameters['adress'] = $company->getAddress();

            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function findCompanyByIdDB($idCompany){
        try {
            $query="SELECT * FROM ".$this->tableName." WHERE id_company = \"".$idCompany."\";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->executeNonQuery($query);
            
            $Company = new Company;
            $Company->setIdCompany($resultSet[0]['id_company']);
            $Company->setCompanyName($resultSet[0]['companyName']);
            $Company->setTelephone($resultSet[0]['phoneNumber']);
            $Company->setCity($resultSet[0]['city']);
            $Company->setCuit($resultSet[0]['cuit']);
            $Company->setEmail($resultSet[0]['email']);
            $Company->setAddress($resultSet[0]['adress']);
            $Company->setActive($resultSet[0]['active']);
    
            return $Company;
        } catch (Exception $e){

        }
    }

    public function remove($companyId)
    {
        try{
            $query = "UPDATE users set active = 0";
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function getAll()
    {
        try{
            $query = "SELECT * FROM ".$this->tableName.";";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);

            $companies = array();

            foreach($resultSet as $row)
            {
                $company = new Company;
                $company->setUserId($row['id_user']);
                $company->setEmail($row['email']);
                $company->setPassword($row['pass']);
                $company->setCompanyName($row['companyName']);
                $company->setAddress($row['direccion']);
                $company->setCuit($row['cuit']);
                $company->setactive($row['active']);

                array_push($companies, $company);
            }

            return $companies;
        }
        catch(Exception $e){
            throw $e;
        }
    }

    private function saveData()
    {
        $array_to_encode = array();

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
        file_put_contents($this->filename, $jsonEnconde);
    }

    private function getLastId()
    {
        $this->retrieveAll();
        $auxList = $this->companies;
        $lastItem = end($auxList);
        return $lastItem->getUserId();
    }

    private function retrieveAll()
    {
        $this->companies = array();

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
        }
    }

    public function getCompanyById($companyId)
    {
        $this->retrieveAll();
        $company = null;
        foreach ($this->companies as $obj) {
            if ($obj->getUserId() == $companyId)
                $company = $obj;
        }

        return $company;
    }

    public function overwriteCompany($company)
    {
        $this->retrieveAll();
        $i = 0;

        foreach ($this->companies as $obj) {
            if ($obj->getUserId() == $company->getUserId()) {
                $this->companies[$i] = $company;
            }
            $i++;
        }
        $this->saveData();
    }
}
