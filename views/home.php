<?php
// get page header 
$pageTitle = "URL Shortener";
include_once('header.php');

?>
<div class="container mt-5">
  <h1 class="text-light"><?= $pageTitle ?></h1>

  <p class="text-light subtitle">Shorten long URLs for easier sharing and tracking clicks.</p>
  <div class="card ele-container">

    <?php
    // check for errors
    if(isset($shortner)){
      foreach ($shortner->errors as $error) { ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
      <?php }
    }
    ?>

    <div class="card-body">
      <h2 class="card-title">Long URL</h2>
      <!-- <form action="shorten.php" method="POST"> -->
      <form method="POST">
        <div class="form-group">
          <input required type="text" class="form-control" id="long-url" name="long-url" placeholder="https://www.barnesandnoble.com/w/braiding-sweetgrass-robin-wall-kimmerer/1114828102;jsessionid=41D7670E52EFB7A6935CE8F8F435D448.prodny_store01-atgap06?ean=9781571313560&st=AFF&2sid=The%20New%20York%20Times_7990613_NA&sourceId=AFFThe%20New%20York%20Times">
        </div>
        <button type="submit" class="btn main-btn">Shorten</button>
      </form>
    </div>
  </div>
</div>
<?php include_once('footer.php');?>