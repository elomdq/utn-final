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

    public static function getInstance(){
        if(self::$instance == null)
            self::$instance = new Connection;

        return self::$instance; 
    }


    //funcion para ejecutar un statement con consulta de datos
    public function execute($query, $parameters = array(), $queryType = QueryType::Query)
    {
        try {
            $this->prepare($query); //prepara la query del statement

            $this->bindParameters($parameters, $queryType); //relaciona los valores con las variables de la query
 
            $this->pdoStatement->execute(); //ejecuta la query del statement

            return $this->pdoStatement->fetchAll(); //devuelve el resultado en forma de array clave->valor

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //funcion para ejecutar un statement con modificacion/agregado/eliminacion de datos
    public function executeNonQuery($query, $parameters, $queryType = QueryType::Query)
    {
        try{
            $this->prepare($query);
            $this->bindParameters($parameters, $queryType);

            echo "Statement preparada <br><br>";

            $this->pdoStatement->execute();

            echo "Statement ejecutada <br><br>";

            return $this->pdoStatement->rowCount();
        }
        catch(Exception $ex){
            throw $ex;
        }
    }

    //funcion prepara la query en el statement
    private function prepare($query)
    {
        try {
            $this->pdoStatement = $this->pdo->prepare($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //funcion para enlazar variables con valores
    private function bindParameters($parameters = array(), $queryType = QueryType::Query)
    {
        $i = 0;

        foreach ($parameters as $parameterName => $value) {
            $i++;

            if ($queryType == QueryType::Query)
            {
                echo ":" . $parameterName.", ". $parameters[$parameterName] . "<br>";
                $this->pdoStatement->bindParam(":" . $parameterName, $parameters[$parameterName]); //si pongo directo el $value no lo toma
            }
            else
                $this->pdoStatement->bindParam($i, $parameters[$parameterName]);
        }
    }
}

?>