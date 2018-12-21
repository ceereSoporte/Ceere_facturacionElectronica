<?php 

	session_start();

	include('../BD/conexion_sql_server.php');



    if (isset($_POST['submit'])) {
        
            echo 'entraste al controlador';
            $user =  $_POST['UserLg'];
            $password =  $_POST['PassLg']; 
            $conn = OpenConnection();


            global $usuario;
            global $contrasena;
            global $NombreDelUsuario;
            
            $consulta = "SELECT *  FROM  [Face Cnsta Login] 
                                WHERE [Face Cnsta Login].NombreUsuario ='".$user."' and  [Face Cnsta Login].passwordUsuario = '".$password."'";
            $ejecutar = sqlsrv_query($conn, $consulta);


            while ($row = sqlsrv_fetch_array($ejecutar)) {
                $usuario   = $row['NombreUsuario'];
                $contrasena = $row['passwordUsuario'];
                $NombreDelUsuario   = $row['NomUsuario'];
            }


            if (($usuario == $user) || ($contrasena == $password)) {
                $_SESSION['userName'] = $NombreDelUsuario;
                echo $_SESSION['userName'] ;
                header("location: ../principal.php"); 
            }else{
                header("location: ../"); 
     
            }

              

    }else{
        header("location: ../");
 	}


 ?>