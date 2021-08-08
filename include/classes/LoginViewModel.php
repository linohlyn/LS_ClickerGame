<?php
namespace ClickerApp;

class LoginViewModel extends BaseViewModel {
  public $errors = [];

  public function __construct() {
    parent::__construct();
    $this->handleSubmit();
  }

  private function handleSubmit() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      return;
    }

    try {
      $username = $_POST['username'];
      $password = $_POST['password'];

      //Validate
      if (empty($username) || empty($password)) {
        array_push($this->errors, 'All fields are required');
        throw new \Exception('Validation errors');
      }


      //Find record
      $result = $this->pdo->query("SELECT * FROM user WHERE username = '$username'");

      if (1 !== $result->rowCount()) {
        array_push($this->errors, 'User not found');
        //throw new \Exception('Not found error');
      }

      $user = $result->fetchObject();

      if(!password_verify($password, $user->password)) {
        array_push($this->errors, 'Invalid username or password');
        throw new \Exception('Bad password');
      }

      //Successful login
      $_SESSION['userID'] = $user->ID;
      $_SESSION['username'] = $user->username;
      header('Location: index.php');
    } catch (\Exception $e) {
      echo 'Error occurred: ' . $e->getMessage();
    }
  }
}

 ?>
