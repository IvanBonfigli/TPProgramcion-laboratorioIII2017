<?php
    require "../Clases/empleado.php";
    require '../vendor/autoload.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;



    $app = new \Slim\App;
    $app->post('/register', function (Request $request, Response $response) {

            $data = $request->getParsedBody();
            $resp["codigo"] = 200;

            if(isset($data["DatosRegistro"]))
            {
                $usrObj = json_decode($data["DatosRegistro"]);

                $EmpleadoObj = new empleado ($usrObj->nombre, $usrObj->apellido, $usrObj->usuario, $usrObj->password);

                if (!$EmpleadoObj->InsertarEmpleado())
                {
                     $resp["codigo"] = 400;
                }
            }

        return $response->withJson($resp);
    });
    $app->run();




?>