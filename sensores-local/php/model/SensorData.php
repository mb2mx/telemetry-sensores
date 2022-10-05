<?php 
	Class SensorRequest{
		
		protected $codeClient;
		protected $codeDevice;
		protected $sensorData;

		public function __construct($codeClient, $codeDevice, $sensorData){
			$this->codeClient = $codeClient;
			$this->codeDevice = $codeDevice;
			$this->sensorData = $sensorData;
		}

		public function getCodeClient() {
    		return $this->codeClient;
		}

		public function setCodeClient($codeClient) {
 	    	$this->codeClient = $codeClient;
		}
		public function getCodeDevice() {
    		return $this->codeDevice;
		}

		public function setCodeDevice($codeDevice) {
 	    	$this->codeDevice = $codeDevice;
		}
		public function getSensorData() {
    		return $this->sensorData;
		}

		public function setSensorData($sensorData) {
 	    	$this->sensorData = $sensorData;
		}
 
	}

 ?>