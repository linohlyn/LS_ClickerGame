<ul id="dropdown" class="dropdown-content">
  <li><a href="accountoptions.php">Account Options</a></li>
  <li><a href="accountuploadimg.php">Upload Profile Image</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<nav>
  <div class="nav-wrapper purple lighten-4">
    <a href="index.php" class="black-text brand-logo"><img src="assets/macaron.png" width="50" height="auto">Macaron Clicker</a>
    <ul id="nav-mobile" class="right">
      <li><a href="index.php" class="black-text">Home</a></li>
      <li><a href="highscores.php" class="black-text">Highscores</a></li>
      <li><a class="black-text dropdown-trigger" href="#!" data-target="dropdown">
        <?php if ($model->hasImageID()): ?>
          <img src="getimage.php?id=<?=$model->getImageID()?>" width="50">
        <?php endif; ?>
        <?=$model->getUsername()?>
      </a></li>
    </ul>
  </div>
</nav>

<script>
  $(document).ready(function(){
    $(".dropdown-trigger").dropdown();
  });

</script>
