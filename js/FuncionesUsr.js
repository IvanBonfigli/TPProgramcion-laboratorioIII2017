$(document).ready(function(){

    $("#Registrarse").on("click", function(){
        var name = $("#nombre").val();
        var apellido = $("#apellido").val();
        var user = $("#user").val();
        var password = $("#pass").val();

        var datosUsr =
        {
            nombre: name,
            apellido: apellido,
            usuario: user,
            password: password
        };

        DatosRegistro = JSON.stringify(datosUsr);

        $.post("../php/AdministracionUsr.php/register",{DatosRegistro}, function(retorno){
            if(retorno.codigo == 200)
            {
                alert ("Usuario Cargado");
            }
            else
            {
                alert ("Error");
            }
            
        });
    });


});