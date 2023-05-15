<?php

/**
 * Page requested by .htaccess to translate short urls into their previous value
 */

require_once('config/Connection.php');

$conn = new Connection();
$pdo = $conn->getConn();

// http or https
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
// full url
$shortUrl = $protocol . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

// get url from db
$stmt = $pdo->prepare("SELECT id, url FROM url WHERE shortURL = ?");
try {
  $stmt->bindParam(1, $shortUrl);
  $stmt->execute();
} catch (\PDOException $e) {
  error_log($e->getMessage());
  header("HTTP/1.1 404 Not Found");
  die("Sorry, an error occurred, pelase try again later.");  
}

// fetch the results
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$result){
  header("HTTP/1.1 404 Not Found");
  die("Sorry, the requested page was not found.");  
}

$url = $result['url'];
$id = $result['id'];

// update clicks in db
$stmt = $pdo->prepare("UPDATE url set clicks = clicks+1 WHERE id = ?");
try {
  $stmt->bindParam(1, $id);
  $stmt->execute();
} catch (\PDOException $e) {
  error_log($e->getMessage());
  header("HTTP/1.1 404 Not Found");
  die("Sorry, an error occurred, please try again later.");  
}

header("Location: " . $url );