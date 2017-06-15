<?php
    require "../Clases/gestor.php";
    require '../vendor/autoload.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;



    $app = new \Slim\App;
    $app->post('/Reg', function (Request $request, Response $response) {

            session_start();
            $data = $request->getParsedBody();
            $resp["codigo"] = "error";
            
        
            if(isset($data["DatosGestor"]))
            {
                $usrObj = json_decode($data["DatosGestor"]);
                $localTime = localtime();
                $localTime = implode("-", $localTime);
                $objGestor = new gestor(0, $localTime, "", $_SESSION["registrado"]["id"], 0, $usrObj->patente, 0);
                
                if ($objGestor->InsertarGestor())
                {
                    $todos = gestor::TraerGestorSegunPatente($usrObj->patente);
                    foreach($todos as $arr)
                    {
                       
                        if ($arr->GetAcceso() == $localTime)
                        {
                            
                            $resp["codigo"] = $arr->GetId();
                        }
                    }
                }
                return $response->withJson($resp);
            }
           
            if (isset($data["cocheraObj"]))
            {
                
                $resp["codigo"] = 400;
                $coObj = json_decode($data["cocheraObj"]);
                $string = $coObj->patente;
                $datos = explode("-", $string);
                $laide = $datos[2];
                $localTime = localtime();
                $localTime = implode("-", $localTime);
                $Gestores = gestor::TraerGestorSegunId($laide);
                $objGestor = $Gestores[0];
                $monto = 0;
                
                    $HoraActual = localtime();
                    $HoraActual = ($HoraActual[5]+1900)."-".$HoraActual[4]."-".$HoraActual[3]." ".$HoraActual[2].":".$HoraActual[1].":".$HoraActual[0];
                    $HoraAnterior = explode("-", $objGestor->GetAcceso());
                    $HoraAnterior = ($HoraAnterior[5]+1900)."-".$HoraAnterior[4]."-".$HoraAnterior[3]." ".$HoraAnterior[2].":".$HoraAnterior[1].":".$HoraAnterior[0];

                    $MinutosTotales = ceil((strtotime($HoraActual)- strtotime($HoraAnterior))/60);
                    $HorasTotales;
                    
                    $decimal = explode(".",($MinutosTotales/60));
                    $decimal = "0".".".$decimal[1] + 0;
                    
                    if ($decimal <= 0.15)
                    {
                        $hora = floor($MinutosTotales/60);
                        $HorasTotales = $hora;
                    }
                    else
                    {
                            $hora = ceil($MinutosTotales/60);
                            $HorasTotales = $hora;
                    }
                    
                    if ($HorasTotales < 12)
                    {
                        $monto = $HorasTotales*10;
                    }
                    else if ($HorasTotales < 24)
                    {
                        $HorasTotales -= 12;

                        $monto =  90+($HorasTotales*10);
                    }
                    else
                    {
                        $diasHoras = ($HorasTotales/24);
                        $dias = explode(".", $diasHoras);
                        $dias = $dias[0];
                        $HorasRestantes = $HorasTotales - (24*$dias);

                        $monto =  170*$dias+($HorasRestantes*10);
                    }
               
                if(gestor::ModificarGestor($laide, $localTime, $objGestor->GetAcceso(), $objGestor->GetUsuario_acceso(), $_SESSION["registrado"]["id"], $datos[1], $monto))
                {
                    $resp["codigo"] = 200;
                }
                
                return $response->withJson($resp);
            }

            return $response->withJson($resp);
    });
    $app->run();

?>