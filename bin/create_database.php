<?php
include_once(__DIR__ . '/../config/config.php');

$options = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

// Connects to mysql
try {
  $pdo = new PDO("mysql:host=" . APP_DB_HOST, APP_DB_USER, APP_DB_PASS, $options);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

// Creates database
$pdo->exec("CREATE DATABASE IF NOT EXISTS " . APP_DB_NAME);

// Creates url table
$pdo->exec("CREATE TABLE ".APP_DB_NAME.".url (
  id INT PRIMARY KEY AUTO_INCREMENT , 
  url VARCHAR(2083) NOT NULL,
  shortUrl VARCHAR(2083) UNIQUE NOT NULL,
  clicks INT DEFAULT 0,
  lastClick TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );");
