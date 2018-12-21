 <?php
include("BD/conexion_sql_server.php");

$ResolucionBusqueda = "";
$PrefijoBusqueda ="";

if ($_POST) {
        $ResolucionBusqueda = trim($_POST['NumeroResolucionB']);
        $PrefijoBusqueda = trim($_POST['PrefijoB']);


    }

    

          


$IdEmpresaV = "";
$EstadoREsolucion = "";
$conn = OpenConnection();

    $consulta  = "SELECT * from face_ConsultaEmpresaV where resolucionSIO= '".$ResolucionBusqueda."' and prefijoSIO = '".$PrefijoBusqueda."'";
    $ejecutar4 = sqlsrv_query($conn, $consulta);
    if ($ejecutar4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;



        while ($lista = sqlsrv_fetch_array($ejecutar4)) {
           $IdEmpresaV           = $lista['IDempresaV'];
            $i++;
        }

    global $IdResolucionFactura;
    global $IdresolucionNotaCredito ;
    global $IdresolucionNotaDebito;
    global $VersionGraficaFactura;
    global $VersionGraficaFacturaNC;
    global $VersionGraficaFacturaND;

    $consulta  = "SELECT * from [Face Cnta ConfiguracionFace] 
                where [Face Cnta ConfiguracionFace].IdEmpresaV='".$IdEmpresaV."'";
    $ejecutar4 = sqlsrv_query($conn, $consulta);
    if ($ejecutar4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;



        while ($lista = sqlsrv_fetch_array($ejecutar4)) {
           $IdResolucionFactura           = $lista['IdResolucionFactura'];
           $IdresolucionNotaCredito         =  $lista['IdresolucionNotaCredito'];
           $IdresolucionNotaDebito = $lista['IdresolucionNotaDebito'];
           $VersionGraficaFactura    = $lista['VersionGraficaFactura'];
           $VersionGraficaFacturaNC         = $lista['VersionGraficaFacturaNC'];
           $VersionGraficaFacturaND  = $lista['VersionGraficaFacturaND'];
           
           

            $i++;
        }

      if ($IdResolucionFactura == Null) {
          $EstadoREsolucion = 0;

        }else{
          $EstadoREsolucion = 1;
        }  
?> 