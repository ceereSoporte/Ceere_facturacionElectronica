<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facturacion Electronica Ceere</title>
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

  <!-- ====Main Color Scheme CSS==== -->
  <link href="css/main-color-4.css" rel="stylesheet" type='text/css' id="mainColorScheme">
     
      <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <style>
     body{
        background-image: url("img/banner-bg.jpg");
        background-position: center;
        background-size: auto;
      }
    </style>
</head>
<body>

    <div class="container" align="center">   
        <div class="loginForm" style="padding-top:150px">
          <div class="mdl-card mdl-shadow--2dp" style="width:450px">
            <div class="mdl-card__title mdl-card--expand">
              <div class="modal--logo">
                <img src="img/logo.png" alt="">
              </div>
            </div>
            <div class="mdl-card__supporting-text"> 
              <form method="post" action="./controlador/controladorLogin.php" id="loginForm">
                <div class="mdl-textfield mdl-js-textfield">
                  <input class="mdl-textfield__input" type="text" id="UserLg" name="UserLg"  required>
                  <label class="mdl-textfield__label" for="UserLg">Usuario</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                  <input class="mdl-textfield__input" id="PassLg" name="PassLg" type="password" required>
                  <label class="mdl-textfield__label" for="PassLg">Contraseña</label>
                </div>
                
                <button type="submit" name="submit" class="login-form-submit-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="IngresarLogin()">Ingresar</button>
              </form>
            </div>
          
          </div>
        </div>
      </div>
           
  
  <!-- Login Form End -->
  
  
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

 <script src="js/sweetalert2.js"></script>
 
<script type="text/javascript">
  
   function IngresarLogin() {

      var Usuario = document.getElementById("UserLg").value;
      var contrasena = document.getElementById("PassLg").value;


        if (Usuario == "") {
                swal({
                  type: 'error',
                  title: 'Campo vacio',
                  text: 'El campo Usuario esta vacio',
                  
                })
                return false;
             } else if ( contrasena == "" ) {
                swal({
                  type: 'error',
                  title: 'Campo vacio',
                  text: 'El campo contraseña esta vacio',
                  
                })
                return false;
             }


             var dataString = 'UserLg=' + Usuario +'&PassLg=' + contrasena;

               // $.ajax({
               //    type: "POST",
               //    url: "controlador/controladorLogin.php",
               //    data: dataString,
               //    cache: false,
               //    success: function(msg) {

               //      if (msg == '0') {
               //        swal({  
               //        type: 'error',                   
               //        title: 'ERROR',
               //        text: 'Los campos estan vacios'
               //      })

                  
               //    }else if(msg == '1') {
               //     swal({  
               //        type: 'error',                   
               //        title: 'ERROR',
               //        text: 'El usuario o la contraseña estan incorrectos'
               //        })
               //      }
               //    }
               //  });
                  
}
</script>


</body>
</html>