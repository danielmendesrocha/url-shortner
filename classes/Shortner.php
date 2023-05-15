<?php

class Shortner{

  private const NUMBER_OF_TRIES = 10;
  private string $url;
  private PDO $pdo;
  public string $shortUrl;
  public array $errors = [];

  public function __construct($url){

    require_once('config/Connection.php');
    $conn = new Connection();
    $this->pdo = $conn->getConn();
    
    // process users input
    $this->url = $this->validateUserInput($url);
    
    // shortens the url
    if($this->url){
      
      try {

        $this->shortner();

      } catch (PDOException $e) {

        error_log($e->getMessage());

        // die($e->getMessage());
        $this->errors[] = 'An error has occurred, please try again later';
      } catch (Exception $e) {

        // die($e->getMessage());
        $this->errors[] = 'The system could not generate a unique url. Please try again later';
      }
    } else {
      $this->errors[] = "Invalid URL";
    }

    
  }

  /**
   * Shortens the url
   */
  private function shortner(){
    // get protol
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

    // Tries to generate a new URL for a maximum of 10 times. Sace to database
    $countTries = 0;
    do {

      $countTries++;

      try {
        // Generates random string
        $result = bin2hex(random_bytes(4));
        // get full url
        $this->shortUrl = $protocol . $_SERVER['SERVER_NAME'] . "/" . $result;
        
        // bind the values and execute the statement
        $stmt = $this->pdo->prepare("INSERT INTO url (url, shortUrl) VALUES (:url, :shortUrl)");
        $stmt->execute([
          "url" => $this->url, 
          "shortUrl" => $this->shortUrl
        ]);

        break;

      } catch (\PDOException $e) {

        // if it's a different error then re-throw
        if ($e->getCode() !== '23000') throw $e;
    
        // maximum number of tries;
        if($countTries >= 10) throw new Exception('Failed to insert record after 10 tries');
               
      }
    
    } while (true);

  }

  /**
   * Sanitizes user input / adds
   */
  private function validateUserInput($url){

    // remove all illegal characters from a url, and validates
    $url = filter_var(strip_tags(trim($url)), FILTER_SANITIZE_URL); 

    // adds https
    if(!filter_var($url, FILTER_VALIDATE_URL)){

      $urlComponents = parse_url($url);

      // adds https if no scheme is found
      if(!isset($urlComponents["scheme"])){

        // Remove any unwanted characters before the first letter
        $url = preg_replace('/^[^a-zA-Z0-9]+/','', $url);

        $url = 'https://' . $url;
      }

      // re-validate
      $url = filter_var($url, FILTER_VALIDATE_URL); 
    
    }

    return $url;
  }
  

} 
