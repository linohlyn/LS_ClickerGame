<?php
namespace ClickerApp;

class BaseViewModel {
  public $pdo;

  public function __construct() {
    $this->pdo = $this->getPdoConnection();
  }

  public function isLoggedIn(): bool {
		return isset($_SESSION['userID']);
	}

  public function getUsername(): string {
    return $_SESSION['username'] ?? '';
  }

  public function hasImageID(): bool {
    $imageID = $_SESSION['userID'];
    $result = $this->pdo->query("SELECT * FROM userImg WHERE UserID = $imageID");
    if ($result->rowCount() !== 1) {
      return false;
    } else {
      return true;
    }
  }

  public function getImageID(): int {
    $imageID = $_SESSION['userID'];
    $results = $this->pdo->query("SELECT * FROM userImg WHERE UserID = $imageID");
    $userIMG = $results->fetchObject();
    return $userIMG->imageID;
  }

  protected function authenticate(): void {
    if (!$this->isLoggedIn()) {
      header('Location: login.php');
      exit();
    }
  }

  private function getPdoConnection() {
    try {
      $pdoOptions = [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION ];
      $dbhost = $_SERVER['us-cdbr-east-05.cleardb.net'];
      $dbport = $_SERVER['3306'];
      $dbname = $_SERVER['heroku_6fc4810c27a0cea'];
      $charset = 'utf8' ;
      $username = $_SERVER['b27233c411a5ba'];
      $password = $_SERVER['b629de26'];

      return new \PDO("mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";, $username, $password, $pdoOptions);
    } catch (\PdoException $e) {
      echo "Connection failed" . $e->getMessage();
    }
  }

  public function getHighscore(): int {
    $userID = $_SESSION['userID'];
    $sql = "SELECT Highscore FROM userHighscore WHERE UserID = $userID";
    $highresults = $this->pdo->query($sql);
    $highscore = $highresults->fetchObject();
    return $highscore->Highscore;
  }


public function getUpgrade1(): int {
  $userID = $_SESSION['userID'];
  $sql = "SELECT Upgrade1 FROM userUpgrade WHERE UserID = $userID";
  $results = $this->pdo->query($sql);
  $upgrades = $results->fetchObject();
  return $upgrades->Upgrade1;
}

public function getUpgrade2(): int {
  $userID = $_SESSION['userID'];
  $sql = "SELECT Upgrade2 FROM userUpgrade WHERE UserID = $userID";
  $results = $this->pdo->query($sql);
  $upgrades = $results->fetchObject();
  return $upgrades->Upgrade2;
}

public function getUpgrade3(): int {
  $userID = $_SESSION['userID'];
  $sql = "SELECT Upgrade3 FROM userUpgrade WHERE UserID = $userID";
  $results = $this->pdo->query($sql);
  $upgrades = $results->fetchObject();
  return $upgrades->Upgrade3;
}

public function getMPS(): int {
  $userID = $_SESSION['userID'];
  $sql = "SELECT MPS FROM userUpgrade WHERE UserID = $userID";
  $results = $this->pdo->query($sql);
  $upgrades = $results->fetchObject();
  return $upgrades->MPS;
}


}







?>
