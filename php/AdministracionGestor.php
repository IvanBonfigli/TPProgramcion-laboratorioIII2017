<?php
    require "../Clases/gestor.php";
    require '../vendor/autoload.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;



    $app = new \Slim\App;
    $app->post('/Reg', function (Request $request, Response $response) {

            session_start();
            $data = $request->getParsedBody();
            $resp["codigo"] = 400;
        
            if(isset($data["DatosCochera"]))
            {
                
                $usrObj = json_decode($data["DatosCochera"]);
                $localTime = localtime();
                $localTime = implode("-", $localTime);
                $objGestor = new gestor($localTime, "", $_SESSION["registrado"]["id"], 0, $usrObj->patente, 0);
                
                if ($objGestor->InsertarGestor())
                {
                    $resp["codigo"] = 200;
                }
            }

            if (isset($data["cocheraObj"]))
            {
                $coObj = json_decode($data["cocheraObj"]);
                $string = $coObj->patente;
                $patente = explode("-", $string);
                $localTime = localtime();
                $localTime = implode("-", $localTime);

            }

       return $response->withJson($resp);
    });
    $app->run();

?>