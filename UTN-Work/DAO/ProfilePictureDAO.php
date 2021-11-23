<?php 
namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\File as File;
use Models\Alert as Alert;

class ProfilePictureDAO{

    private $connection;
    private  $tableName =  "profile_pictures";

    public function add(File $file){
        try{
            $query = "INSERT INTO ". $this->tableName . " (id_file, url) VALUES(:id_file, :url);";

            $parameters = array();
            $parameters['id_file'] = $file->getIdOwner();
            $parameters['url'] = $file->getUrl();

            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);

        } catch(Exception $e){
            throw $e;
        }
    }

    public function getURLByOwnerId($idOwner)
    {
        try {
            $query = "SELECT * FROM " .  $this->tableName .  " WHERE id_owner = " . $idOwner . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = "";
            if(!empty($resultSet)){
                $url = $resultSet[0]['url'];
            }
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getFileIdByOwnerId($idOwner)
    {
        try {
            $query = "SELECT (id_file) FROM " .  $this->tableName .  " WHERE id_file = " . $idOwner . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = "";
            if(!empty($resultSet)){
                $url = $resultSet[0]['id_file'];
            }
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getURLByFileId($idFile)
    {
        try {
            $query = "SELECT * FROM " .  $this->tableName .  " WHERE id_file = " . $idFile . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = "";
            if(!empty($resultSet)){
                $url = $resultSet[0]['url'];
            }
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }
    

    public function deleteURLByFileId($idFile)
    {
        try {
            $query = "DELETE FROM " .  $this->tableName .  " WHERE id_file = " . $idFile . ";";
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function uploadFile($target_file){

        $alert  = new Alert;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $alert->setMessage("Archivo subido con exito");
            $alert->setType("success");
          } else {
            $alert->setMessage("Error al subir el archivo");
            $alert->setType("danger");
          }
        return $alert;
    }

}

?>