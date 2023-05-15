<?php 
// get page header
$pageTitle = 'Total URL Clicks';
include_once('header.php');
?>

<div class="container mt-5">
  <h1 class="text-light"><?= $pageTitle ?></h1>
  <p class="text-light subtitle">Track clicks for a specific URL.</p>
  <div class="card ele-container">

  <?php
    // check for errors
    if(isset($errors)){
      foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
      <?php }
    }
    ?>

    <!-- content -->
    <div class="card-body">
      <?= $urlStatsContent ?>      
    </div>

  </div>
</div>
<?php include_once('footer.php');?>