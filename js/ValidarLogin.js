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

        $.post("./php/ValidarUsuario.php", {datos}, function(retorno){
            
            if(retorno!="No-esta"){	
			
			}else
			{
				$("#informe").html("usuario o clave incorrecta");	
				$("#formLogin").addClass("animated bounceInLeft");
			}
        })

    });
});