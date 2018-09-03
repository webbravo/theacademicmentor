<?php 
  require_once 'config.php';
  require_once 'DatabaseInterface.php';

  global $dsn;

  class Database implements DatabaseInterface
  {   

        public $db;
        public $error_msg;

        public function __construct(string $dsn)
        {
          try{
            $this->db = new PDO($dsn, 'root', '');
          }catch(Expection $e){
            $error = $e->getMessage();
          }
            echo isset($error) ? $error : '';
        }

        public function exe_query(String $sql)
        {
          try{
              $stmt =  $this->db->prepare($sql);
              if( $stmt->execute() === true) { return true;} else{return false;}
          }catch(Expection $e){
              return $this->error_msg  =  $e->getMessage();
          }
        }

  }
  // Create an instance of the database class
  $database  = new Database($dsn);
?>