<?php
namespace ClickerApp;

class HighscoreViewModel extends BaseViewModel {
  public function __construct() {
    parent::__construct();
    $this->updateHighscore();
  }

  private function updateHighscore() {
      $userID = $_SESSION['userID'];
      $highscore = $_POST['money'];
      $sql = "UPDATE userHighscore SET Highscore = $highscore WHERE UserID = $userID";
      $this->pdo->query($sql);
      echo $highscore;
  }
}


?>
