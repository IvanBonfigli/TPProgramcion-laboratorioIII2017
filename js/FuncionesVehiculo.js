$(document).ready(function(){

    $("#cargar").on("click", function(){
        
        var patente = $("#patente").val();
        var marca = $("#marca").val();
        var color = $("#color").val();
        var prioridad = $("#prioridad").val();
        var cochera = $("#cochera").val();

        var DatosJson =
        {
            patente: patente,
            marca: marca,
            color: color,
            prioridad: prioridad
        };

        var DatosVehiculo = JSON.stringify(DatosJson);

        $.post("../php/AdministracionVehiculo.php/ingreso", {DatosVehiculo}, function(retorno){
                if(retorno.codigo == 200)
                {
                   console.log("Vehiculo cargado con exito");
                }
                else
                {
                    console.log("Error al ingresar vehiculo");
                }
                
        });

        var DatosGestoria = {
            patente: patente,
            numero: cochera
        };

        var DatosGestor = JSON.stringify(DatosGestoria);

         $.post("../php/AdministracionGestor.php/Reg",{DatosGestor}, function(retorno){
            
            if (retorno.codigo != "error")
            {
                var idGestor = retorno.codigo;

                var DatosEstacionar = {
                    patente: patente,
                    numero: cochera,
                    idGestor: idGestor

                };

                var DatosCochera = JSON.stringify(DatosEstacionar);

                $.post("../php/ModificacionCochera.php/SetCochera", {DatosCochera}, function(retorno){
                    
                        if(retorno.codigo == 200)
                        {
                            location.reload();
                        }
                        else
                        {
                            console.log("Error al Ingresar cochera");
                        }
                });
            }
            else
            {
                console.log(retorno);
            }
        });

    });
    
});