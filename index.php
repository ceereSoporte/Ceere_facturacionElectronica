<?php 
   include 'controlador/controladorFactura.php';
    //obtener fecha actual del sistema
   $fechaActual = date("Y-m-d H:i:s");

?> 
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Facturacion Electronica Ceere</title>
      <!-- ====Google Font CSS==== -->
      <link href='https://fonts.googleapis.com/css?family=Roboto:100,200,300,500,700,900' rel='stylesheet' type='text/css'>
      <!-- ====Font Awesome CSS==== -->
      <link href='css/font-awesome.min.css' rel='stylesheet' type='text/css'>
      <!-- ====Favicons==== -->
      <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon">
      <link href="img/favicon.png" rel="icon" type="image/x-icon">
      <!-- ====Bootstrap Core CSS==== -->
      <link href="css/bootstrap.min.css" rel="stylesheet" type='text/css'>
      <!-- ====Material Design Lite Core CSS==== -->
      <link href="css/material.min.css" rel="stylesheet" type='text/css'>
      <!-- ====Core CSS==== -->
      <link href="style.css" rel="stylesheet" type='text/css'>
      <!-- sweet alert -->
      <link href="css/sweetalert2.min.css" rel="stylesheet" type='text/css'>
      <!-- ====Main Color Scheme CSS==== -->
      <link href="css/main-color-4.css" rel="stylesheet" type='text/css' id="mainColorScheme">
      <link href="css/style.css" rel="stylesheet" type='text/css'>
   </head>
   <body>
      <div class="container" style="margin-bottom: 1%;">
          <nav class="navbar">
 
              <div class="container">
               
                <h1 class="logo"><img src="img/logo.png" alt=""></h1>
                <ul class="nav nav-right">
                  <li><a href="./"><i class="fa fa-file"></i>&nbsp;Generar factura</a></li>
                  <li><a href="./NotasVista.php"><i class="fa fa-edit"></i>&nbsp;Crear nota</a></li>
                  <!-- <li><a href="./vistaConfig.php"><i class="fa fa-cogs"></i> Configuracion</a></li> -->
