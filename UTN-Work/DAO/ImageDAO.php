<?php 
namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\File as Image;

class imageDAO{

    private $connection;
    private $tableName = 'images';

    public function add(Image $image){
        try{
            $query = "INSERT INTO ".$this->tableName."(id_offer, url) VALUES(:id_offer, :url);";

            $parameters = array();
            $parameters['id_offer'] = $image->getIdOwner();
            $parameters['url'] = $image->getUrl();

            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query, $parameters);

        } catch(Exception $e){
            throw $e;
        }
    }

    public function getURLByOwnerId($idOwner)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_owner = " . $idOwner . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = $resultSet[0]['url'];
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getURLByImageId($idImage)
    {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id_image = " . $idImage . ";";
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->execute($query);
            $url = $resultSet[0]['url'];
            return $url;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteURLByImageId($idImage)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE id_image = " . $idImage . ";";
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>