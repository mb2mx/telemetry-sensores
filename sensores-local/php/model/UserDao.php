<?php
require_once PROJECT_ROOT_PATH . "../config/Database.php";
 

class UserDao extends Database
{

	public function login(&$usuario)
	{
		$user = $usuario->getUsuario();
		//$pass = $usuario->getPass();
		$query = " select  c.id_client ,c.code, c.name, d.code as code_device from client c
		inner join client_device cd  on c.id_client =cd.id_client  
		inner join device d on d.id_device =cd.id_device 
		where c.code ='$user'";
		return $this->select($query);
	}
}
