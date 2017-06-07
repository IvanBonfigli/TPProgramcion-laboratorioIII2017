<?php

    require "../Clases/cochera.php";
    require '../vendor/autoload.php';
    
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    $app = new \Slim\App;
    
    $app->post('/cochera', function (Request $request, Response $response) {
             
            $data = $request->getParsedBody();
            $arrayCochera = array();
           
            if(isset($data["ObjPrioridad"]))
            {
                $usrObj = json_decode($data["ObjPrioridad"]);
                $CocheraObj = cochera::TraerTodosCochera();
                
                foreach($CocheraObj as $cochera)
                {
                    if($usrObj->prioridad == $cochera->GetPrioridad() && $cochera->GetEstado() == "0")
                    {
                        $ArrayJson= array("numero"=> $cochera->GetNumero(),
                            "prioridad"=> $cochera->GetPrioridad(),
                            "piso"=> $cochera->GetPiso(),
                            "estado"=> $cochera->GetEstado() 
                        );
                        $arrayCochera[] = $ArrayJson;
                    } 
                }
            }

        return $response->withJson($arrayCochera);
    });
    $app->run();

    

    
?>