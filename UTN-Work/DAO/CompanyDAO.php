<?php

namespace DAO;

use Models\Company as Company;
use DAO\ICompanyDAO as ICompanyDAO;

class CompanyDAO implements ICompanyDAO
{

    private $companies = array();
    private $filename;

    public function __construct()
    {
        $this->filename = ROOT . "Data/companies.json";
    }

    public function add(Company $company)
    {
        $this->retrieveAll();
        $company->setUserId($this->getLastId() + 1);
        array_push($this->companies, $company);
        $this->saveData();
    }

    public function remove($companyId)
    {
        $newList = array();
        $this->retrieveAll();

        foreach ($this->companies as $company) {
            if ($company->getUserId() != $companyId)
                array_push($newList, $company);
        }

        $this->companies = $newList;
        $this->saveData();
    }

    public function getAll()
    {
        $this->retrieveAll();
        return $this->companies;
    }

    private function saveData()
    {
        $array_to_encode = array();

        foreach ($this->companies as $compnay) {
            $companyData['companyName'] = $compnay->getCompanyName();
            $companyData['telephone'] = $compnay->getTelephone();
            $companyData['city'] = $compnay->getCity();
            $companyData['direction'] = $compnay->getDirection();
            $companyData['cuit'] = $compnay->getCuit();
            $companyData['email'] = $compnay->getEmail();
            $companyData['active'] = $compnay->getActive();
            $companyData['userId'] = $compnay->getUserId();



            array_push($array_to_encode, $companyData);

            $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonEnconde);
        }
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
                $company->setDirection($companyData['direction']);
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

    public function overrideCompany($company)
    {
        $this->retrieveAll();
        $i = 0;
        foreach ($this->companies as $obj) {
            if ($obj->getUserId() == $company->getUserId()) {
                $this->companies[$i] = $company;
                var_dump($this->companies[$i]);
                echo "<br>";
                var_dump($company);
            }
            $i++;
        }
        $this->saveData();
    }
}
