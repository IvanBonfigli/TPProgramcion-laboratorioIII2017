$(document).ready(function(){

    $("#cargar").on("click", function(){
        
        var patente = $("#patente").val();
        var marca = $("#marca").val();
        var color = $("#color").val();
        var prioridad = $("#prioridad").val();

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
                    alert("cargado");
                }
                else
                {
                    alert("error");
                }
                
        })
    })
    
})