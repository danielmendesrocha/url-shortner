<?php
require_once('classes/URLStats.php');

$urlStatsContent = file_get_contents("views/urlStatsContent/inputForm.php"); 

// Check if the URL query parameter is set
if (isset($_GET['q'])) {

  $UrlStats = new URLStats;
  
  // check if there's errors
  $errors = $UrlStats->errors;
  if(empty($errors)){
    
    $url = $UrlStats->url;
    $totalClicks = $UrlStats->getTotalClicks();
    
    // Since totalClicks.php needs to output some php variables we need to use output buffering functions.
    ob_start();
    include_once('views/urlStatsContent/totalClicks.php');
    // use ub_get_clean to get the content as string and delete the output buffering
    $urlStatsContent = ob_get_clean();
  
  }
  
}

require_once('views/urlStats.php');