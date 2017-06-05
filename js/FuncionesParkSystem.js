$(document).ready(function(){

    $("#LogOut").on("click", function(){
        $.post("../php/deslogearUsuario.php", function(){
            window.location.replace("../index.html");
        });
    })
})