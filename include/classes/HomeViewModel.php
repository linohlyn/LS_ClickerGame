<?php
namespace ClickerApp;

class HomeViewModel extends BaseViewModel {

  public function __construct() {
    parent::__construct();
    $this->handleScore();
  }

  private function handleScore() {
    if (isset($_SESSION['userID'])) {
      //Check is user is in Highscore database and create an entry if not
      $userID = $_SESSION['userID'];
      $highscoreResult = $this->pdo->query("SELECT * FROM userHighscore WHERE UserID = '$userID'");
      if (1 !== $highscoreResult->rowCount()) {
        $sql = "INSERT INTO userHighscore(UserID, Highscore) VALUES ('$userID', 0)";
        $this->pdo->query($sql); }
      //Check if the user is in Upgrades database and create an entry if not
      $upgradesResult = $this->pdo->query("SELECT * FROM userUpgrade WHERE UserID = '$userID'");
      if (1 !== $upgradesResult->rowCount()) {
        $sql = "INSERT INTO userUpgrade(UserID, Upgrade1, Upgrade2, Upgrade3, MPS) VALUES ('$userID', 0, 0, 0, 0)";
        $this->pdo->query($sql); }

    }
  }

}
 ?>
