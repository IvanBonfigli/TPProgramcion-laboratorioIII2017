$(document).ready(function(){

    $("#registrarsebtn").on("click", function(){
        window.location.replace("./html/RegistroUsuario.html");
    });

    $("#entrarbtn").on("click", function(){
        var usuario = $("#usr").val();
        var password = $("#pass").val();
        var datos = {
            usuario: usuario,
            password: password
        };

        DatosUsr = JSON.stringify(datos);

        $.post("./php/ValidarUsuario.php/validacion", {DatosUsr}, function(retorno){
        
            if(retorno.resp != "No-esta"){
                localStorage.setItem("Usr", usuario);	
                window.location.replace("./html/ParkSystem.php");
			}else
			{
				alert("usuario o clave incorrecta");	
			}
        });

    });
});