<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\UserDAO as UserDAO;
use \PDOException as PDOException;

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
            $query = "INSERT INTO " . $this->tableName . " (companyName, id_user, adress, cuit, city, phoneNumber) VALUES(:companyName, :id_user, :adress, :cuit, :city, :phoneNumber);";

            $parameters = array();
            $parameters['companyName'] = $company->getCompanyName();
            $parameters['id_user'] = $company->getUserId();
            $parameters['adress'] = $company->getAddress();
            $parameters['cuit'] = $company->getCuit();
            $parameters['city'] = $company->getCity();
            $parameters['phoneNumber'] = $company->getTelephone();


            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
        catch (PDOException $pdo){
            throw $pdo;
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
            throw $e;
        }
        catch (PDOException $pdo){
            throw $pdo;
        }
    }

    public function getCompanyByIdUser($idCompany)
    {
        try {

            $query = "SELECT * FROM " . $this->tableName . " WHERE id_user = " . $idCompany . ";";
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
            throw $e;
        }
        catch (PDOException $pdo){
            throw $pdo;
        }
    }

    public function remove($companyId)
    {
        try {
            $query = "UPDATE users set active = 0 WHERE id_user = " . $companyId . ";";
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);
        } catch (Exception $e) {
            throw $e;
        } catch (PDOException $pdo){
            throw $pdo;
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
        } catch (PDOException $pdo){
            throw $pdo;
        }
    }

    public function overwriteCompany($company)
    {
        try{
            $query = "UPDATE " . $this->tableName . " SET companyName =\"" .$company->getCompanyName(). "\", adress =\"" . $company->getAddress()."\", cuit = \"". $company->getCuit()."\", phoneNumber = \"". $company->getTelephone()."\", city = \"".$company->getCity()."\" WHERE id_company = " . $company->getIdCompany() . ";" ;

            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);
        } catch (Exception $e){
            throw $e;
        }
    }
}

?>
