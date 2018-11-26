<?php 
include("../BD/conexion_sql_server.php");
require_once("../controlador/wbsFactura.php");

	$NumeroFac = $_POST['NumeroFac'];
	$busquedaNota = $_POST['NumeroNota'];
	$ConceptoNotaD = $_POST['ConceptoNota'];

  $conn = OpenConnection();
// ------------------------------------------------------------------
  // VARIABLES DE CONFIGURACION DE CADA EMPRESA
    $IdNumeracionFenalcoFactura; 
    $IdNumeracionFenalcoNotaDebito;  
    $plantillaVersionGrafica; 


    $consulta = "SELECT *  FROM  ConfiguracionFace";
    $ejecutar7 = sqlsrv_query($conn, $consulta);
    
    if ($ejecutar7 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($row = sqlsrv_fetch_array($ejecutar7)) {

        $IdNumeracionFenalcoNotaDebito  = $row['IdresolucionNotaDebito'];
         $IdNumeracionFenalcoFactura  = $row['IdResolucionFactura'];
        $plantillaVersionGrafica     = $row['VersionGrafica'];

     
    } 

//CONSULTA NOTA--------------------------------------------------------------------

    $NumND;
    $DocumentoEntidad;
    $valorND;
    $porcentDescND;
    $ValorDescND;
    $porcentIvaND;
    $NoFacND;
    $FechaND;
    $HoraND; 
    $nombreEntidad;


    $conn = OpenConnection();

    $consulta  = "SELECT * from [face Cnsta Nota Debito] 
                where [face Cnsta Nota Debito].NumNotaDebito='".$busquedaNota."'";
    $ejecutar4 = sqlsrv_query($conn, $consulta);
    if ($ejecutar4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;



        while ($lista = sqlsrv_fetch_array($ejecutar4)) {
           $NumND           = $lista['NumNotaDebito'];
           $FechaND         =  $lista['fechaNotaND']->format('Y-m-d');
           $HoraND          = $lista['fechaNotaND']->format('H:i:s');
           $DocumentoEntidad = $lista['EntidadDocumento'];
           $valorND         = $lista['ValorNotaD'];
           $porcentDescND   = $lista['PorcentajeDescuentoND'];
           $ValorDescND     = $lista['ValorDescuentoND'];
           $porcentIvaND    = $lista['porcentajeIvaND'];
           $NoFacND         = $lista['NoFactura'];
           $nombreEntidad   = $lista['NombreEntidad'];

           

            $i++;
        }

$valorIvaND = ($valorND *('0.'.$porcentIvaND));
$totalND = ($valorND + $valorIvaND);

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
        $retencionFace   = $row['retencionfacturaElectronica'];
        $conceptoFace   = $row['ConceptoFacturaElectronica'];

            
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
        $pApeE           = utf8_encode($lista['FamilyName']);
        $sApeE           = utf8_encode($lista['secondFamilyName']);
        $pNomE           = utf8_encode($lista['FirstName']);
        $sNomE           = utf8_encode($lista['MiddleName']);
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
      $CodActividaEco = '0';
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
//-----------------------------ESQUEMA DEL XML---------------------------------------------------




      $xml = new DOMDocument("1.0",'UTF-8' );
      $xml ->formatOutput=true;


      $root=$xml->createElement("root");
      $xml-> appendChild($root);

        $documento_electronico=$xml->createElement("documento_electronico");
        $root-> appendChild($documento_electronico);

          $idNumeracion=$xml->createElement("idnumeracion",$IdNumeracionFenalcoNotaDebito);
          $documento_electronico-> appendChild($idNumeracion);

            $tipodocumentoelectronicoR=$xml->createElement("tipodocumentoelectronico",2);
            $documento_electronico->appendChild($tipodocumentoelectronicoR);
          $numeroFactura=$xml->createElement("numero",$NumND);
          $documento_electronico-> appendChild($numeroFactura);

          $idconceptonota=$xml->createElement("idconceptonota" ,$ConceptoNotaD);
          $documento_electronico->appendChild($idconceptonota);


          
            $referencias=$xml->createElement("referencias");
            $documento_electronico-> appendChild($referencias); 

              $referencia=$xml->createElement("referencia");
              $referencias->appendChild($referencia);

                $idnumeracionR=$xml->createElement("idnumeracion",$IdNumeracionFenalcoFactura);
                $referencia->appendChild($idnumeracionR);
                $tipodocumentoelectronicoR=$xml->createElement("tipodocumentoelectronico",1);
                $referencia->appendChild($tipodocumentoelectronicoR);

                

                $numeroReferencia=$xml->createElement("numero",$NumeroFac);
                $referencia->appendChild($numeroReferencia);


          $fechadocumento=$xml->createElement("fechadocumento",$FechaND);
          $documento_electronico-> appendChild($fechadocumento);  
          
          $horadocumento=$xml->createElement("horadocumento",$HoraND);
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

      if ($medioPagoF==2) {
          $mediospago=$xml->createElement("mediospago");
          $documento_electronico-> appendChild($mediospago);    
            
          $mediopago=$xml->createElement("mediopago");
          $mediospago-> appendChild($mediopago);  

            $idMedioPago=$xml->createElement("id",1);
            $mediopago-> appendChild($idMedioPago);

            $codigoMedioPago=$xml->createElement("codigo",$medioPagoF);
            $mediopago-> appendChild($codigoMedioPago); 
        }

          if ($porcentIvaND != "0") {
          $impuestos=$xml->createElement("impuestos");
          $documento_electronico-> appendChild($impuestos); 
          $impuesto=$xml->createElement("impuesto");
          $impuestos-> appendChild($impuesto);  
            $idconceptoimpuesto=$xml->createElement("idconceptoimpuesto",$conceptoFace);
            $impuesto-> appendChild($idconceptoimpuesto); 
            $taxevidenceindicator=$xml->createElement("taxevidenceindicator",$retencionFace);
            $impuesto-> appendChild($taxevidenceindicator);
            $base=$xml->createElement("base",$valorND);
            $impuesto-> appendChild($base);
            $porcentaje=$xml->createElement("porcentaje",$porcentIvaND);
            $impuesto-> appendChild($porcentaje);
            $valorIm=$xml->createElement("valor",$valorIvaND);
            $impuesto-> appendChild($valorIm);

          }

          $importes=$xml->createElement("importes");
          $documento_electronico-> appendChild($importes);    
            $totalImporteBruto=$xml->createElement("totalImporteBruto",$valorND);
            $importes-> appendChild($totalImporteBruto);
            $totalBaseImponible=$xml->createElement("totalBaseImponible", ($valorND + 0 - $ValorDescND));
            $importes-> appendChild($totalBaseImponible);
            $totalDescuentos=$xml->createElement("totalDescuentos",$ValorDescND);
            $importes-> appendChild($totalBaseImponible);
            $totalCargos=$xml->createElement("totalCargos",0);
            $importes-> appendChild($totalCargos);
            $totalAnticipos=$xml->createElement("totalAnticipos",0);
            $importes-> appendChild($totalAnticipos);
            $TotalPagado=$xml->createElement("TotalPagado",$totalND);
            $importes-> appendChild($TotalPagado);
            //se inicializa el id auto incrementable
        
            $idA2 = 1;
            $valorImpuestoItemP = 0;
        while ($row2 = sqlsrv_fetch_array($ejecutar4)) {  
        
       


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
            $itemCantidad=$xml->createElement("cantidad",0);
            $item-> appendChild($itemCantidad);
            $costoTotalSinImpuestos=$xml->createElement("costoTotalSinImpuestos",0);
            $item-> appendChild($costoTotalSinImpuestos);

            $precioUnitarioSinImpuestos=$xml->createElement("precioUnitarioSinImpuestos",0);
            $item-> appendChild($precioUnitarioSinImpuestos);



            $totalImpuestosItem=$xml->createElement("totalImpuestos",0);
            $item-> appendChild($totalImpuestosItem);

            if ($Porcent != "0") {
              
            $impuestos_item=$xml->createElement("impuestos_item");
            $item-> appendChild($impuestos_item);

              $impuesto_item=$xml->createElement("impuesto_item");
              $impuestos_item-> appendChild($impuesto_item);
              $idconceptoimpuestoitem=$xml->createElement("idconceptoimpuesto",0);
              $impuesto_item-> appendChild($idconceptoimpuestoitem);
              $porcentajeItem=$xml->createElement("porcentaje",0);
              $impuesto_item-> appendChild($porcentajeItem);
              $ValorImpuestotpItem=$xml->createElement("valor",0);
              $impuesto_item-> appendChild($ValorImpuestotpItem);

        if ($Descuentos > 0) {
          $cargos_item=$xml->createElement("cargos");
          $item-> appendChild($cargos_item);
          $es_cargo=$xml->createElement("es_cargo",0);
          $cargos_item-> appendChild($es_cargo);
          $valor=$xml->createElement("valor",0);
          $cargos_item-> appendChild($valor);
        }
            
      }
    }

   

   
  // echo "<xmp>".$xml->saveXML()."</xmp>"; 

	$xml->save("../xmls/faceND_".$NumND.".xml");  

	sleep(2);

	$inst = new fenalco(); 
	$r=$inst ->EnviarNotaDebito($NumND);

  $respuestaSuccess = $r->success;
  $respuestaMsg = $r->msg;

if ($respuestaSuccess == true) {
    // modulo para acturalizar la tabla factura

         //actualiza el esatdo de la factura tiene una nota debito electronicamente
       $consultaUpdate = "UPDATE Factura set EstadoFacturaElectronica=(?) where [No Factura]=(?) ";
      $params = array('3' ,$numF); 

      $ejecutarUpdate = sqlsrv_query($conn, $consultaUpdate, $params);
    
        if ($ejecutarUpdate === false) {
            die(print_r(sqlsrv_errors(), true));
        }

      
    echo "Se registro correctemente la nota debito: ".$NumND." Asociada a la factura: ".$numF;
  }elseif($respuestaSuccess == false){
    echo $respuestaMsg;
  }
 ?>