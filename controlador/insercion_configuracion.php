<?php 
  include("../BD/conexion_sql_server.php");

  //Insersion y update de la tabla de ConfiguracionFace
        
          // DATOS QUE VIENEN DEL AJAX
         $Estadoconfig = $_POST['estadoconfig']; 
          if ($Estadoconfig == Null) {

          
          }elseif ($Estadoconfig == 0) {
            insertarConfiguracion();

          
          }elseif ($Estadoconfig == 1) {
            ActualizarConfiguracion();
         }


          function insertarConfiguracion()
          {
              $conn = OpenConnection();
              
              $IdRFactura = $_POST['IdRFactura'];
              $IdRNC = $_POST['IdRNC'];
              $IdRND = $_POST['IdRND'];
              $IdVGFatura = $_POST['IdVGFatura'];
              $IdVGNc = $_POST['IdVGNc'];
              $IdVGNd = $_POST['IdVGNd'];
              $IdEmpresaV = $_POST['empresaV'];

          
             $sql = "INSERT INTO ConfiguracionFace (IdEmpresaV, IdResolucionFactura,IdresolucionNotaCredito,IdresolucionNotaDebito,VersionGraficaFactura,VersionGraficaFacturaNC,VersionGraficaFacturaND) VALUES (?,?,?,?,?,?,?)";
                $params = array($IdEmpresaV, $IdRFactura, $IdRNC,$IdRND,$IdVGFatura,$IdVGNc,$IdVGNd);

                $stmt = sqlsrv_query( $conn, $sql, $params);
                if( $stmt === false ) {
                     die( print_r( sqlsrv_errors(), true));
                }
        

          }



          function ActualizarConfiguracion()
          {

             $IdRFactura = $_POST['IdRFactura'];
            $IdRNC = $_POST['IdRNC'];
            $IdRND = $_POST['IdRND'];
            $IdVGFatura = $_POST['IdVGFatura'];
            $IdVGNc = $_POST['IdVGNc'];
            $IdVGNd = $_POST['IdVGNd'];
            $IdEmpresaV = $_POST['empresaV'];

            
              $conn = OpenConnection();
            
            $consultaUpdate = "UPDATE ConfiguracionFace set IdResolucionFactura=(?), IdresolucionNotaCredito=(?),IdresolucionNotaDebito=(?),VersionGraficaFactura=(?),VersionGraficaFacturaNC=(?),VersionGraficaFacturaND=(?) where IdEmpresaV=(?) ";
                 $params = array($IdRFactura, $IdRNC,$IdRND,$IdVGFatura,$IdVGNc,$IdVGNd,$IdEmpresaV); 
                 $ejecutarUpdate = sqlsrv_query($conn, $consultaUpdate, $params);
    
                if ($ejecutarUpdate === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

          }



?>

