<?php
    require_once"../Clases/vehiculo.php";
    require '../vendor/autoload.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;



    $app = new \Slim\App;
    $app->post('/eliminar', function (Request $request, Response $response) {

            $data = $request->getParsedBody();
            $resp["codigo"] = 400;

            if(isset($data["cocheraObj"]))
            {
                $coObj = json_decode($data["cocheraObj"]);
                $string = $coObj->patente;
                $patente = explode("-", $string);

                if(vehiculo::EliminarVehiculo($patente[1]))
                {
                    $resp["codigo"] = 200;
                }

            }

        return $response->withJson($resp);
    });
    $app->run();

?>