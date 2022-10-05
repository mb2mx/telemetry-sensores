<?php

class DashboardWebController extends BaseController
{  

    public function getDataGauge($cdClient)
    { 
        $strErrorDesc=null;

        try {
            $gaugeDao = new GaugeDao(); 
            $dataGauge= $gaugeDao->getDataGauge($cdClient);
            
            $responseData = json_encode($dataGauge);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Algo salió mal! Contactar al administrador..';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }    
    }
    
    public function getDataChart($cdClient)
    { 
        $strErrorDesc=null;

        try {
            $chartDao = new ChartDao(); 
            $chartDao= $chartDao->getDataChart($cdClient);
            $arrayDeviceSensor = $this->filterByField($chartDao, "code_device" );
            
            $arrayResponse = array();

            foreach ($arrayDeviceSensor as $deviceSensor) {
                $labels = array_unique(array_column($deviceSensor, "created_date"));
                $object = new stdClass();
                $arraySensor = $this->filterByField($deviceSensor, "code_sensor" );
                $myarray = array_values($labels);

                $object->arraySensor = $arraySensor;
                $object->labels = $myarray;
                //$key=  $deviceSensor[0]["code_device"];

                //$array = array($key=>$object);
                 $array = array($object);

                array_push($arrayResponse,$array);

            } 
     
            $responseData = json_encode($arrayResponse);
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage().'Algo salió mal! Contactar al administrador..';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }    
    }
    
}