$(document).ready(function(){

    $("#IngresoVeh").on("click", function(){

        $("#mostrarmodal").modal("show");
    });

    $("#cochera").on("click",function(){
        
        var dato = $("#prioridad").val();
        var opts;

        var jobject = {
            prioridad: dato
        };

        var ObjPrioridad = JSON.stringify(jobject);
        
        $.post("../php/AdministracionCochera.php/cochera", {ObjPrioridad}, function(retorno){
            
            retorno.forEach(function(element) {
                opts+= "<option value='"+element.numero+"'>Piso: "+element.piso+" Numero: "+element.numero+"</option>";
            });

            $("#cochera").html(opts);
        });
    });

    $("#LogOut").on("click", function(){
        $.post("../php/deslogearUsuario.php", function(){
            window.location.replace("../index.html");
        });
    });

    var Usr = localStorage.getItem("Usr");
    $("#UsrIcon").html(Usr);

});