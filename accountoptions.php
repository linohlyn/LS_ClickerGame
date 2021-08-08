<?php require_once 'include/header.php'; ?>
<?php if ($model->isLoggedIn()): ?>
<?php require_once 'include/navbar.php'; ?>

<div class="section blue lighten-5 col s6" id="loginform">
  <h4 class='center-align teal-text darken-3'>Change your password</h4>
  <form class="col s6" method="post">
    <div class="row center">
      <div class="input-field col s6 offset-s3">
        <i class="prefix material-icons">enhanced_encryption</i>
        <input type="password" id="password" class="validate" name="password">
        <label for="password">Password</label>
      </div>
    </div>
    <div class="row center">
      <div class="input-field col s6 offset-s3">
        <i class="prefix material-icons">enhanced_encryption</i>
        <input type="password" id="confirm" class="validate" name="confirm">
        <label for="confirm">Confirm Password</label>
      </div>
    </div>
    <div class="row center red-text">
      <?php if (count($model->errors) > 0): ?>
      <ul class="errors">
        <?php foreach ($model->errors as $error): ?>
          <li><?=$error?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
    <div class="row center">
        <button type="submit" class="btn waves-effect waves-light" name="changepassword" id="changepassword">Change Password</button>
    </div>
  </form>
</div>
<div class='divider deep-purple accent-1'></div>
<div class="section red lighten-5 col s6" id="deleteaccount">
  <form class="col s6" method="post">
    <div class="row center">
        <button onclick="confirmation()" class="btn waves-effect waves-light red accent-2" name="deleteacc" id="deleteAcc">Delete Account?</button>
    </div>
  </form>
</div>
<script>
function confirmation() {
  if (confirm('Do you wish to delete your account?')) {
    document.getElementByID('deleteAcc').submit();
  }
}
</script>
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
