<?php

class LoginUserController extends BaseController
{

    public function login(&$userDto)
    {
		$strErrorDesc=null;

        try {
            $userDao = new UserDao(); 
            $result = $userDao->login($userDto);
			if ($result==null){
				$json = array(

					'status' => 404,
					'result' => 'Usuario no encontrado'
				);
				$responseData =json_encode($json, http_response_code($json['status']));
			 

			}else{
                $responseData =  json_encode( $result[0]) ;
			}

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
