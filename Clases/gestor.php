<?php
    require "../php/AccesoDatos.php";

    /**
     * 
     */
    class gestor 
    {
        private $acceso;
        private $salida;
        private $usuario;
        private $patente;
        private $monto;


        function __construct($acceso, $salida, $usuario, $patente, $monto)
        {
           $this->acceso = $acceso;
           $this->salida = $salida;
           $this->usuario = $usuario;
           $this->patente = $patente;
           $this->monto = $monto;
        }

         //<---------Metodos---------->

        //<---------Geters----------->
        public function GetAcceso()
        {
            return $this->acceso;
        }

         public function GetSalida()
        {
            return $this->salida;
        }

         public function GetUsuario()
        {
            return $this->usuario;
        }

         public function GetPatente()
        {
            return $this->patente;
        }

        public function GetMonto()
        {
            return $this->monto;
        }
        //<----------------------------->

        //<----------Setters------------->
        public function SetAcceso($valor)
        {
            $this->acceso = $valor;
        }

         public function SetSalida($valor)
        {
             $this->salida = $valor;
        }

         public function SetUsuario($valor)
        {
             $this->usuario = $valor;
        }

         public function SetPatente($valor)
        {
             $this->patente = $valor;
        }

        public function SetMonto($valor)
        {
            $this->monto = $valor;
        }
        //<------------------------------>

        public function toString()
        {
            return $this->acceso."-".$this->salida."-".$this->usuario."-".$this->patente."-".$this->monto;
        }


        // <----------------Funciones de acceso a datos MYSQL---------------------->

        public function TraerGestorSegunPatente($patente)
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT salida AS salida, acceso AS acceso, usuario AS usuario, patente AS patente, monto AS monto FROM gestor WHERE patente = :patente");
            $consulta->execute(array(":patente" => $patente));

            $gestorBuscado = array();

            $gestorTodos = $consulta->fetchAll();

            foreach($gestorTodos as $gestor)
            {
                $gestorBuscado[] = new gestor ($gestor[0], $gestor[1], $gestor[2], $gestor[3]), $gestor[4];
            }
            
            return $gestorBuscado;
        }

        public function TraerTodosGestor()
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT salida AS salida, acceso AS acceso, usuario AS usuario, patente as patente, monto AS monto FROM gestor");
            
            $consulta->execute();

            $gestorBuscado = array();

            $gestorTodos = $consulta->fetchAll();
            
            foreach($gestorTodos as $gestor)
            {
                $gestorBuscado[] = new gestor ($gestor[0], $gestor[1], $gestor[2], $gestor[3], $gestor[4]);
            }

            return $gestorBuscado;
        }

        public function InsertarGestor()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO gestor (salida, acceso, usuario, patente, monto)"
                                                        . "VALUES(:salida, :acceso, :usuario, :patente, :monto)");
            
            $consulta->bindValue(':salida', $this->salida, PDO::PARAM_INT);
            $consulta->bindValue(':acceso', $this->acceso, PDO::PARAM_INT);
            $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
            $consulta->bindValue(':patente', $this->patente, PDO::PARAM_STR);
            $consulta->bindValue(':monto', $this->monto, PDO::PARAM_INT);

            return $consulta->execute();   
      }

        public static function ModificarGestor($salida, $acceso, $usuario, $patente, $monto)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE gestor SET salida = :salida, acceso = :acceso, 
                                                            usuario = :usuario, patente = :patente, monto = :monto WHERE patente = :patente");
            
            $consulta->bindValue(':patente', $patente, PDO::PARAM_STR);
            $consulta->bindValue(':salida', $salida, PDO::PARAM_INT);
            $consulta->bindValue(':acceso', $acceso , PDO::PARAM_INT);
            $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
            $consulta->bindValue(':monto', $monto, PDO::PARAM_INT);

            return $consulta->execute();

        }

        public static function EliminarGestor($patente)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM gestor WHERE patente = :patente");
            
            $consulta->bindValue(':patente', $patente, PDO::PARAM_STR);

            return $consulta->execute();

        }
        //<--------------------------------------------------------------------------------------->




    }
    
?>