<?php
require_once 'classes/BaseViewModel.php';
require_once 'classes/HomeViewModel.php';
require_once 'classes/LoginViewModel.php';
require_once 'classes/RegisterViewModel.php';
require_once 'classes/LogoutViewModel.php';
require_once 'classes/AccountViewModel.php';
require_once 'classes/GetImageViewModel.php';
require_once 'classes/UploadImageViewModel.php';
require_once 'classes/HighscoreViewModel.php';
require_once 'classes/UpgradeViewModel.php';
require_once 'classes/ViewHighscoreViewModel.php';



use ClickerApp\BaseViewModel;
use ClickerApp\HomeViewModel;
use ClickerApp\RegisterViewModel;
use ClickerApp\LoginViewModel;
use ClickerApp\LogoutViewModel;
use ClickerApp\AccountViewModel;
use ClickerApp\GetImageViewModel;
use ClickerApp\UploadImageViewModel;
use ClickerApp\HighscoreViewModel;
use ClickerApp\UpgradeViewModel;
use ClickerApp\ViewHighscoreViewModel;


session_start();

//Find what page we are on
$file = $_SERVER['PHP_SELF'];

preg_match('/\/([-a-z]+)\.php$/', $file, $matches);

if (count($matches) !== 2) {
	http_response_code(404);
	echo "Not Found";
	exit();
}

$route = $matches[1];

//Set the respective model we need
switch($route) {
  case 'index':
  $model = new HomeViewModel();
  break;
	case 'getimage':
  $model = new GetImageViewModel();
  break;
	case 'accountuploadimg':
	$model = new UploadImageViewModel();
	break;
  case 'register':
    $model = new RegisterViewModel();
  break;
  case 'login':
    $model = new LoginViewModel();
  break;
  case 'logout':
    $model = new LogoutViewModel();
  break;
  case 'accountoptions':
    $model = new AccountViewModel();
  break;
	case 'sendscore':
		$model = new HighscoreViewModel();
	break;
	case 'sendupgrades':
		$model = new UpgradeViewModel();
	break;
	case 'highscores':
		$model = new ViewHighscoreViewModel();
	break;
  default:
    $model = new BaseViewModel();
  break;
}
