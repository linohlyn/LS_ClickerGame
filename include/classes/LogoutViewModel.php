<?php
namespace ClickerApp;

class LogoutViewModel extends BaseViewModel {
  public function __construct() {
    parent::__construct();
    $this->logout();
  }

  private function logout(): void {
    $_SESSION = [];
    header('Location: index.php');
  }
}