<!--                  <li><a href="#"><i class="fa fa-sign-out"></i>&nbsp;Salir</a></li> -->

                </ul>
              </div><!--/.container-->
             
            </nav>
         <div class="contactForm">
            <div class="mdl-card mdl-shadow--2dp">
               
               <div class="mdl-card__supporting-text">
                                    <div style="margin-top: 5%">
                  
                  <form  id="contactForm" name="buscador" method="post" action="index.php">
                     <div class="row" style="margin-left: 50%; transform: translateX(-50%);">
                        <div class="col-md-9" >
                           <div class="mdl-textfield mdl-js-textfield">
                              <input class="mdl-textfield__input" type="text"  name="buscarFactura" id="buscarFactura">
                              <label class="mdl-textfield__label" for="buscarFactura"> Número de factura</label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <input type="submit" class="contact-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"id="buscarBoton" name="buscarBoton" value="buscar Factura">
                        </div>
                     </div>
                  </form>
                  <hr>
                  <form  id="idFormularioGenerar" name="generador" method="post" >
                     <h4 class="mdl-typography--text-capitalize">INFORMACÍON FACTURA</h4>
                     <?php consultaFactura(); ?>
                      
                     <div class="col-md-4" style="float: right; margin-top: -1%; font-size: 25px">
                        <span>Factura:<span style="color: red"><?php echo $descripcionEstadoFactura; ?></span></span>
                       <!--  <h4>Factura:</h4>
                        <h4 style="color: red;  position: relative;" > </h4> -->
                     </div>

                     <input type="hidden" id="EstadoFacturacionElectronica" value="<?php ECHO $EstadoFacturaElectronica ?>">
                     <input type="hidden" value="<?php echo $EstadoFactura ?>" id="IdEstadoFactura"> 

                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Numero de factura</span>
                           <input class="mdl-textfield__input" value="<?php echo $numF;  ?>" disabled="true" type="text" name="idFactura" id="idFactura">
                           <label class="mdl-textfield__label" for="idFactura"></label>
                        </div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Fecha de la factura</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $FechaF; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>hora de la factura</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $HoraF; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Medio de Pago</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $NomMedioPago; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <?php 
                        if ($medioPago == 54 or $medioPago == 55) {
                        ?>  
                     <div class="col-md-6" >
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>banco</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $banco; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Numero de cuenta</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $NumCuenta; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Numero de comprobante</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $NumCompro; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <?php }?>
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Subtotal</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $subF; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>IVA</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $ivaF; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6"  >
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Seleccione si es un impuesto retenido<span style="color: red">*</span></span>
                           <select class="mdl-textfield__input"  name="retencionSelect" id="retencionSelect">
                              <option value="1">No</option>
                              <option value="0">Si</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6"  >
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Seleccione el concepto de impuesto<span style="color: red">*</span></span>
                           <select class="mdl-textfield__input" name="conceptoImpuestoSelect" id="conceptoImpuestoSelect">
                              <option value="01">VALOR TOTAL DE IVA</option>
                              <option value="03">VALOR TOTAL DE ICA</option>
                              <option value="02">VALOR TOTAL DE IMPUESTO AL CONSUMO</option>
                              <option value="04">VALOR TOTAL DE IMPUESTO NACIONAL AL CONSUMO</option>
                              <option value="0C">VALOR TOTAL DE RETENCION EN LA FUENTE</option>
                              <option value="0B">VALOR TOTAL DE RETENCION DE ICA</option>
                              <option value="0A">VALOR TOTAL DE RETENCION DE IVA</option>

                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Porcentaje IVA</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $Porcent; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Descuento</span>
                           <input class="mdl-textfield__input" disabled="" value="<?php echo $Descuentos; ?>" type="text" name="contactName" id="contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Total</span>
                           <input class="mdl-textfield__input" style="font-size: 25px;" disabled="" value="<?php echo $totF; ?>" type="text" name="contactName" id="|contactName">
                           <label class="mdl-textfield__label" for="contactName"></label>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <h4 class="mdl-typography--text-capitalize">Información Empresa</h4>
                        <?php consultaEmpresa(); ?>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Tipo de Documento</span>  
                           <label class="mdl-textfield__label" for="contactName"> </label>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo         $DescripcionDoc ; ?>"placeholder="" type="text" name="TipoDocumento" id="TipoDocumento">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Documento</span> 
                           <label class="mdl-textfield__label" for="contactName">  </label>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $docEm; ?>" type="text" name="contactName2" id="documentoEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span> Razon social</span>  
                           <label class="mdl-textfield__label" for="contactName"> </label>
                           <input class="mdl-textfield__input" disabled=""   value="<?php echo $nomEm; ?>"; type="text" name="contactName2" id="contactName2">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Departamento</span>  
                           <label class="mdl-textfield__label" for="contactName"></label>
                           <input class="mdl-textfield__input" disabled=""   value="<?php echo $departEm; ?>" type="text" name="contactName2" id="contactName2">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Ciudad</span>  
                           <label class="mdl-textfield__label" for="contactName"></label>
                           <input class="mdl-textfield__input" disabled=""   value="<?php echo $CiudadEm; ?>" type="text" name="contactName2" id="contactName2">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>barrio</span>  
                           <label class="mdl-textfield__label" for="contactName"></label>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $BarrioEm; ?>" type="text" name="contactName2" id="contactName2">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Email</span>  
                           <label class="mdl-textfield__label" for="contactName"></label>
                           <input class="mdl-textfield__input"  disabled=""  value="<?php echo $emailEmpresa
                              ; ?>" type="text" name="contactName2" id="contactName2">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>regimen</span>  
                           <label class="mdl-textfield__label" for="contactName"></label>
                           <input class="mdl-textfield__input"  disabled=""  value="<?php echo $regimenEm
                              ; ?>" type="text" name="contactName2" id="contactName2">
                        </div>
                     </div>
                     <?php consultaEntidad(); ?>
                     <div class="col-md-6">
                        <h4 class="mdl-typography--text-capitalize">Información Usuario</h4>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Tipo de documento</span>
                <input class="mdl-textfield__input" disabled=""  value="<?php echo $DescripcionDocE; ?>"  type="text" name="contactName2" id="contactName2">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Identificación</span>
                           <input class="mdl-textfield__input"  disabled="" value="<?php echo $docE; ?>" type="text" name="contactName2" id="contactName2">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Apellidos</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $pApeE." ".$sApeE; ?>" type="text" name="ApellidosEntidad" id="ApellidosEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Nombres</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $pNomE." ".$sNomE;  ?>" type="text" name="NombresEntidad" id="NombresEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>E-mail</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $emailE; ?>" type="text" name="EmailEntidad" id="EmailEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Departamento</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $departE; ?>" type="text" name="DepartamentoEntidad" id="DepartamentoEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Ciudad</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $CiudadE; ?>" type="text" name="CiudadEntidad" id="CiudadEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Dirección</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $direccionE; ?>" type="text" name="DireccionEntidad" id="DireccionEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Teléfono</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $telefono; ?>" type="text" name="TelefonoEntidad" id="TelefonoEntidad">
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Regimen</span>
                           <input class="mdl-textfield__input" disabled=""  value="<?php echo $RegimenE; ?>" type="text" name="contactName2" id="contactName2">
                        </div>
                     </div>
                     <div class="col-md-12" style="overflow-x:auto;">
                        <h4 class="mdl-typography--text-capitalize">Items Factura</h4>
                        <table width="100%" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                           <thead>
                              <tr bgcolor="#4CAF50">
                                 <th class="mdl-data-table__cell--non-numeric">Id item</th>
                                 <th>Descripcion</th>
                                 <th>cantidad</th>
                                 <th>Precio unitario</th>
                                 <th>Total sin impuestos</th>
                                 <th> impuestos</th>
                                 <th> porcentaje IVA</th>
                                 <th> concepto Impuesto <span style="color: red">*</span></th>
                                 <th> Descuento item</th>
                                 <th> total item</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php consultaDetalle();    ?>
                           </tbody>
                        </table>
                     </div>

                    
                    <!--  <button type="button" id="btnNotas" style="float: right; margin-top: 2%" class="contact-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" data-toggle="modal" data-target="#contactFormModal"  >Crear nota</button>
                      -->
                    
               </div>

               </div>
            </div>
         </div>
      </div>
      </div>
