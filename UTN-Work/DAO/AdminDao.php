<?php
namespace DAO;

use DAO\IAdminDAO as IAdminDAO;
use Models\Admin as Admin;

class AdminDAO implements IAdminDAO{

    private $admins = array();
    private $filename;

    public function __construct()
    {
        $this->filename = ROOT . "Data/admins.json";
    }

    public function add(Admin $admin){
        $this->retrieveData();
        array_push($this->admins, $admin);
        $this->saveData();
    }

    public function remove($userId){}

    public function getAll(){
        $this->retrieveData();
        return $this->admins;
    }

    private function saveData(){
        $array_to_encode = array();

        foreach($this->admins as $admin)
        {
            $adminData['userId'] = $admin->getStudentId();
            $adminData['name'] = $admin->getFirstName();
            $adminData['lastName'] = $admin->getLastName();
            $adminData['email'] = $admin->getEmail();
            $adminData['active'] = $admin->getActive();

            array_push($array_to_encode, $adminData);

            $jsonEnconde = json_encode($array_to_encode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonEnconde);
        }
    }

    private function retrieveData(){
        $this->admins = array();

        if(file_exists($this->filename))
        {
            $jsonContent = file_get_contents($this->filename);

            $array_to_decode = ($jsonContent)? json_decode($jsonContent, true) : array(); 

            foreach($array_to_decode as $adminData)
            {
                $admin = new Admin;
                $admin->setUserId($adminData['userId']);
                $admin->setFirstName($adminData['name']);
                $admin->setLastName($adminData['lastName']);
                $admin->setEmail($adminData['email']);
                $admin->setActive($adminData['active']);

                array_push($this->admins, $admin);
            }
        }
    }


    public function getAdminByEmail($email)
    {
        $this->retrieveData();

        $admin = null;

        //$admin = array_filter($this->admins, function ($var) {return $var->getEmail() == $email;} );

        foreach($this->admins as $obj)
        {
            if($obj->getEmail() == $email)
                $admin = $obj;
        }
        
        return $admin;
    }

    public function connectToApi()
    {
       

    }

    public function downloadDataToJson($apiResponse){
        
        //decodifico el json en un array
        $arrayStudents = json_decode($apiResponse, true);

        foreach($arrayStudents as $adminData)
        {
            $admin = new Admin;
            $admin->setUserId($adminData['userId']);
            $admin->setFirstName($adminData['name']);
            $admin->setLastName($adminData['lastName']);
            $admin->setEmail($adminData['email']);
            $admin->setActive($adminData['active']);
                
            array_push($this->admins, $admin);
        }

        $this->saveData();
    } 

}

?>