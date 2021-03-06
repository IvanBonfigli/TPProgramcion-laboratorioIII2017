<?php
    session_start();

    if(!isset($_SESSION["registrado"]))
    {
        header("location: ../index.php");
    }
?>
<html>    
    <head>
        <title>BlogApp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet"> 
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><script src="../bower_components/bootstrap-validator/dist/validator.min.js"></script>
        <link rel="stylesheet" href="../css/estilos.css">
        <script type="text/javascript" src="../js/FuncionesParkSystem.js"></script>
        <script type="text/javascript" src="../js/FuncionesVehiculo.js"></script>
    </head>
    <body>
      <div class="container-fluid">
            <div class="row" id="header">
                    <nav id="banner" class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom: 0px;">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="#" id="UsrIcon">Unknown</a>
                                <button id="DespBtn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex6-collapse" aria-expanded="false">
                                    <span class="sr-only">Desplegar navegación</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar btn-block"></span>
                                </button>
                            </div>
                            <div id="MenuBtn" class="navbar-collapse collapse navbar-ex6-collapse" aria-expanded="false" style="height: 1px;">
                                <ul class="nav navbar-nav">
                                <li><a href="#">Inicio</a></li>
                                <li><a href="#postCont">Cocheras</a></li>
                                <li><a href="#ContactContainer">Problemas?</a></li>
                                </ul>
                                <button id="IngresoVeh" class="btn btn-primary navbar-btn" style="margin-bottom: 0px">Inresar Vehiculo</button>
                                <button id="LogOut" class="btn btn-danger navbar-btn" style="margin-bottom: 0px;">Logg Out</button>
                            </div>
                    </nav>
                </div>
                <div id="home" class="intro hero-bg col-lg-offset-1 col-md-offset-1 col-sm-12 col-md-10 col-lg-10 col-xs-12">  
                    <div id="TextTitle">
                        <h1 id="HomeTitle" class="text-center"><strong> ParkSystem </strong></h1>
                        <center><hr id="hrHome"></center>
                        <p  class="text-center" id="HomeSubTitle">Never been so easy</p>
                    </div>
                </div>
                <div id="postCont" class="col-lg-offset-1 col-md-offset-1 col-sm-12 col-md-10 col-lg-10 col-xs-12">
                    <div id="content">
                        <div id="contentHeader">
                            <h1 class="text-center" style="margin: 0px;">COCHERAS</h1>
                            <hr class="hrCont">
                        </div>
                        <button class='btn btn-danger btn-block' id="terminar">Terminar</button>
                    </div>
                </div>
                <div class="modal fade" id="carga" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"> 
                    <div align="center" style="margin-top: 250px;"><img class="img-responsive img-center" src='../img/ajax_loader.gif' style='width: 10%;'></div>
                </div>
                <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3>Ingreso Vehiculo</h3>
                                </div>
                            <div class="modal-body">
                                <input type="text" class="form-control" id="marca" placeholder="MARCA"  required/>
                                <input type="text" class="form-control" id="color" placeholder="COLOR" required/>
                                <input type="text" class="form-control" id="patente" placeholder="PATENTE" required />
                                <select id="prioridad" class="form-control">
                                    <option value="1">Prioridad</option>
                                    <option value="0" selected>Sin Prioridad</option>
                                </select>
                                 <select id="cochera" class="form-control">
                                    
                                </select>
                            </div>
                                <div class="modal-footer">
                                    <button id="cargar" class="btn btn-primary btn-block" data-dismiss="modal">Guardar</button>
                                </div>
                            </div>
                        </div>
                </div>
                <div id="ContactContainer" class="col-lg-offset-1 col-md-offset-1 col-sm-12 col-md-10 col-lg-10 col-xs-12">                   
                    <h1 class="text-center" style="margin: 0px; padding-top: 50px;">Reportar Problema</h1>
                    <hr class="hrCont">
                   <div class="col-lg-offset-2 col-sm-12 col-md-6 col-lg-4 col-xs-12">
                        <input class="form-control" type"text" id="nametxt" style="margin:5px;"  placeholder="Name" required>
                        <input class="form-control" type"email" id="mailtxt" placeholder="E-Mail" style="margin:5px;" required>
                        <input class="form-control" type="tel" id="numbertxt" style="margin:5px;" placeholder="Phone Number">
                        <textarea class="form-control" id="message" placeholder="Message"  rows="5" require></textarea>
                        <button class="btn btn-primary btn-block" style="margin:5px;" id="send-btn">Send</button>  
                    </div>
                    <p class="col-sm-12 col-md-6 col-lg-4 col-xs-12" id="message-parraf"><strong> Por favor reportar cualquier problema que tenga con el sistema web, nos pondremos en contacto con usted lo antes posible.</strong></p>
                </div>
            </div>
            <div id="AboutPage" class="container-fluid col-sm-12 col-md-12 col-lg-12 col-xs-12">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12 text-center">
                        <h1>ABOUT THIS PAGE</h1>
                        <p><strong>This application was made by Ivan Bonfigli</strong></p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12 text-center">
                        <h1>AROUND THE WEB</h1>
                        <ul style="list-style:none;">
                            <li class="SocialLi"><a rel="nofollow" class="button social" href="#"><i class="fa fa-fw fa-linkedin" style="font-size: 36px; color: white;"></i></a></li>
                            <li class="SocialLi"><a rel="nofollow" class="button social" href="#"><i class="fa fa-fw fa-github" style="font-size: 36px; color: white;"></i></a></li>
                            <li class="SocialLi"><a rel="nofollow" class="button social" href="#"><i class="fa fa-fw fa-instagram" style="font-size: 36px; color: white;"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <footer>
                <p class="text-center" style="background-color:black; color:white; margin:0px;">IvanBonfigli © 2017.</p>
            </footer>
    </body>
</html>