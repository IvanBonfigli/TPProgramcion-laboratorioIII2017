<?php 

    session_start();
    require "../Clases/empleado.php";
    require '../vendor/autoload.php';
    
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app = new \Slim\App;
    $app->post('/validacion', function (Request $request, Response $response) {

        $data = $request->getParsedBody();
        $retorno= array("resp" => "No-esta", "usr"=> "none");
        
        if(isset($data["DatosUsr"]))
        {
            $usrObj = json_decode($data["DatosUsr"]);
            $usuarios = empleado::TraerTodosLosEmpleado();
            foreach ($usuarios as $arr)
            {
                if($arr->GetUsuario()==$usrObj->usuario && $arr->GetPassword()==$usrObj->password)
                {	
                    $user = array("id"=> $arr->GetId(), "usuario"=> $arr->GetUsuario(), "password" => $arr->GetPassword(), "nombre" => $arr->GetNombre(), "apellido"=>$arr->GetApellido());
                    $_SESSION['registrado']=$user;
                    setcookie("inicio",$usrObj->usuario,  time()-36000 , '/');
                    $retorno["usr"]=$usrObj->usuario;
                    $retorno["resp"]="ingreso";
                    
                }
            } 
        }
        
       return $response->withJson($retorno);
});
    $app->run();
?>