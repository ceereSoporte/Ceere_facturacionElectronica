 <?php

    require('BD/conexion_sql_server.php');

session_start();

if (isset($_SESSION['userName']) || isset($_SESSION['userDoc']) ) {
      $NombreDelUsuario = $_SESSION['userName'];
      $DocumentoDelUsuario = $_SESSION['userDoc'];


      // echo $NombreDelUsuario;
}else{
   header("location: index.php");
}



 $busquedaResolucionSelect = ''; 


 if (isset($_POST['NumeroResolucion'])) {
     $busquedaResolucionSelect = trim($_POST['NumeroResolucion']);
         ConsultarFacturaPorUsuario($busquedaResolucionSelect);
    }

    echo $busquedaResolucionSelect;

function consultarResolucion()
{
    
    $conn = OpenConnection();
    
    $consulta = "SELECT *  FROM  face_ConsultaEmpresaV";
    $ejecutar = sqlsrv_query($conn, $consulta);
    
    if ($ejecutar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($row = sqlsrv_fetch_array($ejecutar)) {

         echo '<option value="'.$row['IDempresaV'].'">'.$row['prefijoSIO'].$row['resolucionSIO'] .'</option>';
           
    }

}


    function ConsultarFacturaPorUsuario($IdEmV)
    {
        $conn = OpenConnection();


        echo $IdEmV;
        $consultaFacturaUsuario = "SELECT * FROM  face_facturaPorUsuario where face_facturaPorUsuario.[Documento Usuario] = '".$DocumentoDelUsuario."' and face_facturaPorUsuario.IdEmpresaV = '".$IdEmV."'";
        $ejecutarFacturaUsuario = sqlsrv_query($conn, $consultaFacturaUsuario);
        
        if ($ejecutarFacturaUsuario === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $i = 0;
        while ($row = sqlsrv_fetch_array($ejecutarFacturaUsuario)) {

             echo '<option value="'.$row['NoFactura'].'">'.$row['NoFactura'].'</option>';
               
        }
    }


function consultaFactura()
{
    //se declaran las variables globales
    
    $busqueda = '0';
    $busquedaResolucion = "";
    global $numF;
    global $FechaF;
    global $HoraF;
    global $ivaF;
    global $subF;
    global $totF;
    global $condicion;
    global $medioPago;
    global $NomMedioPago;
    global $banco;
    global $NumCuenta;
    global $NumCompro;
    global $Porcent;
    global $Descuentos;
    global $ResolucionF;
    global $PrefijoF;
    global $EstadoFactura;
    global $descripcionEstadoFactura;
    global $EstadoFacturaElectronica;
    global $IdEmpresaV;
    
    if ($_POST) {
        $busqueda = trim($_POST['buscarFactura']);
        $busquedaResolucion = trim($_POST['SelectResolucionFac']);
         
    }
    // $busqueda = '2966';
    
    $conn = OpenConnection();
    
    $consulta = "SELECT *  FROM  [Face Cnsta Factura] 
                        WHERE [Face Cnsta Factura].[Id Factura] = '" . $busqueda . "'and [Face Cnsta Factura].IdEmpresaV ='".$busquedaResolucion."'";
    $ejecutar = sqlsrv_query($conn, $consulta);
    
    if ($ejecutar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($row = sqlsrv_fetch_array($ejecutar)) {
        
        
        //se asignan los datos de la bd a las variables globales
        $numF   = $row['Id Factura'];
        $FechaF = $row['IssueDate']->format('Y-m-d');
        $HoraF  = $row['IssueDate']->format('H:i:s');   
        $ivaF      = $row['TaxExclusiveAmount'];
        $subF      = $row['LineExtensionAmount'];
        $totF      = $row['PayableAmount'];
        $condicion = $row['Id Condicion de Pago Factura'];
        $medioPago = $row['PaymentMeansCode'];
        $banco     = $row['Banco'];
        $NumCuenta = $row['PrimaryAccountNumberID'];
        $NumCompro = $row['CV2ID'];
        $Porcent   = $row['porcentaje'];
        $Descuentos   = $row['Descuentos'];   
        $ResolucionF   = $row['ResolucionFac'];  
        $PrefijoF   = $row['PrefijoFac']; 
        $EstadoFactura   = $row['EstadoFactura']; 
        $descripcionEstadoFactura   = $row['DescEstadoFactura']; 
        $EstadoFacturaElectronica   = $row['EstadoFacturaElectronica']; 
        $IdEmpresaV   = $row['IdEmpresaV']; 

        
    }
    
    if ($medioPago == 2) {
        $NomMedioPago = "efectivo";
        $medioPago    = 10;
    } else if ($medioPago == 4) {
        $NomMedioPago = "tarjeta de debito";
        $medioPago    = 54;
        
    } else if ($medioPago == 5) {
        $NomMedioPago = "tarjeta de credito";
        $medioPago    = 55;
        
    }


    //validacion de si es anulacion
    
    
}



function consultaEmpresa()
{
    //se declaran las variables globales
    
    $busqueda = '0';
     $busquedaResolucion = "";
    global $docEm;
    global $tipoDocEm;
    global $nomEm;
    global $emailEmpresa;
    global $departEm;
    global $direccionEm;
    global $CiudadEm;
    global $BarrioEm;
    global $regimenEm;
    global $DescripcionDoc;
    
    if ($_POST) {
        $busqueda = trim($_POST['buscarFactura']);
         $busquedaResolucion = trim($_POST['SelectResolucionFac']);
    }
    // $busqueda = '2966';
    
    $conn = OpenConnection();
    
    $consulta = "SELECT * from [Face Cnsta FacturaE Empresa] 
                       where [Face Cnsta FacturaE Empresa].[Id Factura]='" . $busqueda . " 'and [Face Cnsta FacturaE Empresa].IdEmpresaV ='".$busquedaResolucion."' ";
    
    $ejecutar2 = sqlsrv_query($conn, $consulta);
    if ($ejecutar2 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($lista = sqlsrv_fetch_array($ejecutar2)) {
        
        
        $docEm          = $lista['Id Empresa'];
        $tipoDocEm      = utf8_encode($lista['Id Tipo de Documento']);
        $nomEm          = utf8_encode($lista['Name Empresa']);
        $departEm       = utf8_encode($lista['Department']);
        $direccionEm    = utf8_encode($lista['LineEmpresa']);
        $CiudadEm       = utf8_encode($lista['CityName']);
        $BarrioEm       = utf8_encode($lista['citySubdivisionName']);
        $regimenEm      = $lista['taxlevelcode'];
        $DescripcionDoc = utf8_encode($lista['DescripcionDoc']);
        $emailEmpresa = utf8_encode($lista['emailEmpresa']);
        
        
        $i++;
    }
    
}

function consultaEntidad()
{
    //se declaran las variables globales
    
    $busqueda = '0';
    $busquedaResolucion = "";
    global $docE;
    global $tipoDocE;
    global $pApeE;
    global $sApeE;
    global $pNomE;
    global $sApeE;
    global $sNomE;
    global $departE;
    global $direccionE;
    global $CiudadE;
    global $BarrioE;
    global $NomCompleto;
    global $DescripcionDocE;
    global $RegimenE;
    global $emailE;
    global $telefono;
    
    
    if ($_POST) {
        $busqueda = trim($_POST['buscarFactura']);
         $busquedaResolucion = trim($_POST['SelectResolucionFac']);
    }
    // $busqueda = '2966';
    
    $conn = OpenConnection();
    
    $consulta  = "SELECT * from [Face Cnsta FacturaE Entidad] 
                where [Face Cnsta FacturaE Entidad].[Id Factura]='" . $busqueda . " ' and [Face Cnsta FacturaE Entidad].IdEmpresaV ='".$busquedaResolucion."'";
    $ejecutar3 = sqlsrv_query($conn, $consulta);
    if ($ejecutar3 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($lista = sqlsrv_fetch_array($ejecutar3)) {
        
        $docE            = $lista['Id Entidad'];
        $tipoDocE        = $lista['Id Tipo de Documento'];
        $CiudadE         = utf8_encode($lista['CityName']);
        $CodigoCiudad    = utf8_encode($lista['CodigoCiudad']);
        $pApeE           = utf8_encode($lista['FamilyName']);
        $sApeE           = utf8_encode($lista['secondFamilyName']);
        $pNomE           = utf8_encode($lista['FirstName']);
        $sNomE           = utf8_encode( $lista['MiddleName']);
        $departE         = utf8_encode($lista['Departamento']);
        $direccionE      = utf8_encode($lista['Line Entidad']);
        $BarrioE         = utf8_encode($lista['citySubdivisionName']);
        $NomCompleto     = utf8_encode($lista['NomComplete']);
        $RegimenE        = utf8_encode($lista['regimen']);
        $DescripcionDocE = utf8_encode($lista['DescripcionDocE']);
        $emailE          = utf8_encode($lista['emailEntidad']);
        $telefono        = $lista['telefono'];

        $i++;
        
        if ($sNomE == null) {
            $sNomE = "";
        }

    
    if ($RegimenE == null) {
        $RegimenE = '0';
    }
 
       if ($emailE == "") {
            $emailE =  'alejandrovelez74@gmail.com';
        } 
        
    }
    
}

function consultaDetalle()
{
    //se declaran las variables globales
    
    $busqueda = '0';
    
    
    if ($_POST) {
        $busqueda = trim($_POST['buscarFactura']);
    }
    // $busqueda = '2966';
    
    $conn = OpenConnection();
    
    $consulta2 = "SELECT * from [Face Cnsta FacturaEII] 
            where [Face Cnsta FacturaEII].[Id Factura]='" . $busqueda . "'";
    $ejecutar2 = sqlsrv_query($conn, $consulta2);
    if ($ejecutar2 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    $idA = -1;
    while ($lista = sqlsrv_fetch_array($ejecutar2)) {
        //
        $idA++;
        $arrayId = [
            $idA =>  $lista['Id FacturaII'],
            
        ];

        echo '<tr>';
        echo '<td class="mdl-data-table__cell--non-numeric">' . $lista['Id FacturaII'] . '</td>';
        echo '<td>' . utf8_encode($lista['Description']) . '</td>';
        echo '<td>' . $lista['InvoicedQuantity'] . '</td>';
        echo '<td>' . $lista['Valor FacturaII'] . '</td>';
        echo '<td>' . ($lista['Valor FacturaII'] * $lista['InvoicedQuantity']) . '</td>';
        echo '<td>'.$lista['TaxAmount'].'</td>';
        echo '<td>'.$lista['Porcentaje'].'</td>';
        echo '<td> <select class="mdl-textfield__input selectConceptItem" name="selectConceptoItem" id="selectConceptoItem">
                              <option value="01">VALOR TOTAL DE IVA</option>
                              <option value="03">VALOR TOTAL DE ICA</option>
                              <option value="02">VALOR TOTAL DE IMPUESTO AL CONSUMO</option>
                              <option value="04">VALOR TOTAL DE IMPUESTO NACIONAL AL CONSUMO</option>
                              <option value="0C">VALOR TOTAL DE RETENCION EN LA FUENTE</option>
                              <option value="0B">VALOR TOTAL DE RETENCION DE ICA</option>
                              <option value="0A">VALOR TOTAL DE RETENCION DE IVA</option>
                                       

                                    </select></td>';
        echo '<td>'.$lista['DescuentoItem'].'</td>';
        echo '<td>'.($lista['TaxAmount']+$lista['Valor FacturaII']).'</td>';
        

       
        // echo '<td>'.$lista['Cantidad FacturaII'].'</td>';
        //          echo '<td>'.$lista['Valor FacturaII'].'</td>';
        //          echo '<td>'.$lista['Valor Iva $ FacturaII'].'</td>';
        //          echo '<td>'.$lista['Valor Iva % FacturaII'].'</td>';      
        
        
        echo '</tr>';
        
        $i++;
        
    }
    
    $ejecutar5 = sqlsrv_query($conn, $consulta2);
    if ($ejecutar5 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}


?> 