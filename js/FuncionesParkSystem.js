$(document).ready(function(){
    
    //<-----------Muestro las cocheras ocupadas en el inicio-------------------->
    $.post("../php/MostrarCocheras.php/ShowCocheras", function(retorno){
        
            var opts;

            retorno.forEach(function(element){
                opts+= "<div id='publicacion' style='background-color: white;'class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>" +
                "<label><input type='radio' class='DC'name='select' value='"+element.numero+"'>Seleccionar</label>"+
                "<h2>Cochera: " + element.numero+ "</h2>" +
                 "<h2>Piso: " + element.piso + "</h2>"+
                "<h2>Tipo: " + element.prioridad + "</h2>"+
                "<h2>Patente: " + element.patente +"</h2>"+
                "</div>";
            });

            $("#contentHeader").after(opts);
    });
    //<--------------------------------------------------------------------------->

    //Muestro el Modal para cargar vehiculo.
    $("#IngresoVeh").on("click", function(){

        $("#mostrarmodal").modal("show");
    });
    //<--------------------------------------->

    //Traigo al SELECT del Modal todas las cocheras disponibles segun la prioridad seleccionada.
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
    //<-------------------------------------------------------------------------------------------------->

    //<----------------Deslogeo---------------------------->
    $("#LogOut").on("click", function(){
        $.post("../php/deslogearUsuario.php", function(){
            window.location.replace("../index.php");
        });
    });
    //<--------------------------------------------------------->


    //<---------Nombre de usuario en barra de navegacion------------>
    var Usr = localStorage.getItem("Usr");
    $("#UsrIcon").html(Usr);
    //<------------------------------------------------------------->

    //<------------Sacara Vehiculos--------------->
    $("#terminar").on("click",function(){
        var cochera = $("input[type=radio][name=select]:checked").val();

        var obj = {
            numero: cochera
        };

        cocheraObj = JSON.stringify(obj);

        $.post("../php/ModificacionCochera.php/SetCochera", {cocheraObj}, function(retorno){
            if(retorno.codigo = 200)
            {
                console.log("Auto salio con exito");
            }
            else{
                console.log("Error");
            }
        });

        location.reload(); 
    });
    //<--------------------------------------------->

});