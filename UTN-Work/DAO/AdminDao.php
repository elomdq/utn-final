<?php
namespace DAO;

use DAO\Connection as Connection;
use \Exception as Exception;

class AdminDAO{

    private $connection;
    private $tableName = 'admins';

    public function getTableName(){ return $this->tableName; }
    public function setTableName($tableName): self { $this->tableName = $tableName; return $this; }

    public function getUserById($userId){
        try{
            $query = "SELECT * FROM ".$this->tableName." WHERE id_user= \"".$userId."\";";
            $this->connection = Connection::GetInstance();
    
            $resultSet=$this->connection->execute($query);
            return $resultSet[0];

        } catch(Exception $e){
            throw $e;
        }
    }


}

?>