<?php 
namespace DAO;

use Models\User as User;
use \Exception as Exception;

class UserDAO{

    private $connection;
    private $tableName = 'users';

    public function __construct()
    {
        
    }

    public function getTableName(){ return $this->tableName; }
    public function setTableName($tableName): self { $this->tableName = $tableName; return $this; }

    public function add($parameters) //email, pass, active
    {
        try{
        $query = "INSERT INTO ".$this->tableName."(email,pass,active) VALUES(:email, :password, :active);";

        $this->connection = Connection::GetInstance();
        
        $this->connection->executeNonQuery($query, $parameters);

        } catch(Exception $e){
            throw $e;
        }

    }

    public function getUserIdByEmail($email){
        $query = "SELECT ".$this->tableName." (id_user) WHERE email=".$email.";";
        $this->connection = Connection::GetInstance();

        $resultSet=$this->connection->execute($query);

        return $resultSet['id_user'];
    }

}
?>