<?php 
include("../BD/conexion_sql_server.php");
require_once("../controlador/wbsFactura.php");


     $conn = OpenConnection();
// ------------------------------------------------------------------
		
	

	$conceptoItem = json_decode($_POST['conceptoItem']);
	// $posicionItem = $_POST['posicion'];

	$busqueda = $_POST['NumeroFac'];
	$RetenImpuesto = $_POST['RetencionImpuesto'];
	$IdEmpresaVBusqueda = trim($_POST['IdEmpresaV']);
	$ConceptoFacturaE = $_POST['ConceptoFactura'];
	//CONSULTAS




//CONSULTA FACTURA--------------------------------------------
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
     $IdEmpresaV;
     $fechaVencimiento;

    $consulta = "SELECT *  FROM  [Face Cnsta Factura] 
                        WHERE [Face Cnsta Factura].[Id Factura] = '" . $busqueda . "' and [Face Cnsta Factura].IdEmpresaV ='".$IdEmpresaVBusqueda."'";
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
        $PrefijoF   = $row['PrefijoFac'];
        $IdEmpresaV   = $row['IdEmpresaV']; 
         $fechaVencimiento   = $row['FechaVencimiento']->format('Y-m-d');   
    }
    
    if ($medioPagoF == 2) {
        $NomMedioPago = "efectivo";
        $medioPagoF    = 10;
    } else if ($medioPagoF == 4) {
        $NomMedioPago = "tarjeta de debito";
        
    } else if ($medioPagoF == 5) {
        $NomMedioPago = "tarjeta de credito";

        
    }else if($medioPagoF == null){
    	$NomMedioPago = "Credito";
        $medioPagoF    = 12;
    }



