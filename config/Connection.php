<?php
include_once('config.php');

// handles connection to the database
class Connection{  
  private PDO $conn;

  function __construct(){
    // set error mode
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    // create a PDO instance
    try {
      $this->conn = new PDO("mysql:host=".APP_DB_HOST.";dbname=".APP_DB_NAME, APP_DB_USER, APP_DB_PASS, $options);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
   
  }

  // return connection
  public function getConn(){
    return $this->conn;
  }
}