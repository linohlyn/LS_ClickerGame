<?php
namespace ClickerApp;

class AccountViewModel extends BaseViewModel {
  public $errors = [];

  public function __construct() {
    parent::__construct();
    $this->handleChangePassword();
    $this->handleDeleteAccount();
  }

  private function handleDeleteAccount() {
    $userID = $_SESSION['userID'];
    if (isset($_POST['deleteacc'])) {
      $sql = "DELETE FROM user WHERE ID = $userID";
      $this->pdo->query($sql);
      header('Location: logout.php');
    }
  }

  private function handleChangePassword() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($_POST['deleteacc'])) {
      return;
    }

  try {
    $username = $_SESSION['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    //Validation
    if (empty($password) || empty($confirm)) {
      array_push($this->errors, 'All fields are required');
    }

    //Checking both passwords
    if ($password !== $confirm) {
      array_push($this->errors, 'Passwords do not match');
    }

    //Checks how many errors we have
    if (count($this->errors) > 0) {
      throw new \Exception("Validation error count: " . count($this->errors));
    }


    //Hash password
    $hash = password_hash($password, PASSWORD_BCRYPT);

    //Send to server
    $sql = "UPDATE user SET password = '$hash' WHERE username = '$username'";
    $this->pdo->query($sql);

    //Send back to index
    header('Location: index.php');
  } catch (\Exception $e) {
    echo "Error occurred: " , $e->getMessage();
  }
}
}
?>
