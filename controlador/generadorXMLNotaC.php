<?php 
include("../BD/conexion_sql_server.php");
require_once("../controlador/wbsFactura.php");

	// $NumeroFac = $_POST['NumeroFac'];
	// $NumeroNota = $_POST['NumeroNota'];
	// $ConceptoNota = $_POST['ConceptoNota'];
 //  $TipoNota = $_POST['TipoNota'];
  

  $conn = OpenConnection();
// ------------------------------------------------------------------
  // VARIABLES DE CONFIGURACION DE CADA EMPRESA
    $IdNumeracionFenalcoNotaCredito;  
    $plantillaVersionGrafica; 


    $consulta = "SELECT *  FROM  ConfiguracionFace";
    $ejecutar7 = sqlsrv_query($conn, $consulta);
    
    if ($ejecutar7 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($row = sqlsrv_fetch_array($ejecutar7)) {

        $IdNumeracionFenalcoNotaCredito  = $row['IdresolucionNotaCredito'];
        $plantillaVersionGrafica     = $row['VersionGrafica'];

     
    } 





//prueba xml
  $NumeroFac = '5000';

  $conceptoItem = json_decode($_POST['conceptoItem']);
  $RetenImpuesto = $_POST['RetencionImpuesto'];
  $ConceptoFacturaE = $_POST['ConceptoFactura'];


//CONSULTA NOTA---------------------------------------------------------------------
   $fechaActual = date("Y-m-d");
   $HoraActual = date("H:i:s");

   $fechahoraActual = date("Y-m-d H:i:s");
   $NumeroNc;
 $conn = OpenConnection();
$consulta = "SELECT * from [Face Ultima Nota Credito]";
$ejecutar6 = sqlsrv_query($conn, $consulta);
if ($ejecutar6 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($lista = sqlsrv_fetch_array($ejecutar6)) {

        $NumeroNc = utf8_encode($lista['NumNotaC']);
        
        
        $i++;
    }
    $NoNotaCredito = $NumeroNc+1;




    // $NumNC;
    // $DocumentoEntidad;
    // $concetNCText;
    // $valorNC;
    // $porcentDescNC;
    // $ValorDescNC;
    // $porcentIvaNC;
    // $NoFacNC;
    // $IdConcepNC;
    // $FechaNC;
    // $HoraNc; 
    // $nombreEntidad;


    // $conn = OpenConnection();

    // $consulta  = "SELECT * from [face Cnta Nota Credito] 
    //             where [face Cnta Nota Credito].[NumNotaCredito]='" . $busquedaNota . "'";
    // $ejecutar4 = sqlsrv_query($conn, $consulta);
    // if ($ejecutar4 === false) {
    //     die(print_r(sqlsrv_errors(), true));
    // }
    // $i = 0;



    //     while ($lista = sqlsrv_fetch_array($ejecutar4)) {
    //        $NumNC           = $lista['NumNotaCredito'];
    //        $fechaNC         =  $lista['fechaNotaNC']->format('Y-m-d');
    //        $HoraNc          = $lista['fechaNotaNC']->format('H:i:s');
    //        $DocumentoEntidad = $lista['EntidadDocumento'];
    //        $concetNCText    = $lista['ConceptoTexto'];
    //        $valorNC         = $lista['ValorNotaC'];
    //        $porcentDescNC   = $lista['PorcentajeDescuentoNC'];
    //        $ValorDescNC     = $lista['ValorDescuentoNC'];
    //        $porcentIvaNC    = $lista['porcentajeIvaNC'];
    //        $NoFacNC         = $lista['NoFactura'];
    //        $nombreEntidad         = $lista['NombreEntidad'];
    //        $IdConcepNC      = $lista['IdConcpetoNC'];
           

    //         $i++;
    //     }

//CONSULTA FACTURA------------------------------------------------------------------

	   $numF;
     $FechaF;
     $HoraF;
     $ivaF;
     $subF;
     $totF;
     $condicion;
     $medioPago;
     $NomMedioPago;
     $banco;
     $NumCuenta;
     $NumCompro;
     $Porcent;
     $Descuentos;
     $ResolucionF;
     $PrefijoF;
     $estado;
     $EstadoFacturaElectronica;
     $porcentDescuento;
     $valorLetrasFactura;
     $DocUsuario;
     $idTerminal;

     $conn = OpenConnection();
    
    $consulta = "SELECT *  FROM  [Face Cnsta Factura] 
                        WHERE [Face Cnsta Factura].[Id Factura] = '" . $NumeroFac . "'";
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
        $medioPagoF = $row['PaymentMeansCode'];
        $banco     = $row['Banco'];
        $NumCuenta = $row['PrimaryAccountNumberID'];
        $NumCompro = $row['CV2ID'];
        $Porcent   = $row['porcentaje'];
        $Descuentos   = $row['Descuentos'];  
        $ResolucionF   = $row['ResolucionFac'];  
        $PrefijoF   = $row['PrefijoFac'];   
        $EstadoFacturaElectronica   = $row['EstadoFacturaElectronica'];   
        $porcentDescuento   = $row['porcentDescuento'];   
        $valorLetrasFactura   = $row['valorLetrasFactura'];    
        $DocUsuario   = $row['DocUsuario'];    
        $idTerminal   = $row['IdTerminal'];    
    }
    
    if ($medioPagoF == 2) {
        $NomMedioPago = "efectivo";
        $medioPagoF    = 10;
    } else if ($medioPagoF == 4) {
        $NomMedioPago = "tarjeta de debito";
        $medioPagoF    = 41;
        
    } else if ($medioPagoF == 5) {
        $NomMedioPago = "tarjeta de credito";
        $medioPagoF    = 41;
        
    }

//CONSULTA EMPRESA---------------------------------------------------------------------
$docEmpresa;
$emailEmpresa;
 $consulta = "SELECT * from [Face Cnsta FacturaE Empresa] 
                       where [Face Cnsta FacturaE Empresa].[Id Factura]='" . $NumeroFac . "'";
    
    $ejecutar2 = sqlsrv_query($conn, $consulta);
    if ($ejecutar2 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($lista = sqlsrv_fetch_array($ejecutar2)) {

        $docEmpresa = utf8_encode($lista['Id Empresa']);
        $emailEmpresa = utf8_encode($lista['emailEmpresa']);
        
        
        $i++;
    }

// CONSULTA ENTIDAD---------------------------------------------------------------


    $docE;
    $tipoDocE;
    $pApeE;
    $sApeE;
    $pNomE;
    $sApeE;
    $sNomE;
    $departE;
    $direccionE;
    $CiudadE;
    $BarrioE;
    $NomCompleto;
    $DescripcionDocE;
    $RegimenE;
    $emailE;
	  $telefono;
	  $CodActividaEco;


    $consulta  = "SELECT * from [Face Cnsta FacturaE Entidad] 
                where [Face Cnsta FacturaE Entidad].[id Factura]='" . $NumeroFac . "'";
    $ejecutar3 = sqlsrv_query($conn, $consulta);
    if ($ejecutar3 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($lista = sqlsrv_fetch_array($ejecutar3)) {
        
        $docE            = $lista['Id Entidad'];
        $tipoDocE        = $lista['Id Tipo de Documento'];
        $CiudadE         = utf8_encode($lista['CityName']);
        $CodigoCiudad    = $lista['CodigoCiudad'];
        $pApeE           = $lista['FamilyName'];
        $sApeE           = $lista['secondFamilyName'];
        $pNomE           = $lista['FirstName'];
        $sNomE           = $lista['MiddleName'];
        $departE         = $lista['CodigoDepartamento'];
        $paisE         = $lista['codigoPais'];
        $direccionE      = utf8_encode($lista['Line Entidad']);
        $BarrioE         = utf8_encode($lista['citySubdivisionName']);
        $NomCompleto     = utf8_encode($lista['NomComplete']);
        $RegimenE        = utf8_encode($lista['regimen']);
        $DescripcionDocE = utf8_encode($lista['DescripcionDocE']);
        $emailE          = utf8_encode($lista['emailEntidad']);
        $telefonoE       = $lista['telefono'];
        $AutoRetenedorE  = $lista['AutoRetenedor'];
    		$GranContribuyenteE  = $lista['GranContribuyente'];
    		$CodActividaEco  = $lista['ActividadEconomica'];

        
        
        
        
        $i++;
        
        if ($sNomE == null) {
            $sNomE = "";
        }


       switch ($tipoDocE) {
   			case 2:
   	    		$tipoDocE = 13;
       			break;

       		case 3:
  	    		$tipoDocE = 22;
       			break;	
       	
       		case 4:
  	    		$tipoDocE = 41;
       			break;
       		case 5:
  	    		$tipoDocE = 11;
       			break;

       		case 6:
  	    		$tipoDocE = 12;
       			break;	

       		case 10:
  	    		$tipoDocE = 31;
       			break;				
       	}


       	switch ($paisE) {
   			case 2:
   	    		$CodPais = 'CO';
       			break;
       		}

    }



    if($AutoRetenedorE == null ){
      $AutoRetenedorE = false;
    }

    if ($GranContribuyenteE == null) {
      $GranContribuyenteE == false;
    }

    if ($CodActividaEco == null) {
      $CodActividaEco == '0';
    }
    
    $telefonoEntidad=str_replace("-","",$telefonoE);

//CONSULTAR DETALLE FACTURA------------------------------------------------------

	$docE;
    $tipoDocE;
    $pApeE;
    $sApeE;
    $pNomE;
    $sApeE;
    $sNomE;
    $departE;
    $direccionE;
    $CiudadE;
    $BarrioE;
    $NomCompleto;
    $DescripcionDocE;
    $RegimenE;
    $emailE;
    $telefono;
    $descuentoItem;


    $consulta2 = "SELECT * from [Face Cnsta FacturaEII] 
            where [Face Cnsta FacturaEII].[Id Factura]='" . $NumeroFac . "'";
    $ejecutar4 = sqlsrv_query($conn, $consulta2);
    if ($ejecutar4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }


		//tiene referencia no = 0 si = 1, esto va a estar en 0 hasta que se arregle las notas del sio a lo bien
		$mensaje = '';

//-----------------------------ESQUEMA DEL XML---------------------------------------------------




      $xml = new DOMDocument("1.0",'UTF-8' );
      $xml ->formatOutput=true;


      $root=$xml->createElement("root");
      $xml-> appendChild($root);

        $documento_electronico=$xml->createElement("documento_electronico");
        $root-> appendChild($documento_electronico);

          $idNumeracion=$xml->createElement("idnumeracion",107);
          $documento_electronico-> appendChild($idNumeracion);

          $numeroFactura=$xml->createElement("numero",$NoNotaCredito);
          $documento_electronico-> appendChild($numeroFactura);
          $idconceptonota=$xml->createElement("idconceptonota" ,2);
          $documento_electronico->appendChild($idconceptonota);


          
            $referencias=$xml->createElement("referencias");
            $documento_electronico-> appendChild($referencias); 

              $referencia=$xml->createElement("referencia");
              $referencias->appendChild($referencia);

                $idnumeracionR=$xml->createElement("idnumeracion",$IdNumeracionFenalcoNotaCredito);
                $referencia->appendChild($idnumeracionR);
                
                $idnumeracionR=$xml->createElement("tipodocumentoelectronico",3);
                $referencia->appendChild($idnumeracionR);


                $numeroReferencia=$xml->createElement("numero",$NumeroFac);
                $referencia->appendChild($numeroReferencia);



          $fechadocumento=$xml->createElement("fechadocumento",$fechaActual);
          $documento_electronico-> appendChild($fechadocumento);  
          
          $horadocumento=$xml->createElement("horadocumento",$HoraActual);
          $documento_electronico-> appendChild($horadocumento);

          $documentoexportacion=$xml->createElement("documentoexportacion",0);
          $documento_electronico-> appendChild($documentoexportacion);

          $documentCurrencyCode=$xml->createElement("documentCurrencyCode",'COP');
          $documento_electronico-> appendChild($documentCurrencyCode);

          $idreporte=$xml->createElement("idreporte",$plantillaVersionGrafica);
          $documento_electronico-> appendChild($idreporte);

          $tipocontenido=$xml->createElement("tipocontenido");
          $documento_electronico-> appendChild($tipocontenido);

          $adquiriente=$xml->createElement("adquiriente");
          $documento_electronico-> appendChild($adquiriente);

            $idtipodocumentoidentidad=$xml->createElement("idtipodocumentoidentidad" , $tipoDocE);
            $adquiriente-> appendChild($idtipodocumentoidentidad);

            $identificacion=$xml->createElement("identificacion", $docE);
            $adquiriente-> appendChild($identificacion);

          
            if ($tipoDocE == 31) {
                $docVerificacion = substr($docE, -1);
              }else{
                $docVerificacion = "";
              } 
             
            
            $digito_verificacion=$xml->createElement("digito_verificacion", $docVerificacion);
            $adquiriente-> appendChild($digito_verificacion);
              
            $nombres=$xml->createElement("nombres",$pNomE ." ". $sNomE);
            $adquiriente-> appendChild($nombres);

            $apellidos=$xml->createElement("apellidos",($pApeE ." ". $sApeE ));
            $adquiriente-> appendChild($apellidos);

            $emailcontacto=$xml->createElement("emailcontacto","alejandrovelez74@gmail.com");//$emailE
            $adquiriente-> appendChild($emailcontacto);

            $emailentrega=$xml->createElement("emailentrega","alejandrovelez74@gmail.com");//$emailE
            $adquiriente-> appendChild($emailentrega);

            $idciudad=$xml->createElement("idciudad",$CodPais.$departE.$CodigoCiudad);
            $adquiriente-> appendChild($idciudad);

            $direccion=$xml->createElement("direccion",$direccionE);
            $adquiriente-> appendChild($direccion);

            $telefono=$xml->createElement("telefono",$telefonoEntidad);
            $adquiriente-> appendChild($telefono);

            $idtiporegimen=$xml->createElement("idtiporegimen",$RegimenE);
            $adquiriente-> appendChild($idtiporegimen);

            $idactividadeconomica=$xml->createElement("idactividadeconomica",$CodActividaEco);
            $adquiriente-> appendChild($idactividadeconomica);

            if ($GranContribuyenteE == true) {
              $GranContribuyenteE = 1;
            }else {
              $GranContribuyenteE = 0;
            }

            $grancontribuyente=$xml->createElement("grancontribuyente",$GranContribuyenteE);
            $adquiriente-> appendChild($grancontribuyente);

            if ($AutoRetenedorE == true) {
              $AutoRetenedorE = 1;
            }else {
              $AutoRetenedorE = 0;
            }
            $autoretenedor=$xml->createElement("autoretenedor",$AutoRetenedorE);
            $adquiriente-> appendChild($autoretenedor);


          $CorreosCopia=$xml->createElement("CorreosCopia");
          $documento_electronico-> appendChild($CorreosCopia);  

            $CorreoCopia=$xml->createElement("CorreoCopia","alejandrovelez74@gmail.com");//$emailEmpresa
            $CorreosCopia-> appendChild($CorreoCopia);


          $mediospago=$xml->createElement("mediospago");
          $documento_electronico-> appendChild($mediospago);    
            
          $mediopago=$xml->createElement("mediopago");
          $mediospago-> appendChild($mediopago);  

            $idMedioPago=$xml->createElement("id",1);
            $mediopago-> appendChild($idMedioPago);

            $codigoMedioPago=$xml->createElement("codigo",$medioPagoF);
            $mediopago-> appendChild($codigoMedioPago); 

          if ($Porcent != "0") {
          $impuestos=$xml->createElement("impuestos");
          $documento_electronico-> appendChild($impuestos); 
          $impuesto=$xml->createElement("impuesto");
          $impuestos-> appendChild($impuesto);  
            $idconceptoimpuesto=$xml->createElement("idconceptoimpuesto",$ConceptoFacturaE);
            $impuesto-> appendChild($idconceptoimpuesto); 
            $taxevidenceindicator=$xml->createElement("taxevidenceindicator",$RetenImpuesto);
            $impuesto-> appendChild($taxevidenceindicator);
            $base=$xml->createElement("base",$subF);
            $impuesto-> appendChild($base);
            $porcentaje=$xml->createElement("porcentaje",$Porcent);
            $impuesto-> appendChild($porcentaje);
            $valorIm=$xml->createElement("valor",$ivaF);
            $impuesto-> appendChild($valorIm);

          }

          $importes=$xml->createElement("importes");
          $documento_electronico-> appendChild($importes);    
            $totalImporteBruto=$xml->createElement("totalImporteBruto",$subF);
            $importes-> appendChild($totalImporteBruto);
            $totalBaseImponible=$xml->createElement("totalBaseImponible", ($subF + 0 - $Descuentos));
            $importes-> appendChild($totalBaseImponible); 
            $totalDescuentos=$xml->createElement("totalDescuentos",$Descuentos);
            $importes-> appendChild($totalBaseImponible);
            $totalCargos=$xml->createElement("totalCargos",0);
            $importes-> appendChild($totalCargos);
            $totalAnticipos=$xml->createElement("totalAnticipos",0);
            $importes-> appendChild($totalAnticipos);
            $TotalPagado=$xml->createElement("TotalPagado",$totF);
            $importes-> appendChild($TotalPagado);
            //se inicializa el id auto incrementable
            $idA = 0;
            $idA2 = 1;
            $valorImpuestoItemP = 0;
        while ($row2 = sqlsrv_fetch_array($ejecutar4)) {  
        
        $arrayId = [
                $idA =>  $row2['Id FacturaII']
                
            ];


          $items=$xml->createElement("items");
          $documento_electronico -> appendChild($items);

          $item=$xml->createElement("item");
          $items -> appendChild($item); 
            $itemConsecutivo=$xml->createElement("consecutivo",$idA2);
            $item-> appendChild($itemConsecutivo);        
            $itemCodigo=$xml->createElement("codigo",$row2['codigoFacturaII']);
            $item-> appendChild($itemCodigo);
            $ItemCodigo_extendido=$xml->createElement("codigo_extendido");
            $item-> appendChild($ItemCodigo_extendido);
            $descripcionItem=$xml->createElement("descripcionItem", utf8_encode($row2['Description']));
            $item-> appendChild($descripcionItem);
            $itemCantidad=$xml->createElement("cantidad",$row2['InvoicedQuantity']);
            $item-> appendChild($itemCantidad);
            $costoTotalSinImpuestos=$xml->createElement("costoTotalSinImpuestos",($row2['InvoicedQuantity']*$row2['Valor FacturaII']));
            $item-> appendChild($costoTotalSinImpuestos);

            $precioUnitarioSinImpuestos=$xml->createElement("precioUnitarioSinImpuestos",$row2['Valor FacturaII']);
            $item-> appendChild($precioUnitarioSinImpuestos);



            if ($Porcent != "0") {

              $valorImpuestoItemP=($row2['TaxAmount']+$row2['Valor FacturaII']);

            }else{
              $valorImpuestoItemP=0;
            }


            $totalImpuestosItem=$xml->createElement("totalImpuestos",$valorImpuestoItemP);
            $item-> appendChild($totalImpuestosItem);

            if ($Porcent != "0") {
              
            $impuestos_item=$xml->createElement("impuestos_item");
            $item-> appendChild($impuestos_item);

              $impuesto_item=$xml->createElement("impuesto_item");
              $impuestos_item-> appendChild($impuesto_item);
                $idconceptoimpuestoitem=$xml->createElement("idconceptoimpuesto",$conceptoItem[$idA]);
                $impuesto_item-> appendChild($idconceptoimpuestoitem);
                $porcentajeItem=$xml->createElement("porcentaje",$row2['Porcentaje']);
                $impuesto_item-> appendChild($porcentajeItem);
                $ValorImpuestotpItem=$xml->createElement("valor",$row2['TaxAmount']);
                $impuesto_item-> appendChild($ValorImpuestotpItem);

        if ($Descuentos > 0) {
          $cargos_item=$xml->createElement("cargos");
          $item-> appendChild($cargos_item);
          $es_cargo=$xml->createElement("es_cargo",0);
          $cargos_item-> appendChild($es_cargo);
          $valor=$xml->createElement("valor",$row2['DescuentoItem']);
          $cargos_item-> appendChild($valor);
        }
            
      }
    }

   $paInsertAnulada = "{call Face_PA_Insertar_Nota_Credito_anulada(?,?,?,?,?,?,?,?,?,?,?,?,?)}";

      $params = array(
        array($NoNotaCredito, SQLSRV_PARAM_IN),
        array($fechahoraActual, SQLSRV_PARAM_IN),
        array($docE, SQLSRV_PARAM_IN),
        array('Anulacion de Factura No.'.$NumeroFac, SQLSRV_PARAM_IN),
        array($totF, SQLSRV_PARAM_IN),
        array($porcentDescuento, SQLSRV_PARAM_IN),
        array($Descuentos, SQLSRV_PARAM_IN),
        array($ivaF, SQLSRV_PARAM_IN),
        array($valorLetrasFactura, SQLSRV_PARAM_IN),
        array($docEmpresa, SQLSRV_PARAM_IN),
        array($DocUsuario, SQLSRV_PARAM_IN),
        array($idTerminal, SQLSRV_PARAM_IN),
        array($NumeroFac, SQLSRV_PARAM_IN),
        
    );
     $ejecutarCrear = sqlsrv_query($conn, $paInsertAnulada, $params);
    
       if ($ejecutarCrear === false) {
           die(print_r(sqlsrv_errors(), true));
       }

      //actualiza el esatdo de la factura por anulada electronicamente
       $consultaUpdate = "UPDATE Factura set EstadoFacturaElectronica=(?) where [No Factura]=(?) ";
      $params = array('2' ,$numF); 

      $ejecutarUpdate = sqlsrv_query($conn, $consultaUpdate, $params);
    
        if ($ejecutarUpdate === false) {
            die(print_r(sqlsrv_errors(), true));
        }

		  


	$xml->save("../xmls/face_".$NoNotaCredito.".xml");  

	sleep(2);

	$inst = new fenalco(); 
	$r=$inst ->EnviarNota($NoNotaCredito);

	echo $r;
	
 ?>