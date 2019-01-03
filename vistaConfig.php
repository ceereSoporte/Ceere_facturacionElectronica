<?php 

session_start();

if (isset($_SESSION['userName'])) {
      $NombreDelUsuario = $_SESSION['userName'];
      // echo $NombreDelUsuario;
}else{
   header("location: index.php");
}



   include 'controlador/controladorConfiguracion.php';
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
      <link href="css/style.css" rel="stylesheet" type='text/css'>
      <!-- sweet alert -->
      <link href="css/sweetalert2.min.css" rel="stylesheet" type='text/css'>
      <!-- ====Main Color Scheme CSS==== -->
      <link href="css/main-color-4.css" rel="stylesheet" type='text/css' id="mainColorScheme">
   </head>
   <body>
      <div class="container" style="margin-bottom: 1%;">
         <nav class="navbar">
 
              <div class="container">
               
                <h1 class="logo"><img src="img/logo.png" alt=""></h1>

                <ul class="nav nav-right">
                   <li style="color: white; font-size: 17px;  "> <i style="font-size: 25px " class="fa fa-user"></i> <?php echo $NombreDelUsuario; ?></li>
                  <li><a href="./principal.php"><i class="fa fa-file"></i>&nbsp;Generar factura</a></li>
                  <li><a href="./NotasVista.php"><i class="fa fa-edit"></i>&nbsp;Crear nota</a></li>
                   <li><a href="./vistaConfig.php"><i class="fa fa-cogs"></i>Conf</a></li>
                 <li><a href="./controlador/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Salir</a></li>

                </ul>
              </div><!--/.container-->
             
            </nav>
         <div class="contactForm">
            <div class="mdl-card mdl-shadow--2dp">
               
               <div class="col-md-12">
                  
                  <div id="container" style="margin-top: 5%">
                     <h4 class="mdl-typography--text-capitalize">CONFIGURACION</h4>
                     <form  id="contactForm" name="buscador" method="post" action="vistaConfig.php">
                     <div class="row" style="margin-left: 50%; transform: translateX(-50%);">
                        <div class="col-md-6" >
                           <div class="mdl-textfield mdl-js-textfield">
                              <input class="mdl-textfield__input" type="text"  name="NumeroResolucionB" id="NumeroResolucionB" required="">
                              <label class="mdl-textfield__label" for="NumeroResolucionB"> Número de resolucion </label>
                              
                           </div>
                        </div>
                         <div class="col-md-3">
                          <div class="mdl-textfield mdl-js-textfield">
                             <input class="mdl-textfield__input" type="text"  name="PrefijoB" id="PrefijoB">
                              <label class="mdl-textfield__label" for="PrefijoB"> Prefijo </label>
                             </div>
                           </div>
                        <div class="col-md-3">
                           <input type="submit" class="contact-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"id="buscarBoton" name="buscarBoton" value="Buscar Resolucion">
                        </div>
                     </div>
                  </form>
  
                  <div style="margin-left: 50%; transform: translateX(-50%);" class="col-md-12">
                    <h5 class="mdl-typography--text-capitalize">INFO</h5>
                        <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Resolucion de factura</span>
                           <input class="mdl-textfield__input" value="<?php echo $ResolucionBusqueda ?>"  type="text" name="ResolucionFactura" id="ResolucionFactura" disabled>
                           <label class="mdl-textfield__label" for="ResolucionFactura"></label>
                        </div>
                     </div>
                        <div class="col-md-6">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Prefijo de factura</span>
                           <input class="mdl-textfield__input" value="<?php echo $PrefijoBusqueda ?>" type="text" name="PrefijoResolucion" id="PrefijoResolucion" disabled>
                           <label class="mdl-textfield__label" for="PrefijoResolucion"></label>
                        </div>
                     </div>

                      <br/>
                      <legend>*Recuerda que los Id´s ingresados en esta vista deben ser lo que estan registrados en la numeracion de fenalco</legend>
                    <h5 class="mdl-typography--text-capitalize">Resoluciones</h5>
                        <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Id Resolucion de la factura</span>
                           <input class="mdl-textfield__input" value="<?php echo $IdResolucionFactura ?>"  type="text" name="FenalResolucionFactura" id="FenalResolucionFactura">
                           <label class="mdl-textfield__label" for="FenalResolucionFactura"></label>
                        </div>
                     </div>
                        <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Id resolucion Nota Credito</span>
                           <input class="mdl-textfield__input" value="<?php echo $IdresolucionNotaCredito ?>" type="text" name="FenalResolucionNC" id="FenalResolucionNC">
                           <label class="mdl-textfield__label" for="FenalResolucionNC"></label>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Id resolucion notas debito</span>
                           <input class="mdl-textfield__input" value="<?php echo $IdresolucionNotaDebito ?>"  type="text" name="FenalResolucionND" id="FenalResolucionND">
                           <label class="mdl-textfield__label" for="FenalResolucionND"></label>
                        </div>
                     </div>

                  </div>
                  <hr>  
                  <div style="margin-left: 50%; transform: translateX(-50%);" class="col-md-12">
                    <h5 class="mdl-typography--text-capitalize">Versiones graficas</h5>
                        <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Id Version grafica factura</span>
                           <input class="mdl-textfield__input" value="<?php echo $VersionGraficaFactura ?>"  type="text" name="VerGraficFactura" id="VerGraficFactura">
                           <label class="mdl-textfield__label" for="VerGraficFactura"></label>
                        </div>
                     </div>
                        <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Id Version grafica Nota Credito</span>
                           <input class="mdl-textfield__input" value="<?php echo $VersionGraficaFacturaNC ?>"  type="text" name="VerGraficNC" id="VerGraficNC">
                           <label class="mdl-textfield__label" for="VerGraficNC"></label>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="mdl-textfield mdl-js-textfield">
                           <span>Id Version grafica debito</span>
                           <input class="mdl-textfield__input" value="<?php echo $VersionGraficaFacturaND ?>"  type="text" name="VerGraficND" id="VerGraficND">
                           <label class="mdl-textfield__label" for="VerGraficND"></label>
                        </div>
                     </div>

                     <input type="hidden" id="EstadoRegistrado" value="<?php echo $EstadoREsolucion ?>">
                     <input type="hidden" id="IdEmpresa" value="<?php echo $IdEmpresaV ?>">

                  </div>
               
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <button type="button" style="margin-top: 1%; margin-bottom: 1%; margin-left: 50%; transform: translateX(-50%);" class="contact-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="GuardarConfiguracion()"> Guardar configuracion </button>
      </form>
      </div>
      </div>
      <div id="loading-screen" style="display:none">
            <img src="img/spinning-circles.svg">
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
         function GuardarConfiguracion() {

            var screen = $('#loading-screen');
            var ResolucionFactura = document.getElementById("ResolucionFactura").value;
            var IdRFactura = document.getElementById("FenalResolucionFactura").value;
            var IdRNC = document.getElementById("FenalResolucionNC").value;
            var IdRND = document.getElementById("FenalResolucionND").value;
            var IdVGFatura = document.getElementById("VerGraficFactura").value;
            var IdVGNc = document.getElementById("VerGraficNC").value;
            var IdVGNd = document.getElementById("VerGraficND").value;
            var estadoconfig = document.getElementById("EstadoRegistrado").value;
            var empresaV = document.getElementById("IdEmpresa").value;

            

            configureLoadingScreen(screen);

            var dataString = 'IdRFactura=' + IdRFactura  +'&IdRNC=' + IdRNC +'&IdRND=' + IdRND  +'&IdVGFatura=' + IdVGFatura +'&IdVGNc=' + IdVGNc +'&IdVGNd=' + IdVGNd +'&estadoconfig=' + estadoconfig +'&empresaV=' + empresaV ;

              if (estadoconfig == 0) {
                  swal({
                     title: 'Creacion de nueva configuracion',
                     text: "Esta seguro de crear una nueva configuracion de resolucion de factura Electronica para la resolucion: "+ResolucionFactura,
                     type: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, Crear configuracion',
                      cancelButtonText: 'Cancelar',
                   }).then((result) => {
                     if (result.value) {
                     
                      $.ajax({
                        type: "POST",
                        url: "controlador/Insercion_configuracion.php",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                        swal(
                            'Respuesta',
                            'Resolucion Creada Correctamente',
                            'success'
                           )
                        }
                        });

                   }
             })
                       

            }else if (estadoconfig == 1) {
                swal({
                  title: 'Actualizacion de configuracion',
                  text: "Esta seguro de Actualizar los datos de facturacion Electronica para la resolucion: "+ResolucionFactura,
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                   confirmButtonText: 'Si, Crear configuracion',
                   cancelButtonText: 'Cancelar',
                }).then((result) => {
                  if (result.value) {
                  
                    $.ajax({
                     type: "POST",
                     url: "controlador/Insercion_configuracion.php",
                     data: dataString,
                     cache: false,
                     success: function(html) {
                     swal(
                         'Respuesta',
                         'Resolucion Actualizada Correctamente',
                         'success'
                        )
                     }
                    });

              }
              })
                  
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