<?php

class SensorController extends BaseController
{

    public function getSensor()
    {
        $arrQueryStringParams = $this->getQueryStringParams();

        try {
            $daoSensor = new SensorDao();

            $intLimit = 10;
            if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                $intLimit = $arrQueryStringParams['limit'];
            }

            $arrSensors = $daoSensor->getSensor($intLimit);
            $responseData = json_encode($arrSensors);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Algo salió mal! Contactar al administrador..';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    public function saveDataSensor(&$sensorRequest)
    {
        $strErrorDesc = null;
        try {
            $daoSensor = new SensorDao();
            $codCli = $sensorRequest->getCodeClient();
            $codDev = $sensorRequest->getCodeDevice();
            $arrSensorsDevice = $daoSensor->findByClientAndDeviceCode($codCli, $codDev);
            $daoSensor = new SensorDao();

            $listSensorData = $sensorRequest->getSensorData();
            if (!empty($arrSensorsDevice)) {
                $arrSensoresDevice = array_values($arrSensorsDevice);
                $arrSensorDataReq = array_values($listSensorData);
                $fechaActual = date('Y-m-d H:i:s');
                foreach ($arrSensoresDevice as $valor) {
                    foreach ($arrSensorDataReq as $cSensorReq) {
                        if ($valor['code_sensor'] == $cSensorReq['codSensor']) {
                            $factor=(double)$cSensorReq['value'] * (double)$valor['factor'];
                            $applyFactor=(double)$cSensorReq['value'] +$factor;
                            $arrSensorsDevice = $daoSensor->saveDataReport($valor['id_device'], $valor['id_sensor'], $applyFactor, $fechaActual);
                        }
                    }
                }
            }

            $responseData = json_encode('true');
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Algo salió mal! Contactar al administrador.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    public function getDataChart($cdDevice)
    {
        $strErrorDesc = null;

        try {
            $daoSensor = new SensorDao();
            $arrSensors = $daoSensor->getDataChart($cdDevice);
            $dataChart = $this->filterByField($arrSensors, "cd_sensor");
            $responseData = json_encode($dataChart);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Algo salió mal! Contactar al administrador..';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
