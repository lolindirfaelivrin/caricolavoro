<?php


class Database  
{
    private $db_pass;
    private $db_user;
    private $db_name;
    private $dbHandler;
    private $statement;    
    private $db_host;
    private $error;

    public function __construct($user,$name,$pass,$host) {
        $this->db_pass = $pass;
        $this->db_user = $user;
        $this->db_name = $name;
        $this->db_host = $host;

        $this->connetti();
    }

    public function connetti() {

        $conn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->db_user, $this->db_pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }        
    }

    public function query($sql) {
        $this->statement = $this->dbHandler->prepare($sql);
      }
    
      public function bind($param, $value, $type = null) {
        switch (is_null($type)) {
    
          case is_int($value):
              $type = PDO::PARAM_INT;
            break;
    
          case is_bool($value):
              $type = PDO::PARAM_BOOL;
            break;
    
          case is_null($value):
              $type = PDO::PARAM_NULL;
            break;
    
          default:
            // code...
            $type = PDO::PARAM_STR;
        }
    
        $this->statement->bindValue($param, $value, $type);
      }
    
      public function executeQuery() {
        return $this->statement->execute();
      }
    
      public function resultSet() {
        $this->executeQuery();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
      }
    
      public function singleRow() {
        $this->executeQuery();
        return $this->statement->fetch(PDO::FETCH_OBJ);
      }
    
      public function rowCount() {
        return $this->statement->rowCount();
      }
    
      public function mostraErrore() {
        return $this->statement->errorInfo();
      }
    
      public function lastId() {
        return $this->dbHandler->lastInsertId();
      }


}
