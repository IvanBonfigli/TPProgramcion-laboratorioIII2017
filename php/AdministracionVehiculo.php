<?php
    require "../Clases/vehiculo.php";
    require '../vendor/autoload.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;



    $app = new \Slim\App;
    $app->post('/ingreso', function (Request $request, Response $response) {

            $data = $request->getParsedBody();
            $resp["codigo"] = 200;

            if(isset($data["DatosVehiculo"]))
            {
                $VehObj = json_decode($data["DatosVehiculo"]);

                $VehiculoObj = new vehiculo ($VehObj->patente, $VehObj->color, $VehObj->marca, $VehObj->prioridad);

                if (!$VehiculoObj->InsertarVehiculo())
                {
                     $resp["codigo"] = 400;
                }
            }

        return $response->withJson($resp);
    });
    $app->run();




?>