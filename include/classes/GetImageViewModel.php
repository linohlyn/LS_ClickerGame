<?php
namespace ClickerApp;

class GetImageViewModel extends BaseViewModel {

  public function __construct() {
    parent::__construct();
    $this->getImage();
  }

  private function getImage(): void {
    $imageID = $_GET['id'] ?? null;

    if (!$imageID) {
      return;
    }

    try {
      $result = $this->pdo->query("SELECT * FROM userImg WHERE imageID = $imageID");

      if ($result->rowCount() !== 1) {
        throw new \Exception('Problem fetching image with id: ' . $imageID);
      }

      $image = $result->fetchObject();

      //return the image data in our result
      header('Content-Type: ' . $image->imageType);
      echo $image->imageData;
    } catch (\Exception $e) {
      echo "Error occurred: " , $e->getMessage();
    }
  }


}
 ?>
