<?php
require_once PROJECT_ROOT_PATH . "../config/Database.php";

class GaugeDao extends Database
{

  public function getDataGauge($cdClient)
  {
    $query = "(
      select  'MAX' as type_calc,sub1.code ,sub1.id_data_report,sub1.id_sensor, sub1.created_at , sub1.valor as max , max(sub1.created_at)   
      from (	
      SELECT  dr.id_data_report ,s.code ,dr.id_sensor,dr.id_device , dr.created_at , dr.valor  FROM data_report dr
                  inner join sensor s ON s.id_sensor =dr.id_sensor 
                          inner  join  device d  on d.id_device =dr.id_device 
                          left join client_device cd on cd.id_device  =dr.id_device  
                          inner join client c on c.id_client =cd.id_client 
                 WHERE dr.valor  in (
                     select max(subp.valor) from data_report subp 
                     where subp.id_sensor = dr.id_sensor and subp.id_device=dr.id_device)
                  and c.code ='$cdClient'
                  order by dr.id_sensor ,dr.valor,dr.created_at desc 
      ) as  sub1 
      group by sub1.id_sensor )
      
      union all 
      (
      select  'MIN' as type_calc,sub1.code ,sub1.id_data_report,sub1.id_sensor, sub1.created_at , sub1.valor as max , max(sub1.created_at)   
      from (	
      
      SELECT  dr.id_data_report ,s.code ,dr.id_sensor,dr.id_device , dr.created_at , dr.valor  FROM data_report dr
                  inner join sensor s ON s.id_sensor =dr.id_sensor 
                          inner  join  device d  on d.id_device =dr.id_device 
                          left join client_device cd on cd.id_device  =dr.id_device  
                          inner join client c on c.id_client =cd.id_client 
                 WHERE dr.valor  in (
                     select min(subp.valor) from data_report subp 
                     where subp.id_sensor = dr.id_sensor and subp.id_device=dr.id_device)
                  and c.code ='$cdClient'
                  order by dr.id_sensor ,dr.valor,dr.created_at desc 
      ) as  sub1 
      group by sub1.id_sensor
      ) ";

    return $this->select($query);
  }
}
