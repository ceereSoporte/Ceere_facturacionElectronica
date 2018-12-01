<?php 

class fenalco 
{
   
  
		 function EnviarFactura($NumeroFactura)
			{
				$login = "oyemeweb";
				$password = "Oyemeweb1*";
				$wsld_url = "http://192.175.120.196:8080/FactibleWebService/FacturacionWebService?wsdl";
				$client = new SOAPClient($wsld_url);
				//se vuelve a instancear la url del web service para arreglar el error que sale 
				$client->__setLocation('http://192.175.120.196:8080/FactibleWebService/FacturacionWebService?wsdl');

				//inicio de sesion
				$params = array(
					'login'=>$login,
					'password'=>$password
				);
				//funcion para logearse en fenalco
				$return = $client->autenticar($params);
				$respuesta = json_decode($return->return);
				$token = $respuesta->data->salida;


				//../xmls/face_".$NumeroFactura.".xml
				//direccion de donde se va a sacar el documento Xml para mandar a fenalco
				$xmlFuente = file_get_contents("../xmls/face_".$NumeroFactura.".xml");
				//tranfoma el xml a base 64
				$xmlFuenteBase64= base64_encode($xmlFuente);

				$params= array(
					'token'=>$token,
					'base64XML' =>$xmlFuenteBase64,
					'obtenerDatosTecnicos' =>false
				);
				//funcion para registrar el documento en la dian
				$return = $client->registrarDocumentoElectronico_Generar_FuenteXML($params);
				$resultados = json_decode($return->return);
				// echo "<pre>";
				// 	var_dump($resultados);
				// echo "</pre>";
				// echo "<hr>";	

				return $resultados;

				//Cierre de sesion 
				$params = array(
					'token' => $token,	
				);

				$return = $client->cerrarSesion($params);

			}

			function EnviarNotaCredito($NumeroNota)
			{
				$login = "oyemeweb";
				$password = "Oyemeweb1*";
				$wsld_url = "http://192.175.120.196:8080/FactibleWebService/FacturacionWebService?wsdl";
				$client = new SOAPClient($wsld_url);
				//se vuelve a instancear la url del web service para arreglar el error que sale 
				$client->__setLocation('http://192.175.120.196:8080/FactibleWebService/FacturacionWebService?wsdl');

				//inicio de sesion
				$params = array(
					'login'=>$login,
					'password'=>$password
				);
				//funcion para logearse en fenalco
				$return = $client->autenticar($params);
				$respuesta = json_decode($return->return);
				$token = $respuesta->data->salida;


				//../xmls/face_".$NumeroFactura.".xml
				//direccion de donde se va a sacar el documento Xml para mandar a fenalco
				$xmlFuente = file_get_contents("../xmls/faceNC_".$NumeroNota.".xml");
				//tranfoma el xml a base 64
				$xmlFuenteBase64= base64_encode($xmlFuente);

				$params= array(
					'token'=>$token,
					'base64XML' =>$xmlFuenteBase64,
					'obtenerDatosTecnicos' =>false
				);
				//funcion para registrar el documento en la dian
				$return = $client->registrarDocumentoElectronico_Generar_FuenteXML($params);
				$resultados = json_decode($return->return);
				// echo "<pre>";
				// 	var_dump($resultados);
				// echo "</pre>";
				// echo "<hr>";	

				return $resultados;

				//Cierre de sesion 
				$params = array(
					'token' => $token,	
				);

				$return = $client->cerrarSesion($params);

			}


			function EnviarNotaDebito($NumeroNota)
			{
				$login = "oyemeweb";
				$password = "Oyemeweb1*";
				$wsld_url = "http://192.175.120.196:8080/FactibleWebService/FacturacionWebService?wsdl";
				$client = new SOAPClient($wsld_url);
				//se vuelve a instancear la url del web service para arreglar el error que sale 
				$client->__setLocation('http://192.175.120.196:8080/FactibleWebService/FacturacionWebService?wsdl');

				//inicio de sesion
				$params = array(
					'login'=>$login,
					'password'=>$password
				);
				//funcion para logearse en fenalco
				$return = $client->autenticar($params);
				$respuesta = json_decode($return->return);
				$token = $respuesta->data->salida;


				//../xmls/face_".$NumeroFactura.".xml
				//direccion de donde se va a sacar el documento Xml para mandar a fenalco
				$xmlFuente = file_get_contents("../xmls/faceND_".$NumeroNota.".xml");
				//tranfoma el xml a base 64
				$xmlFuenteBase64= base64_encode($xmlFuente);

				$params= array(
					'token'=>$token,
					'base64XML' =>$xmlFuenteBase64,
					'obtenerDatosTecnicos' =>false
				);
				//funcion para registrar el documento en la dian
				$return = $client->registrarDocumentoElectronico_Generar_FuenteXML($params);
				$resultados = json_decode($return->return);
				// echo "<pre>";
				// 	var_dump($resultados);
				// echo "</pre>";
				// echo "<hr>";	

				return $resultados;

				//Cierre de sesion 
				$params = array(
					'token' => $token,	
				);

				$return = $client->cerrarSesion($params);

			}
	
    
}



 ?>