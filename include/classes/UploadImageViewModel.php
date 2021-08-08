<?php
namespace ClickerApp;

class UploadImageViewModel extends BaseViewModel {
  public $errors = [];
  public function __construct() {
    parent::__construct();
    $this->handleImageUpload($_SESSION['userID']);
  }

  private function handleImageUpload(int $userID) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      return;
    }
    try {
      $profileIMG = $_FILES['userimg'];
      $filename = $profileIMG['name'];
      $size = $profileIMG['size'];
      $type = $profileIMG['type'];
      $tmpPath = $profileIMG['tmp_name'];
      $error = $profileIMG['error'];

      $allowedTypes = [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif'
      ];

      if ($error === UPLOAD_ERR_NO_FILE) {
        //File wasn't uploaded
        return;
      }

      //Check if file exists at the temp location
      if (!file_exists($tmpPath)) {
        throw new \Exception('$filename not found at temp location, bailing');
      }

      //Check the file if it is one of our allowed types
      $finfo = new \finfo(FILEINFO_MIME_TYPE);
      $actualType = $finfo->file($tmpPath);

      if(!in_array($actualType, $allowedTypes)) {
        $this->displayMessage(
          'The file you tried to upload was not a valid type (expecting jpeg, png or gif)', 'error'
        );
        throw new \Exception("$filename is not a valid filetype. Actual type: $actualType");
      }

      if($size > 180000) {
        $this->displayMessage(
          'The file you tried to upload was too large. Max upload size is 180Kb',
          'error'
        );
        throw new \Exception('File is too big. Actual size: ' . $size);
      }

      $handler = fopen($tmpPath, 'r');
      $data = fread($handler, $size);
      fclose($handler);

      //Delete previous image from this account
      $this->pdo->query("DELETE FROM userimg WHERE UserID = $userID");

      //Escape the image data for any quotes, etc.
      $data = $this->pdo->quote($data);
      $sql = "INSERT INTO userimg(filename, imageType, imageData, UserID) VALUES('$filename', '$type', $data, $userID)";
      $this->pdo->query($sql);

      header('Location: index.php');
  } catch (\Exception $e) {
    echo "Error occurred: " , $e->getMessage();
  }
}

}
?>
