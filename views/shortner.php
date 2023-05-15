<?php 
$pageTitle = "Shortened URL";
include_once('header.php'); 
?>

<div class="container mt-5">
<h1 class="text-light"><?= $pageTitle ?></h1>
  <div class="card ele-container">
    <div class="card-body">
      <h2 class="card-title">Here's your shortened URL</h2>
      <div class="input-group mb-3">
        <input required type="text" class="form-control" id="short-url" value="<?= $shortner->shortUrl; ?>" readonly>
        <div class="input-group-append">
          <button class="btn main-btn" type="button" id="copy-btn" onclick="copyToClipboard()">Copy</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function copyToClipboard() {
    var copyText = document.getElementById("short-url");
    copyText.select();
    document.execCommand("copy");
  }
</script>
<?php include_once('footer.php');