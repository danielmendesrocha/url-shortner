<?php

class URLStats{

  public array $errors = [];
  private int $totalCLicks = 0;
  public string $url = '';

  function __construct(){
    $this->getStats();
  }

  /**
   * Get total clicks from short url
   */
  private function getStats(){

    // initiate database connections
    require_once('config/Connection.php');
    $conn = new Connection();
    $pdo = $conn->getConn();

    // remove all illegal characters from a url, and validates
    $urlSanitized = filter_var(strip_tags(trim($_GET['q'])), FILTER_SANITIZE_URL); 
    $this->url = filter_var($urlSanitized, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED );

    // get servers domain
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";  
    $serverURI = $protocol . $_SERVER['SERVER_NAME'];

    // check if url its in the servers domain
    if( $this->url && strpos($this->url, $serverURI) === 0){

      // Query the database to get the total clicks for this URL
      try {
      $stmt = $pdo->prepare("SELECT clicks FROM url WHERE shortUrl = ?");
      $stmt->bindParam(1, $this->url);
      $stmt->execute();
      } catch (PDOException $e) {
        error_log($e->getMessage());
        $this->errors[] = "Sorry, an error occurred, please try again later.";
      }

      // get results
      if(empty($this->errors)){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
          $this->totalCLicks = (int)$result['clicks'];
        } else {
          $this->totalCLicks = 0;
        }
      }

    } else {
      $this->errors[] = "That's not a valid URL";
    }
  }

  // return total clicks
  public function getTotalClicks(){
    return $this->totalCLicks;
  }

}