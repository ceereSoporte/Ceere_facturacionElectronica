<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,200,300,500,700,900' rel='stylesheet' type='text/css'>
      <!-- ====Font Awesome CSS==== -->
      <link href='css/font-awesome.min.css' rel='stylesheet' type='text/css'>
      <!-- ====Favicons==== -->
      <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon">
      <link href="img/favicon.png" rel="icon" type="image/x-icon">
      <!-- ====Bootstrap Core CSS==== -->
      <link href="css/bootstrap.min.css" rel="stylesheet" type='text/css'>
     
      <link rel="stylesheet" href="./css/sweetalert2.min.css">


  
  <style>
        
      body{
        background-image: url("./img/fondoFactura.png");
      }

      #DivformLogin{
        background-color: rgba(249, 249, 249,0.5);
        height: 100%; 
        margin-left: 50%;
        transform: translateX(-50%);
        margin-top:10%;
       -webkit-box-shadow: 2px -1px 29px -4px rgba(0,0,0,0.37);
-moz-box-shadow: 2px -1px 29px -4px rgba(0,0,0,0.37);
box-shadow: 2px -1px 29px -4px rgba(0,0,0,0.37);
      
      padding-bottom: 2%;


      }

      #logoLogin{
          margin-left: 50%;
          transform: translateX(-50%);
          background-color: rgb(143, 174, 224);
          margin-bottom: 2%; 
      }

  </style>
</head>


<body>

    <div class="col-md-6" id="DivformLogin">
        
        <div class="col-md-11" id="logoLogin"  style="">
           
            <h1 style="text-align: center;">facturacion electronica</h1> 

        </div>

        <form action="" id="formLogin">
            <div class="col-md-12">
              <input class="form-control" type="text" id="UserLg"  placeholder="Ingrese su usuario">
  
              <input class="form-control" style="margin-top: 10px;" id="PassLg" type="text" placeholder="Ingrese la contraseña">
              
              </div>

              <input type="button" class="btn btn-info" value="Ingresar" onclick="Ingresar()" style="float: right; margin-top: 2%">  
          
        </form>
    </div>

</body>
 <script src="js/jquery-2.2.2.min.js"></script>
 <script src="js/sweetalert2.js"></script>
 <script src="js/login.js"></script>


      <!-- ====Bootstrap Core JavaScript==== -->
      <script src="js/bootstrap.min.js"></script>


</html>