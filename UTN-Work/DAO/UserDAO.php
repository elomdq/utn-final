<?php 
namespace DAO;

use DAO\Connection as Connection;
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

    public function add($email, $active, $userType, $pass="123456") //email, pass, active
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
            echo "El problema: ".$e->getMessage();
        }

    }

    public function remove($userId){
        try{

            $query = "UPDATE users set active = 0";
            $this->connection = Connection::GetInstance();
            $this->connection->executeNonQuery($query);

        } catch (Exception $e){
            echo "El problema: ".$e->getMessage();
        }
    }


    public function getUserIdByEmail($email){
        try{
            $query = "SELECT (id_user) FROM ".$this->tableName." WHERE email= \"".$email."\";";
            $this->connection = Connection::GetInstance();
    
            $resultSet=$this->connection->execute($query); //me devuelve array con rows
    
            return $resultSet[0]['id_user']; //como email es constraint unique devuelvo la posicion 0 ya que solo hay una fila
        } catch (Exception $e){
            echo "El problema: ".$e->getMessage();
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
            echo "El problema: ".$e->getMessage();
        }  
    }

    public function getUserById($userId){
        try{
            $query = "SELECT * FROM ".$this->tableName." WHERE id_user= \"".$userId."\";";
            $this->connection = Connection::GetInstance();
    
            $resultSet=$this->connection->execute($query);
            return $resultSet[0];

        } catch(Exception $e){
            echo "El problema: ".$e->getMessage();
        }
    }

}
?>