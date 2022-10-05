<?php
require_once PROJECT_ROOT_PATH . "../config/Database.php";

class ChartDao extends Database
{

    public function getDataChart($cdClient)
    {
        $query = "
        SELECT  s2.code as code_sensor, d.code as code_device , dr.created_at as created_date,
                 sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-TEMP') then valor  else 0 end) as temperature 
                , sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-HUM') then valor else 0 end) as humidity 
                , sum(case when dr.id_sensor = (select id_sensor from sensor s where code='S-CLP') then valor else 0 end) as pla 
                 FROM data_report dr 
                 inner join sensor s2 ON s2.id_sensor =dr.id_sensor 
                 inner  join  device d  on d.id_device =dr.id_device 
                 inner join client_device cd on cd.id_device  =dr.id_device  
                 inner join client c on c.id_client =cd.id_client 
                 where c.code ='$cdClient'  AND dr.created_at >=  DATE_ADD(CURDATE() , INTERVAL -8 hour)
                 group by dr.created_at, s2.code 
                 order by dr.created_at desc limit 30";

        return $this->select($query);
    }
}
