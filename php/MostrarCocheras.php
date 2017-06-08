<?php
    require "../Clases/cochera.php";
    require '../vendor/autoload.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;



    $app = new \Slim\App;
    $app->post('/ShowCocheras', function (Request $request, Response $response) {

        $data = $request->getParsedBody();
        $CocheraObj = cochera::TraerCocheraSegunEstado("1");
            
    
                foreach ($CocheraObj as $cochera) {
                    if($cochera->GetPrioridad()== "0")
                    {
                        $ArrayJson= array("numero"=> $cochera->GetNumero(),"piso"=> $cochera->GetPiso(), "prioridad"=>"Sin Prioridad", "patente"=>$cochera->GetPatente());
                    }
                    else
                    {
                        $ArrayJson= array("numero"=> $cochera->GetNumero(),"piso"=> $cochera->GetPiso(), "prioridad"=>"Con Prioridad", "patente"=>$cochera->GetPatente());
                    }
                    
                    $ArrayCochera[] = $ArrayJson;
                }
           

                return $response->withJson($ArrayCochera);
    });
    $app->run();




?>