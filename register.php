<?php require_once 'include/header.php' ?>
<main>
    <div class="container">
      <div class="row center">
        <a href="index.php"><img src="assets/macaron.png" class="img"></a>
        <h2 class="header">Macaron Clicker</h2>
      </div>
    </div>
    <div class="container blue lighten-5 z-depth-3 col s6" id="loginform">
      <div class="section col s6">
      <form class="col s6" method="post">
        <div class="row center">
          <div class="input-field col s6 offset-s3">
            <i class="prefix material-icons">group</i>
            <input type="text" id="login" class="validate" name="username">
            <label for="login">Username</label>
          </div>
        </div>
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
            <button type="submit" class="btn waves-effect waves-light">Create Account</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php require_once 'include/footer.php' ?>
