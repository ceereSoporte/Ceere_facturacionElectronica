
 <?php
   

function OpenConnection() 
{ 
    try 
    { 
        $serverName = "LENOVO2\SQLEXPRESS";
        $connectionOptions = array("Database"=>"IQ02082018Facturacion"); //"Uid"=>"usuario del SQL", "PWD"=>"El PAsword" por si tiene contrasena
        $conn = sqlsrv_connect($serverName, $connectionOptions); 
        return $conn;
    
    } 
    catch(Exception $e) 
    { 
        echo("Error!"); 
    } 
} 



 ?>
