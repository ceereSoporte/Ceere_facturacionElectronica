function Ingresar() {
	var Usuario = document.getElementById("UserLg").value;
    var Contrasena = document.getElementById("PassLg").value;


    dataString = 'UserLg=' + Usuario +'&PassLg='+ Contrasena;

    $.ajax({
        type: "POST",
        url: "controlador/controladorLogin.php",
        data: dataString,
        cache: false,
        dataType: "json",

        });
    .done(function(data) {
    	
     	 data.success;
   		 data.message;
 	})
 	


}
