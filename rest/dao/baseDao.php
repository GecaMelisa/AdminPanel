<?php 

require_once __DIR__ . '/../Config.class.php';

//cannot be execute

class BaseDao{

    private $table_name;
    private $conn; //private atribute so that we can use it in other functions

    //constructor of this class
    public function __construct($table_name){

        //connecting to the database 
        $this->table_name = $table_name;
        $servername = Config::DB_HOST();
        $username = Config::DB_USERNAME();
        $password = Config::DB_PASSWORD();
        $schema = Config::DB_SCHEME();
        $port = Config::DB_PORT();
        
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema;port=$port", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
    }

    protected function getConnection() {
        if (!$this->conn) {
          $this->conn = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
      }

    //method used to read all objects from database
    public function get_all(){
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name);
        $stmt->execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC); //FETCH ASSOC means that output will be associative array -> it is more readable   
    }

    public function get_by_id($id){
        $stmt = $this->conn->prepare("SELECT * FROM ". $this->table_name ." WHERE id = :id");
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
      }


      protected function query($query, $params = []){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      protected function query_unique($query, $params = []){
        $result = $this->query($query, $params);
        return reset($result);
      }

      
}


?>