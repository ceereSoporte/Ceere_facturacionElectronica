<?php 
	
	include('../BD/conexion_sql_server.php');

	$conn = OpenConnection();
    
    $consulta = "SELECT *  FROM  [Face Cnsta Login] 
                        WHERE [Face Cnsta Login].NombreUsuario  = '" . $_POST['UserLg'] . "' and  [Face Cnsta Login].password = '".$_POST['PassLg']."'";
    $ejecutar = sqlsrv_query($conn, $consulta);


 	while ($row = sqlsrv_fetch_array($ejecutar)) {

 		$NombreDelUsuario   = $row['NomUsuario'];

 	}


 	if ($NombreDelUsuario != null) {
		jsondata['success'] = true;
 		$jsondata['message'] = 'bienvenido '.$NombreDelUsuario;
 		header('Location: index.php');
 	}else{
 		 $jsondata['success'] = false;
        $jsondata['message'] = 'Usuario o Contraseña incorecta';
 	}

    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();

}
// if ($row_count == 1 ) {
//     		$datos = sqlsrv_fetch_array($ejecutar);
//     		json_encode(array('error'=>false, 'Nombre'=>$datos['NomUsuario']));

//     }else{
//     	json_encode(array('error'=>false));
//     	echo 'Usuario o Contraseña incorecta';

//     }

 ?>