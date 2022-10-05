<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/");


 // include main configuration file
require_once PROJECT_ROOT_PATH . "../inc/config.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "../controller/api/BaseController.php";
require_once PROJECT_ROOT_PATH . "../controller/api/SensorController.php";
require_once PROJECT_ROOT_PATH . "../controller/api/DashboardWebController.php";
require_once PROJECT_ROOT_PATH . "../controller/api/LoginUserController.php";


// include the use model file
require_once PROJECT_ROOT_PATH . "../model/SensorDao.php";
require_once PROJECT_ROOT_PATH . "../model/GaugeDao.php";
require_once PROJECT_ROOT_PATH . "../model/ChartDao.php";
include_once (PROJECT_ROOT_PATH . '../model/UserDao.php');


require_once PROJECT_ROOT_PATH . "../model/SensorData.php";
require_once PROJECT_ROOT_PATH . "../model/User.php";


?>

