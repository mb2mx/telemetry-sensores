<?php
require_once PROJECT_ROOT_PATH . "../config/Database.php";

class SensorDao extends Database
{
    public function getSensor($limit)
    {
        return $this->select("SELECT * FROM wiffi ORDER BY user_id ASC LIMIT 1");
    }

    public function findByClientAndDeviceCode($codeClient, $codeDevice)
    {

        $query = "SELECT c.id_client , c.code as code_client , d.id_device ,d.code  as code_device, 
        s.id_sensor , s.code as code_sensor, ds.correction_factor as factor FROM client c 
        inner join client_device cd on cd.id_client =c.id_client 
        inner join device d on cd.id_device =d.id_device 
        inner join device_sensor ds on ds.id_device =d.id_device
        INNER JOIN sensor s on s.id_sensor =ds.id_sensor 
        WHERE c.code ='$codeClient' AND d.code ='$codeDevice';";

        // $query ="SELECT c.id_client , c.code as code_client , d.id_device ,d.code  as code_device,  s.id_sensor , s.code as code_sensor FROM client c inner join device d on c.id_device =d.id_device inner join device_sensor ds on ds.id_device =d.id_device INNER JOIN sensor s on s.id_sensor =ds.id_sensor WHERE c.code ='$codeClient' AND d.code ='$codeDevice'; ";
        return $this->select($query);
    }

    public function saveDataReport($idDevice, $idSensor, $valueSensor, $dateRegister)
    {
        $query = "INSERT INTO data_report (id_device, id_sensor, valor,alert,created_at)VALUES ('$idDevice','$idSensor','$valueSensor', '0','$dateRegister')";

        return $this->save($query, $params = []);
    }

    public function getDataChart($cdDevice)
    {
        $query = "  SELECT d.code as cd_device, s.code as cd_sensor, dr.created_at 
        FROM client c 
        INNER JOIN client_device cd ON cd.id_client =c.id_client 
        INNER join  device d ON d.id_device = cd.id_device  
        INNER JOIN device_sensor ds   ON ds.id_device  = d.id_device 
        INNER JOIN sensor s ON s.id_sensor = ds.id_sensor
        INNER JOIN data_report dr ON dr.id_device = ds.id_device and dr.id_sensor =ds.id_sensor  
        WHERE  c.code ='$cdDevice' AND dr.created_at  >= CURDATE() ";

        return $this->select($query);
    }
}
