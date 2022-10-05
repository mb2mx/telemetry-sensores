<?php
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urisArray = explode('/', $uri);


/*===============================================
Cuando no se hace ninguna peticion  a la API
===============================================*/

if (count($urisArray) == 0) {
    header("HTTP/1.1 404 Not Found");

    $json = array(

        'status' => 404,
        'result' => 'Not Found'
    );
    echo json_encode($json, http_response_code($json['status']));
    return;
}

/*===============================================
Cuando se realiza peticion POST a la API de sensores
===============================================*/

if (count($urisArray) > 1 && isset($_SERVER['REQUEST_METHOD'])) {


    if ($_SERVER['REQUEST_METHOD'] == "GET" && strpos($uri, '/sensores/grafica1')) {
        $cdDevice = $_GET['cdDevice'];

        if ($cdDevice) {
            $objFeedController = new SensorController();
            $objFeedController->getDataChart($cdDevice);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == "GET" && strpos($uri, '/sensores/gauge')) {
        $cdDevice = $_GET['cdClient'];

        if ($cdDevice) {
            $dashboardWebController = new DashboardWebController();
            $dashboardWebController->getDataGauge($cdDevice);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "GET" && strpos($uri, '/sensores/chart')) {
        $cdClient = $_GET['cdClient'];

        if ($cdClient) {
            $dashboardWebController = new DashboardWebController();
            $dashboardWebController->getDataChart($cdClient);
        }
    }



    if ($_SERVER['REQUEST_METHOD'] == "POST" && strpos($uri, '/devices/sensores')) {
        $data = json_decode(file_get_contents('php://input'), true);
        $SensorRequest = new SensorRequest($data['codeClient'], $data['codeDevice'], $data['sensorData']);

        if (!empty($data)) {
            $objFeedController = new SensorController();
            $objFeedController->saveDataSensor($SensorRequest);
        }
    }


    if ($_SERVER['REQUEST_METHOD'] == "POST" && strpos($uri, '/login')) {
         $userDto = new User(0, $_POST['username'], $_POST['password']);

        if (!empty($userDto)) {

            $loginUserController = new LoginUserController();
            $loginUserController->login($userDto);
 
        }
    }


    $json = array(

        'status' => 404,
        'result' => 'Es necesario un id de dispositivo'
    );
    echo json_encode($json, http_response_code($json['status']));
    return;
}
