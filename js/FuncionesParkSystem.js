$(document).ready(function(){

    $("#LogOut").on("click", function(){
        $.post("../php/deslogearUsuario.php", function(){
            window.location.replace("../index.html");
        });
    });

    var Usr = localStorage.getItem("Usr");
    $("#UsrIcon").html(Usr);

    $("#IngresoVeh").on("click", function(){

        $("#mostrarmodal").modal("show");
        
    });

});