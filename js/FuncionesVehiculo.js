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
                   console.log("cargado");
                }
                else
                {
                    console.log("error");
                }
                
        });

        var DatosEstacionar = {
            patente: patente,
            numero: cochera
        };

        var DatosCochera = JSON.stringify(DatosEstacionar);

        $.post("../php/ModificacionCochera.php/SetCochera", {DatosCochera}, function(retorno){
             
                if(retorno.codigo == 200)
                {
                    console.log("Bien");
                }
                else
                {
                    console.log("Error");
                }
        });
    });
    
});