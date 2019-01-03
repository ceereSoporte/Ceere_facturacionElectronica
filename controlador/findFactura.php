<?php 
include("../BD/conexion_sql_server.php");
session_start();

if (isset($_SESSION['userName']) || isset($_SESSION['userDoc']) ) {
      $NombreDelUsuario = $_SESSION['userName'];
      $DocumentoDelUsuario = $_SESSION['userDoc'];


}


 if (isset($_POST['NumeroResolucion'])) {
     $busquedaResolucionSelect = trim($_POST['NumeroResolucion']);
    }
    echo $busquedaResolucionSelect;


        $conn = OpenConnection();
        $consultaFacturaUsuario = "SELECT * FROM  face_facturaPorUsuario where face_facturaPorUsuario.[Documento Usuario] = '".$DocumentoDelUsuario."' and face_facturaPorUsuario.IdEmpresaV = '".$busquedaResolucionSelect."'";
        $ejecutarFacturaUsuario = sqlsrv_query($conn, $consultaFacturaUsuario);
        
        if ($ejecutarFacturaUsuario === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $i = 0;

        $rows = sqlsrv_has_rows( $ejecutarFacturaUsuario );


        if ($rows === true) {
			      while ($row = sqlsrv_fetch_array($ejecutarFacturaUsuario)) {

   					echo '<option value="'.$row['NoFactura'].'">'.$row['NoFactura'].'</option>';
   				}
			   }  else {
			 		 echo '<option value="">No hay facturas realizadas</option>';
			   }
   		

        		 
               
        	

        // }

     


?>