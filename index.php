<?php

$view = 'views/home.php';

// check if user is trying to short the url. If not show the default view with the form
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['long-url']) {
  require_once('classes/Shortner.php');
  
  // shortens the url
  $shortner = new Shortner($_POST['long-url']);

  // if there's no errors shows the short url
  if (empty($shortner->errors)) {
    $view = 'views/shortner.php';
  }
}

require_once($view);