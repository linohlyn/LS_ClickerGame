<?php require_once 'include/header.php'; ?>
<?php if ($model->isLoggedIn()): ?>
<?php require_once 'include/navbar.php'; ?>
<div class="section red lighten-5 col s6" id="accountimg">
  <h4 class='center-align red-text accent-4'>Change Account Image</h4>
  <form class="col s6" method="post" enctype="multipart/form-data">
    <div class="row center">
      <div class="file-field input-field col s6 offset-s3">
        <div class='btn red accent-2'>
          <span>File</span>
          <input name="userimg" type="file">
        </div>
        <div class='file-path-wrapper'>
          <input class='file-path validate' type='text'>
        </div>
      </div>
    </div>
    <div class="row center">
        <button type="submit" class="btn waves-effect waves-light red accent-2" name="uploadimg">Upload Image</button>
    </div>
  </form>
<?php else: ?>
<div class="valign-wrapper my-wrapper row">
  <div class="col s12 center-align">
    <h2>Welcome to Macaron Clicker!</h2><br>
    <a href="register.php" class="waves-effect waves-light btn valign">Register</a>
    <a href="login.php" class="waves-effect waves-light btn valign">Login</a>
  </div>
</div>
<?php endif; ?>
<?php require_once 'include/footer.php'; ?>
