<?php 
namespace DAO;

use DAO\Connection as DAOConnection;
use \PDO as PDO;
use \Exception as Exception;
use DAO\QueryType as QueryType;

class Connection{

    private $pdo = null; //php data object
    private $pdoStatement = null; //statement
    private static $instance = null; //instancia de conexion unica

    public function __construct()
    {
        try{
            $this->pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function getPdo(){ return $this->pdo; }
    public function setPdo($pdo): self { $this->pdo = $pdo; return $this; }

    public function getPdoStatement(){ return $this->pdoStatement; }
    public function setPdoStatement($pdoStatement): self { $this->pdoStatement = $pdoStatement; return $this; }

    public function getInstance(){
        if(self::$instance == null)
            self::$instance = new Connection;

        return self::$instance; 
    }


    //funcion para ejecutar un statement con distintas queries (que necesitan distintos parametros)
    public function execute($query, $parameters = array(), $queryType = QueryType::Query)
    {
        try {
            $this->Prepare($query); //prepara la query del statement

            $this->BindParameters($parameters, $queryType); //relaciona los valores con las variables de la query
 
            $this->pdoStatement->execute(); //ejecuta la query del statement

            return $this->pdoStatement->fetchAll(); //devuelve el resultado en forma de array clave->valor

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function executeNonQuery($query, $parameters, $queryType = QueryType::Query)
    {
        try{
            $this->prepare($query);
            $this->bindParameters($parameters, $queryType);
            $this->pdoStatement->execute();

            return $this->pdoStatement->rowCount();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }


    private function prepare($query)
    {
        try {
            $this->pdoStatement = $this->pdo->prepare($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    private function bindParameters($parameters = array(), $queryType = QueryType::Query)
    {
        $i = 0;

        foreach ($parameters as $parameterName => $value) {
            $i++;

            if ($queryType == QueryType::Query)
                $this->pdoStatement->bindParam(":" . $parameterName, $parameters[$parameterName]); //si pongo directo el $value no lo toma
            else
                $this->pdoStatement->bindParam($i, $parameters[$parameterName]);
        }
    }
}

?>