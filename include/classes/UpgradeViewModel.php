<?php
namespace ClickerApp;

class UpgradeViewModel extends BaseViewModel {
  public function __construct() {
    parent::__construct();
    $this->updateUpgrade();
  }

  private function updateUpgrade() {
      $userID = $_SESSION['userID'];
      $up1 = $_POST['up1'];
      $up2 = $_POST['up2'];
      $up3 = $_POST['up3'];
      $mps = $_POST['mps'];
      $sql = "UPDATE userUpgrade SET Upgrade1 = $up1, Upgrade2 = $up2, Upgrade3 = $up3, MPS = $mps WHERE UserID = $userID";
      $this->pdo->query($sql);
      $upgrades = array($up1, $up2, $up3, $mps);
      echo json_encode($upgrades);
  }
}


?>
