<?php 
namespace DAO;

use DAO\Connection as Connection;
use Models\User as User;
use \Exception as Exception;

class UserDAO{

    private $connection;
    private $tableName = 'users';
    private $defaultPass = "123456";

    public function __construct()
    {
        
    }

    public function getTableName(){ return $this->tableName; }
    public function setTableName($tableName): self { $this->tableName = $tableName; return $this; }

    public function add($email, $active, $userType, $pass) //email, pass, active
    {
        try{
            $query = "INSERT INTO ".$this->tableName."(email,pass,active,userType) VALUES(:email, :password, :active,:userType);";

            $this->connection = Connection::GetInstance();

            $parameters = array();
            $parameters['email'] = $email;
            $parameters['password'] = $pass;
            $parameters['active'] = $active;
            $parameters['userType'] = $userType;
        
        $this->connection->executeNonQuery($query, $parameters);

        } catch(Exception $e){
            throw $e;
        }

    }

    public function remove($userId){
        try{

            $query = "UPDATE users set active = 0 WHERE id_user=" . $userId;
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);

        } catch (Exception $e){
            throw $e;
        }
    }


    public function getUserIdByEmail($email){
        try{
            $query = "SELECT (id_user) FROM ".$this->tableName." WHERE email= \"".$email."\";";
            $this->connection = Connection::GetInstance();
    
            $resultSet=$this->connection->execute($query);
    
            return $resultSet[0]['id_user'];
        } catch (Exception $e){
            throw $e;
        }

    }

    public function getUserByEmail($email){
        try{
            $query = "SELECT * FROM ".$this->tableName." WHERE email= \"".$email."\";";
            $this->connection = Connection::GetInstance();

            $resultSet=$this->connection->execute($query);
        
            return $resultSet;
        }
        catch(Exception $e){
            throw $e;
        }  
    }

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