//CONSULTA CONFIGURACION DE LA FACTURACION ELECTRONICA
    // VARIABLES DE CONFIGURACION DE CADA EMPRESA
		$IdNumeracionFenalcoFactura;	
		$plantillaVersionGrafica; 


		$consulta = "SELECT * from  ConfiguracionFace cf join EmpresaV ev on ev.[Id EmpresaV] = cf.IdEmpresaV where cf.IdEmpresaV = ".$IdEmpresaV;
    $ejecutar7 = sqlsrv_query($conn, $consulta);
    
    if ($ejecutar7 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($row = sqlsrv_fetch_array($ejecutar7)) {

        $IdNumeracionFenalcoFactura  = $row['IdResolucionFactura'];
        $plantillaVersionGrafica     = $row['VersionGraficaFactura'];

     
    }

//CONSULTA EMPRESA------------------------------------------

 $emailEmpresa;
 $consulta = "SELECT * from [Face Cnsta FacturaE Empresa] 
                       where [Face Cnsta FacturaE Empresa].[Id Factura]='" . $busqueda . "' and [Face Cnsta FacturaE Empresa].IdEmpresaV ='".$IdEmpresaVBusqueda."'";
    
    $ejecutar2 = sqlsrv_query($conn, $consulta);
    if ($ejecutar2 === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $i = 0;
    while ($lista = sqlsrv_fetch_array($ejecutar2)) {

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
                where [Face Cnsta FacturaE Entidad].[Id Factura]='" . $busqueda . "' and [Face Cnsta FacturaE Entidad].IdEmpresaV ='".$IdEmpresaVBusqueda."'";
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
        $departE         = utf8_encode($lista['CodigoDepartamento']);
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

         if ($emailE == "") {
            $emailE =  'alejandrovelez74@gmail.com';
        } 


       switch ($tipoDocE) {
   			case 1:
   	    		$tipoDocE = 13;
       			break;
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
 	
 	if ($RegimenE == '1') {
 		$RegimenE = '0';
 	}

 
    $telefonoEntidad=str_replace("-","",$telefonoE);

//CONSULTAR DETALLE FACTURA------------------------------------------------------

    $consulta2 = "SELECT * from [Face Cnsta FacturaEII] 
            where [Face Cnsta FacturaEII].[Id Factura]='" . $busqueda . "'";
    $ejecutar4 = sqlsrv_query($conn, $consulta2);
    if ($ejecutar4 === false) {
        die(print_r(sqlsrv_errors(), true));
    }



// CONSULTA BASE IMPUESTO--------------------------------------------------------


     $consulta5 = "SELECT * from [Face Total base impuestos] where [Face Total base impuestos].[No Factura] ='".$busqueda . "'";
    $ejecutar5 = sqlsrv_query($conn, $consulta5);
    if ($ejecutar5 === false) {
        die(print_r(sqlsrv_errors(), true));
    }



//-----------------------------ESQUEMA DEL XML--------------------------



			$xml = new DOMDocument("1.0",'UTF-8' );
			$xml ->formatOutput=true;


			$root=$xml->createElement("root");
			$xml-> appendChild($root);

				$documento_electronico=$xml->createElement("documento_electronico");
				$root-> appendChild($documento_electronico);

				$idnumeracion=$xml->createElement("idnumeracion",$IdNumeracionFenalcoFactura);
					$documento_electronico-> appendChild($idnumeracion);

					$numeroFactura=$xml->createElement("numero",$numF);
					$documento_electronico-> appendChild($numeroFactura);


					$fechadocumento=$xml->createElement("fechadocumento",$FechaF);
					$documento_electronico-> appendChild($fechadocumento);	
					
					$horadocumento=$xml->createElement("horadocumento",$HoraF);
					$documento_electronico-> appendChild($horadocumento);

					$documentoexportacion=$xml->createElement("documentoexportacion",0);
					$documento_electronico-> appendChild($documentoexportacion);

					$documentCurrencyCode=$xml->createElement("documentCurrencyCode",'COP');
					$documento_electronico-> appendChild($documentCurrencyCode);

					$idreporte=$xml->createElement("idreporte",$plantillaVersionGrafica);
					$documento_electronico-> appendChild($idreporte);





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

						$emailcontacto=$xml->createElement("emailcontacto",$emailE);
						$adquiriente-> appendChild($emailcontacto);

						$emailentrega=$xml->createElement("emailentrega",$emailE);
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

				if ($medioPagoF==10) {
					$mediospago=$xml->createElement("mediospago");
					$documento_electronico-> appendChild($mediospago);		
						
					$mediopago=$xml->createElement("mediopago");
					$mediospago-> appendChild($mediopago);	

						$idMedioPago=$xml->createElement("id",1);
						$mediopago-> appendChild($idMedioPago);

						$codigoMedioPago=$xml->createElement("codigo",$medioPagoF);
						$mediopago-> appendChild($codigoMedioPago);	
				}
					

				if ($ivaF != 0) {
					
				
					$impuestos=$xml->createElement("impuestos");
					$documento_electronico-> appendChild($impuestos);
					while ($row2 = sqlsrv_fetch_array($ejecutar5)) {	

					$impuesto=$xml->createElement("impuesto");
					$impuestos-> appendChild($impuesto);	
						$idconceptoimpuesto=$xml->createElement("idconceptoimpuesto",$ConceptoFacturaE);
						$impuesto-> appendChild($idconceptoimpuesto);	
						$taxevidenceindicator=$xml->createElement("taxevidenceindicator",$RetenImpuesto);
						$impuesto-> appendChild($taxevidenceindicator);
						$base=$xml->createElement("base",$row2['base']);
						$impuesto-> appendChild($base);
						$porcentaje=$xml->createElement("porcentaje",$row2['Valor Iva % FacturaII']);
						$impuesto-> appendChild($porcentaje);
						$valorIm=$xml->createElement("valor",$row2['ValorIva']);
						$impuesto-> appendChild($valorIm);

					}
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
				


		        	$items=$xml->createElement("items");
					$documento_electronico -> appendChild($items);
				while ($row2 = sqlsrv_fetch_array($ejecutar4)) {	
				
		 		$arrayId = [
		            $idA =>  $row2['Id FacturaII']
		            
		        ];
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



						if ($row2['Porcentaje'] != "0") {

							$valorImpuestoItemP=$row2['TaxAmount'];

						}else{
							$valorImpuestoItemP=0;
						}


						$totalImpuestosItem=$xml->createElement("totalImpuestos",$valorImpuestoItemP);
						$item-> appendChild($totalImpuestosItem);

						if ($row2['Porcentaje'] != "0") {
							
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

						}
						if ($Descuentos > 0) {
					$cargos_item=$xml->createElement("cargos");
					$item-> appendChild($cargos_item);
					$es_cargo=$xml->createElement("es_cargo",0);
					$cargos_item-> appendChild($es_cargo);
					$valor=$xml->createElement("valor",$row2['DescuentoItem']);
					$cargos_item-> appendChild($valor);
				}
			//insercion en la bd mediante el while
			$consultaUpdateItem = "UPDATE FacturaII set [concepto Impuesto]=(?) where [Id FacturaII] = (?) ";
			$params = array($conceptoItem[$idA],$row2['Id FacturaII']);	

			$ejecutarUpdateItem = sqlsrv_query($conn, $consultaUpdateItem, $params);
    
		    if ($ejecutarUpdateItem === false) {
		        die(print_r(sqlsrv_errors(), true));
		    }
		    	$idA++;
		    	$idA2++;
			}

			if ($medioPagoF==5) {
				$ValorMedioPago = "Tajeta de Credito";
			}elseif($medioPagoF==4){
				$ValorMedioPago = "Tajeta de Debito";
			}elseif($medioPagoF==10){
				$ValorMedioPago = "Efectivo";
			}elseif ($medioPagoF == 12) {
				$ValorMedioPago = "Credito";
			}

				$datosextra=$xml->createElement("datosextra");
    			$documento_electronico -> appendChild($datosextra);

			        $datoextra=$xml->createElement("datoextra");
			        $datosextra -> appendChild($datoextra);
			          	$claveExt=$xml->createElement("clave","MEDIO_PAGO");
			          	$datoextra -> appendChild($claveExt);
			          	$valorExt=$xml->createElement("valor",$ValorMedioPago);
			          	$datoextra -> appendChild($valorExt);


			          	$datoextra=$xml->createElement("datoextra");
			        	$datosextra -> appendChild($datoextra);
			          	$claveExt=$xml->createElement("clave","FECHA_VEN");
			          	$datoextra -> appendChild($claveExt);
			          	$valorExt=$xml->createElement("valor",$fechaVencimiento);
			          	$datoextra -> appendChild($valorExt);
	
		    
	// echo "<xmp>".$xml->saveXML()."</xmp>";	


	$xml->save("../xmls/face_".$numF.".xml");  

	sleep(2);

	$inst = new fenalco(); 
	$r=$inst ->EnviarFactura($numF);


	$respuestaSuccess = $r->success;
	$respuestaMsg = $r->msg;

	


	if ($respuestaSuccess == true) {
		// modulo para acturalizar la tabla factura
			$consultaUpdate = "UPDATE Factura set [Impuesto Factura Electronica retenido]=(?), [Concepto Factura Electronica]=(?),EstadoFacturaElectronica=(?) where [No Factura]=(?) ";
			$params = array($RetenImpuesto, $ConceptoFacturaE, '1' ,$numF);	

			$ejecutarUpdate = sqlsrv_query($conn, $consultaUpdate, $params);
    
		    if ($ejecutarUpdate === false) {
		        die(print_r(sqlsrv_errors(), true));
		    }
		echo "La factura numero ".$numF." ha sido enviada correctamente";
	}elseif($respuestaSuccess == false){
		echo $respuestaMsg;
	}


	
 ?>