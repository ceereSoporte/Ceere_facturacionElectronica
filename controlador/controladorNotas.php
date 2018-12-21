 <?php
include("BD/conexion_sql_server.php");


//variable que verifica si es nota credito o debito
    $TipoNota = null;

     if ($_POST) {
        $TipoNota = trim($_POST['TipoNota']);
        
    }
   

    if ($TipoNota == '0' ) {
            consultaNotaCredito();
           }elseif ($TipoNota == '1') {
            consultaNotaDebito();
           }
        


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


function consultaNotaCredito()
{

    global $busquedaNota;
    //se declaran las variables globales
    if ($_POST) {
        $busquedaNota = trim($_POST['NumeroNota']);
    }


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

function conceptoNC(){
$conn = OpenConnection();

    $consulta  = "SELECT * from ConceptosNotaCredito";



    $ejecutar1 = sqlsrv_query($conn, $consulta);
    if ($ejecutar1 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;



        while ($lista = sqlsrv_fetch_array($ejecutar1)) {
              

               echo '<option value="'.$lista['CodigoConceptoNotaCredito'].'">'.utf8_encode($lista['conceptoNotaCredito']) .'</option>';
           

            $i++;


        }
}


function consultaNotaDebito()
{

    global $busquedaNota;
    //se declaran las variables globales
    if ($_POST) {
        $busquedaNota = trim($_POST['NumeroNota']);
    }
     global $NumN;
    global $DocumentoEntidad;
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

    $consulta  = "SELECT * from [face Cnsta Nota Debito] 
                where [face Cnsta Nota Debito].NumNotaDebito='".$busquedaNota."'";
    $ejecutar4 = sqlsrv_query($conn, $consulta);
    if ($ejecutar4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;



        while ($lista = sqlsrv_fetch_array($ejecutar4)) {
           $NumN           = $lista['NumNotaDebito'];
           $FechaN         =  $lista['fechaNotaND']->format('Y-m-d ');
           $DocumentoEntidad = $lista['EntidadDocumento'];
           $valorN         = $lista['ValorNotaD'];
           $porcentDescN   = $lista['PorcentajeDescuentoND'];
           $ValorDescN     = $lista['ValorDescuentoND'];
           $porcentIvaN    = $lista['porcentajeIvaND'];
           $NoFacN         = $lista['NoFactura'];
           $nombreEntidad   = $lista['NombreEntidad'];
           $IdConcepN      = $lista['IdConceptoNotaD'];
           

            $i++;
        }
$valorIvaN = ($valorN *('0.'.$porcentIvaN));
$totalN = ($valorN + $valorIvaN);

   
}
function conceptoND(){
$conn = OpenConnection();

    $consulta  = "SELECT * from ConceptosNotaDebito";



    $ejecutar1 = sqlsrv_query($conn, $consulta);
    if ($ejecutar1 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;



        while ($lista = sqlsrv_fetch_array($ejecutar1)) {
              

               echo '<option value="'.$lista['CodigoConceptoNotaD'].'">'.utf8_encode($lista['conceptoNotaDebito']) .'</option>';
           

            $i++;


        }
}




?> 