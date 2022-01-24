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
            $query = "INSERT INTO ". $this->tableName . " (id_user, url) VALUES(:id_user, :url);";

            $parameters = array();
            $parameters['id_user'] = $file->getIdOwner();
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
            $query = "SELECT * FROM " .  $this->tableName .  " WHERE id_user = " . $idOwner . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = null;
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
            $query = "SELECT (id_profile) FROM " .  $this->tableName .  " WHERE id_user = " . $idOwner . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = "";
            if(!empty($resultSet)){
                $url = $resultSet[0]['id_profile'];
            }
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getURLByFileId($idFile)
    {
        try {
            $query = "SELECT * FROM " .  $this->tableName .  " WHERE id_profile = " . $idFile . ";";
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
            $query = "DELETE FROM " .  $this->tableName .  " WHERE id_profile = " . $idFile . ";";
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