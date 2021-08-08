<?php
namespace ClickerApp;

class RegisterViewModel extends BaseViewModel
{
  public $errors = [];

  const ER_DUP_UNIQUE = '23000';

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
      $confirm = $_POST['confirm'];


      //Validation
      if (empty($username) || empty($password) || empty($confirm)) {
        array_push($this->errors, 'All fields are required');
      }

      //Checking both passwords
      if ($password !== $confirm) {
        array_push($this->errors, 'Passwords do not match');
      }

      //Checks how many errors we have
      if (count($this->errors) > 0) {
        //throw new \Exception("Validation error count: " . count($this->errors));
      }

      // hash password
      $hash = password_hash($password, PASSWORD_BCRYPT);

      //Create a new user record
      $sql = "INSERT INTO user(username, password) VALUES ('$username', '$hash')";
      $this->pdo->query($sql);

      //Send back to login
      header('Location: login.php');
    } catch (\PdoException $e) {
      if (self::ER_DUP_UNIQUE === $e->getCode()) {
        array_push($this->errors, 'Username already taken');
      }
    } catch (Exception $e) {
      echo "Error occurred: " , $e->getMessage();
    }
  }

}

 ?>
