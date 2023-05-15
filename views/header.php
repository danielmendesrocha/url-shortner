<!DOCTYPE html>
<html>
  <head>
    <title><?= $pageTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <a class="navbar-brand" href="/">Shortener App</a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav"> -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= $_SERVER['REQUEST_URI'] === "/" ? 'active': '' ?>">
              <a class="nav-link" href="/">Short URL</a>
            </li>
            <li class="nav-item <?= substr( $_SERVER['REQUEST_URI'], 0, 10 ) === "/urlStats" ? 'active': '' ?>">
              <a class="nav-link" href="/urlStats.php">URL Clicks</a>
            </li>
          </ul>
        <!-- </div> -->
      </nav>
  </header>