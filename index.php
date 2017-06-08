<?php
    session_start();

    if(isset($_SESSION["registrado"]))
    {
        header('location: ./html/ParkSystem.php');
    }
?>
<html>    
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
        <script src="./bower_components/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="./bower_components/bootstrap-validator/dist/validator.min.js"></script>
        <link rel="stylesheet" href="./css/estilos.css">
        <script type="text/javascript" src="./js/ValidarLogin.js"></script>
    </head>
    <body>
        <div class="container-fluid" id="contenedor">
            <div class="row">
                <div class="text-center" >
                        <h3 style="margin: 0%;">Park-System</h3>
                        <h1 id="MainTitle" style="margin-top: 10px;">INICIAR SESIÓN</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-4  col-md-offset-4 col-sm-offset-1 col-xs-offset-1 col-sm-10 col-md-4 col-lg-4 col-xs-10">
                    <img class="img-responsive" id="logo" src="./img/d8d47af9059b6b3f12e47ea6014c966d.png">
                </div>
            </div>
            <div class="row" id="login">
                <div class="col-lg-offset-4  col-md-offset-4 col-sm-12 col-md-4 col-lg-4 col-xs-12" style='padding-left: 0px;padding-right: 0px;' >
                <input type="text" class="form-control" name="usr" id="usr" placeholder="Usuario" required>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required>
                <button class="btn btn-primary btn-block" name="entrar" id="entrarbtn" style="margin-bottom: 5px;">Ingresar</button>
                <button class="btn btn-primary btn-block" id="registrarsebtn">Registrarse</button>
                </div>
            </div>
        </div>
        <footer>
            <h6 class="text-center">Coded by Ivan Bonfigli 2017</h6>
        </footer>
    </body>
</html>