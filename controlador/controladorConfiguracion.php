 <?php
include("BD/conexion_sql_server.php");

function consultaNotaCredito()
{

    global $busquedaNota;
    //se declaran las variables globales

    global $NumN;
    global $DocumentoEntidad ;
    global $concetNText;
    global $valorN;
    global $porcentDescN;
    global $ValorDescN;
    global $porcentIvaN;
    global $NoFacN;
    global $IdConcepN;
    global $FechaN;
    global $HoraN; 
    global $nombreEntidad;
    global $totalN;


    $conn = OpenConnection();

    $consulta  = "SELECT * from [face Cnta Nota Credito] 
                where [face Cnta Nota Credito].NumNotaCredito='".$busquedaNota."'";
    $ejecutar4 = sqlsrv_query($conn, $consulta);
    if ($ejecutar4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;



        while ($lista = sqlsrv_fetch_array($ejecutar4)) {
           $NumN           = $lista['NumNotaCredito'];
           $FechaN         =  $lista['fechaNotaNC']->format('Y-m-d ');
           $DocumentoEntidad = $lista['EntidadDocumento'];
           $concetNText    = $lista['ConceptoTexto'];
           $valorN         = $lista['ValorNotaC'];
           $porcentDescN  = $lista['PorcentajeDescuentoNC'];
           $ValorDescN     = $lista['ValorDescuentoNC'];
           $porcentIvaN   = $lista['porcentajeIvaNC'];
           $NoFacN         = $lista['NoFactura'];
           $nombreEntidad   = $lista['NombreEntidad'];
           $IdConcepN      = $lista['IdConcpetoNC'];
           

            $i++;
        }

    $valorIvaN = ($valorN *('0.'.$porcentIvaN));
    $totalN = ($valorN + $valorIvaN);



}





?> 