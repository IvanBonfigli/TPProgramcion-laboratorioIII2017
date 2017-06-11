<?php

    require "../Clases/cochera.php";
    require '../vendor/autoload.php';
    
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    $app = new \Slim\App;

    $app->post('/SetCochera', function (Request $request, Response $response) {
                
                $data = $request->getParsedBody();
                
            
                if(isset($data["DatosCochera"]))
                {
                    $resp["codigo"] = 400;

                    $usrObj = json_decode($data["DatosCochera"]);
                    $CocheraObj = cochera::TraerCocheraSegunNumero($usrObj->numero);
                    
                    if (cochera::ModificarCochera($usrObj->numero, "1", $CocheraObj[0]->GetPrioridad(), $usrObj->patente))
                    {
                        $resp["codigo"] = 200;
                    }

                    return $response->withJson($resp);
                }

                if (isset($data["cocheraObj"]))
                {
                   $resp["codigo"] = 400;

                    $usrObj = json_decode($data["cocheraObj"]);
                    $string = $usrObj->patente;
                    $numero = explode("-", $string);
                    var_dump($numero);
                    $CocheraObj = cochera::TraerCocheraSegunNumero($numero[0]);
                    
                    if (cochera::ModificarCochera($numero[0], "0", $CocheraObj[0]->GetPrioridad(), ""))
                    {
                        $resp["codigo"] = 200;
                    }

                    return $response->withJson($resp);

                }
        });
        $app->run();

?>