<?php 
   include 'controlador/controladorNotas.php';
    //obtener fecha actual del sistema
   $fechaActual = date('d/m/Y');
   
   
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
      <!-- ====Main Color Scheme CSS==== -->
      <link href="css/main-color-4.css" rel="stylesheet" type='text/css' id="mainColorScheme">
   </head>
   <body>
      <div class="container" style="margin-bottom: 1%;">
         <nav class="navbar">
 
              <div class="container">
               
                <h1 class="logo"><img src="img/logo.png" alt=""></h1>
                <ul class="nav nav-right">
                  <li><a href="./"><i class="fa fa-file"></i>&nbsp;Generar factura</a></li>
                  <li><a href="./NotasVista.php"><i class="fa fa-edit"></i>&nbsp;Crear nota</a></li>
                  <li><a href="#"><i class="fa fa-question-circle"></i>&nbsp;Ayuda</a></li>
                 <li><a href="#"><i class="fa fa-sign-out"></i>&nbsp;Salir</a></li>
                  <li><a href="#">&nbsp;</a></li>
                </ul>
              </div><!--/.container-->
             
            </nav>
         <div class="contactForm">
            <div class="mdl-card mdl-shadow--2dp">
               
               <div class="col-md-12">
                  
                  <div id="container" style="margin-top: 5%">
                     <h4 class="mdl-typography--text-capitalize">Crear Nota</h4>
                     <form id="contactForm" name="buscador" method="post" action="NotasVista.php">
                        <div class="row col-md-12" style="margin-left: 50%; transform: translateX(-50%);">
                           <div class="col-md-5" style="margin-top: -1.5%">
                              <div class="mdl-textfield mdl-js-textfield">
                                 <span>Tipo de nota<span style="color: red">*</span></span>
                                 <select class="mdl-textfield__input" name="TipoNota" id="TipoNota">
                                    <option value="0">Nota Credito</option>
                                    <option value="1">Nota Debito</option>
                                 </select>
                              </div>
                           </div>
                           
                           <div class="col-md-4" >
                              <div class="mdl-textfield mdl-js-textfield">
                                 <input class="mdl-textfield__input" type="text" name="NumeroNota" id="">
                                 <label class="mdl-textfield__label" for="NumeroNota"> Número de Nota</label>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <input type="submit" class="contact-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"id="buscarBoton" name="buscarBoton" value="buscar Nota">
                           </div>
                           <hr>
                        </div>
                     </form>
                     <div id="InfoNota">
                        <?php consultaNotaCredito(); ?>
                        <input  type="hidden" name="TipoNota"  value="<?php echo $TipoNota;    ?>"  id="TipoNota">
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Numero nota</span>
                              <input class="mdl-textfield__input" value="<?php echo $NumNC;  ?>" disabled="true" type="text" name="" id="NumeroNota">
                              <label class="mdl-textfield__label" for="NumeroNota"></label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Numero  Factura<span style="color: red">*</span></span>
                              <input class="mdl-textfield__input" value="<?php echo $NoFacNC;  ?>"  type="text" name="" id="idFactura">
                              <label class="mdl-textfield__label" for="idFactura"></label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Concepto de Nota<span style="color: red">*</span></span>
                              <select class="mdl-textfield__input"   id="ConceptoNcSelect">

                                <?php 
                                    conceptoNC();    
                                ?>
      
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Documento</span>
                              <input class="mdl-textfield__input" value="<?php echo $DocumentoEntidad;  ?>" disabled="true" type="text" name="" id="DocEntidad">
                              <label class="mdl-textfield__label" for="DocEntidad"></label>
                           </div>
                        </div>
                          <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Nombre</span>
                              <input class="mdl-textfield__input" value="<?php echo $nombreEntidad;  ?>" disabled="true" type="text" name="" id="NomEntidad">
                              <label class="mdl-textfield__label" for="NomEntidad"></label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Fecha nota</span>
                              <input class="mdl-textfield__input" value="<?php echo $fechaNC ?>" disabled="true" type="text" name="" id="fechaNc">
                              <label class="mdl-textfield__label" for="fechaNc"></label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Valor Nota</span>
                              <input class="mdl-textfield__input" value="<?php echo $valorNC;  ?>" disabled="true" type="text" name="" id="ValorNc">
                              <label class="mdl-textfield__label" for="ValorNc"></label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Descuento </span>
                              <input class="mdl-textfield__input" value="<?php echo $porcentDescNC;  ?>" disabled="true" type="text" name="" id="PorcentDescNc">
                              <label class="mdl-textfield__label" for="PorcentDescNc"></label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Valor de descuento</span>
                              <input class="mdl-textfield__input" value="<?php echo $ValorDescNC;  ?>" disabled="true" type="text" name="" id="ValorDescNC">
                              <label class="mdl-textfield__label" for="ValorDescNC"></label>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mdl-textfield mdl-js-textfield">
                              <span>Iva</span>
                              <input class="mdl-textfield__input" value="<?php echo $porcentIvaNC;  ?>" disabled="true" type="text" name="" id="porcentIvaNC">
                              <label class="mdl-textfield__label" for="porcentIvaNC-"></label>
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <button type="button" style="margin-top: 1%; margin-bottom: 1%; margin-left: 50%; transform: translateX(-50%);" class="contact-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="generarXmlNota()"> generar Nota </button>
      </form>
      </div>
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
      <!-- ====Color Switcher JavaScript==== -->
      <script src="js/color-switcher.js"></script>
      <!-- FUNCIONES JAVASCRIPT -->
      <script>
         function generarXmlNota() {
            var NumeroFactura = document.getElementById("idFactura").value;
            var NumeroNota = document.getElementById("NumeroNota").value;
            var ConceptoNota = document.getElementById("ConceptoNcSelect").value;
            var TipoNota = document.getElementById("TipoNota").value;
          
            console.log(ConceptoNota);
            console.log( NumeroFactura );

            var dataString = 'NumeroFac=' + NumeroFactura +'&NumeroNota=' + NumeroNota +'&ConceptoNota=' + ConceptoNota +'&TipoNota=' + TipoNota ;
           
             //se borro por que no se tiene por el momento el dato
             //+'&TipoFactura=' + tipoFactura 
         
         
          //  AJAX code to submit form.
            // $.ajax({
            // type: "POST",
            // url: "controlador/generadorXMLNota.php",
            // data: dataString,
            // cache: false,
            // success: function(html) {
            // alert(html);
            // }
            // });
            
            return false;
            }
                 
          
         
      </script>  
   </body>
</html>