<?php require_once 'include/header.php'; ?>
<?php if ($model->isLoggedIn()): ?>
<?php require_once 'include/navbar.php'; ?>
<table>
  <thead>
    <tr>
      <th>Username</th>
      <th>Highscore</th>
    </tr>
  </thead>
  <tbody>
<?php
class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}
try {
  $userID = $_SESSION['userID'];
  $sql = "SELECT user.username, userHighscore.Highscore FROM user INNER JOIN userHighscore ON user.ID = userHighscore.UserID ORDER BY userHighscore.Highscore DESC";
  $results = $model->pdo->query($sql);
  $results->setFetchMode(PDO::FETCH_ASSOC);

  foreach (new TableRows(new RecursiveArrayIterator($results->fetchAll())) as $k => $v) {
    echo $v;
  }
  } catch (\PdoException $e) {
    echo "Connection failed" . $e->getMessage();
  }
?>

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