<div id="loading-screen" style="display:none">
    <img src="img/spinning-circles.svg">
</div>
     
      <button type="button" style="margin-top: 1%; margin-bottom: 1%; margin-left: 50%; transform: translateX(-50%);" class="contact-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="generarXml()"> generar Factura </button>
      </form>
      </div>
      <div class='modal-loading'></div>
   </div>
      <!-- Color Switcher End -->
      <!-- ====jQuery Core JavaScript==== -->
      <script src="js/jquery-2.2.2.min.js"></script>
      <!-- ====Bootstrap Core JavaScript==== -->
      <script src="js/bootstrap.min.js"></script>
      <!-- ====Material Design Lite Core JavaScript==== -->
      <script src="js/material.min.js"></script>
      <!-- ====jQuery Validation JavaScript==== -->
      <script src="js/jquery.validate.min.js"></script>
      <!-- ====Core JavaScript==== -->
      <script src="js/main.js"></script>
       <!-- sweet alert   -->
      <script src="js/sweetalert2.js"></script>
      <!-- ====Color Switcher JavaScript==== -->
      <script src="js/color-switcher.js"></script>
      <!-- FUNCIONES JAVASCRIPT -->
      <script>
         
                   function generarXml() {

                     var screen = $('#loading-screen');
                      var NumeroFactura = document.getElementById("idFactura").value;
                      var retencion = document.getElementById("retencionSelect").value;
                      var conceptoFactura = document.getElementById("conceptoImpuestoSelect").value;
                      var estadoFac = document.getElementById("IdEstadoFactura").value;
                      var apellidos = document.getElementById("ApellidosEntidad").value;
                      var nombres = document.getElementById("NombresEntidad").value;
                      var email = document.getElementById("EmailEntidad").value;
                      var departemento = document.getElementById("DepartamentoEntidad").value;
                      var ciudad = document.getElementById("CiudadEntidad").value;
                      var direccion = document.getElementById("DireccionEntidad").value;
                      var telefono = document.getElementById("TelefonoEntidad").value;
                      var estadoFace = document.getElementById("EstadoFacturacionElectronica").value;
                      var TipoDocumento = document.getElementById("TipoDocumento").value;


                     console.log(estadoFace);
                      
                     //INICIALIZAMOS UNA VARIABLE AUTOiNCREMENTAL
                     var idA = 1
                     //INICIALIZAMOS UN ARRAY QUE NOS VA A CAPTURAR EL VALOR DEL SELECT
                     var conceptoItem = []

                     //RECORREMOS LOS SELECT
                     $("#selectConceptoItem ").each(function(){
                        //AGREGAMOS EL DATO AL ARRAY
                        conceptoItem.push($(this).val())

                       idA++  


                     });
                  configureLoadingScreen(screen);

   // VALIDAACIONES DE CAMPOS VACIOS----------------------------      
                      swal({
                          type: 'error',
                          title: 'prueba campo',
                          text: TipoDocumento,
                          
                         })
                     if (NumeroFactura == "") {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo Numero de factura esta vacio',
                          
                        })
                        return false;

                     } else if ( apellidos == null ) {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo apellidos de la entidad esta vacio',
                          
                        })
                        return false;
                     }
                     else if ( nombres == "" ) {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo nombres de la entidad esta vacio',
                          
                        })
                        return false;
                     }
                     else if ( email == " " ||  email == "" || email == null ) {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo email de la entidad esta vacio',
                          
                        })
                        return false;
                     }
                     else if ( departemento == "" ) {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo departemento de la entidad esta vacio',
                          
                        })
                        return false;
                     }
                     else if ( ciudad == "" ) {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo ciudad de la entidad esta vacio',
                          
                        })
                        return false;
                     }
                     else if ( direccion == "" ) {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo direccion de la entidad esta vacio',
                          
                        })
                        return false;
                     }
                     else if ( telefono == "" ) {
                        swal({
                          type: 'error',
                          title: 'Campo vacio',
                          text: 'El campo telefono de la entidad esta vacio',
                          
                        })
                        return false;
                     }else{

                         var dataString = 'NumeroFac=' + NumeroFactura +'&RetencionImpuesto=' + retencion +'&conceptoItem=' + JSON.stringify(conceptoItem)  +'&ConceptoFactura=' + conceptoFactura +'&EstadoFac=' + estadoFac ;

                    

                     if (estadoFac == 5) {
                        
                        if (estadoFace != 2) {



                           swal({
                                title: 'Creacion de nota Credito',
                                text: "Esta seguro de generar una nota credito para anular esta factura electronica?",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                 confirmButtonText: 'Si, generar nota',
                                 cancelButtonText: 'Cancelar',
                              }).then((result) => {
                                if (result.value) {
                                
                                  $.ajax({
                               type: "POST",
                               url: "controlador/generadorXMLNotaC.php",
                               data: dataString,
                               cache: false,
                               success: function(html) {
                               swal(
                                   'Respuesta',
                                   html,
                                   'success'
                                  )
                               }
                               });

                                }
                              })
                           
                        }else{
                          swal({
                          type: 'error',
                          title: 'Nota ya esta generada',
                          text: 'La factura ya tiene asociada una nota credito',
                          
                        })
                        }
                              
                      
                     }else if(estadoFace == 1){

                    
                        swal({
                          type: 'error',
                          title: 'Factura ya fue generada',
                          text: 'La factura ya fue generada electronicamente',
                          
                        })
                        return false;

                     } else{
                        $.ajax({
                      type: "POST",
                      url: "controlador/generadorXMLFactura.php",
                      data: dataString,
                      cache: false,
                      success: function(html) {
                          swal({                     
                          title: 'Respuesta',
                          text: html,
                        })
                      
                      }
                      });
                     }
                         
                      
                     }
                      return false;
                     }

                  

                  function configureLoadingScreen(screen){
                      $(document)
                          .ajaxStart(function () {
                              screen.fadeIn();
                          })
                          .ajaxStop(function () {
                              screen.fadeOut();
                          });
                  }
               
          
      </script>  
   </body>
</html>