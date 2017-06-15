<?php
    require "../php/AccesoDatos.php";

    /**
     * 
     */
    class gestor 
    {
        private $acceso;
        private $salida;
        private $usuario_acceso;
        private $usuario_salida;
        private $patente;
        private $monto;
        private $id;


        function __construct($id, $acceso, $salida, $usuario_acceso,$usuario_salida, $patente, $monto)
        {
           $this->id = $id;
           $this->acceso = $acceso;
           $this->salida = $salida;
           $this->usuario_acceso = $usuario_acceso;
           $this->usuario_salida = $usuario_salida;
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

         public function GetUsuario_acceso()
        {
            return $this->usuario_acceso;
        }

        public function GestUsuario_salida()
        {
            return $this->usuario_salida;
        }

         public function GetPatente()
        {
            return $this->patente;
        }

        public function GetMonto()
        {
            return $this->monto;
        }

        public function GetId()
        {
            return $this->id;
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

         public function SetUsuario_acceso($valor)
        {
             $this->usuario_acceso = $valor;
        }

        public function SetUsuario_salida($valor)
        {
             $this->usuario_salida = $valor;
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
            return $this->acceso."-".$this->salida."-".$this->usuario_acceso."-".$this->usuario_salida."-".$this->patente."-".$this->monto;
        }


        // <----------------Funciones de acceso a datos MYSQL---------------------->

        public static function TraerGestorSegunPatente($patente)
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT id AS id, acceso AS acceso, salida AS salida,  usuario_acceso AS usuario_acceso, patente AS patente, monto AS monto, usuario_salida AS usuario_salida FROM gestor WHERE patente = :patente");
            $consulta->execute(array(":patente" => $patente));

            $gestorBuscado = array();

            $gestorTodos = $consulta->fetchAll();

            foreach($gestorTodos as $gestor)
            {
                $gestorBuscado[] = new gestor($gestor[0], $gestor[1], $gestor[2], $gestor[3], $gestor[4], $gestor[5], $gestor[6]);
            }
            
            return $gestorBuscado;
        }

        public static function TraerGestorSegunId($id)
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT id AS id, acceso AS acceso, salida AS salida,  usuario_acceso AS usuario_acceso, patente AS patente, monto AS monto, usuario_salida AS usuario_salida FROM gestor WHERE id = :id");
            $consulta->execute(array(":id" => $id));

            $gestorBuscado = array();

            $gestorTodos = $consulta->fetchAll();

            foreach($gestorTodos as $gestor)
            {
                $gestorBuscado[] = new gestor($gestor[0], $gestor[1], $gestor[2], $gestor[3], $gestor[4], $gestor[5], $gestor[6]);
            }
            
            return $gestorBuscado;
        }

        public static function TraerTodosGestor()
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT id AS id, acceso AS acceso, salida AS salida,  usuario_acceso AS usuario_acceso, usuario_salida AS usuario_salida, patente as patente, monto AS monto FROM gestor");
            
            $consulta->execute();

            $gestorBuscado = array();

            $gestorTodos = $consulta->fetchAll();
            
            foreach($gestorTodos as $gestor)
            {
                $gestorBuscado[] = new gestor ($gestor[0], $gestor[1], $gestor[2], $gestor[3], $gestor[4], $gestor[5], $gestor[6]);
            }

            return $gestorBuscado;
        }

        public function InsertarGestor()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO gestor (salida, acceso, usuario_acceso, usuario_salida, patente, monto)"
                                                        . "VALUES(:salida, :acceso, :usuario_acceso, :usuario_salida, :patente, :monto)");
            
            $consulta->bindValue(':salida', $this->salida, PDO::PARAM_STR);
            $consulta->bindValue(':acceso', $this->acceso, PDO::PARAM_STR);
            $consulta->bindValue(':usuario_acceso', $this->usuario_acceso, PDO::PARAM_INT);
            $consulta->bindValue(':usuario_salida', $this->usuario_salida, PDO::PARAM_INT);
            $consulta->bindValue(':patente', $this->patente, PDO::PARAM_STR);
            $consulta->bindValue(':monto', $this->monto, PDO::PARAM_INT);

            return $consulta->execute();   
      }

        public static function ModificarGestor($id, $salida, $acceso, $usuario_acceso, $usuario_salida, $patente, $monto)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE gestor SET salida = :salida, acceso = :acceso, 
                                                            usuario_acceso = :usuario_acceso, usuario_salida = :usuario_salida, patente = :patente, monto = :monto WHERE id = :id");
            
            $consulta->bindValue(':patente', $patente, PDO::PARAM_STR);
            $consulta->bindValue(':salida', $salida, PDO::PARAM_STR);
            $consulta->bindValue(':acceso', $acceso , PDO::PARAM_STR);
            $consulta->bindValue(':usuario_acceso', $usuario_acceso, PDO::PARAM_INT);
            $consulta->bindValue(':usuario_salida', $usuario_salida, PDO::PARAM_INT);
            $consulta->bindValue(':monto', $monto, PDO::PARAM_INT);
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);

            return $consulta->execute();

        }

        public static function EliminarGestor($id)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM gestor WHERE id = :id");
            
            $consulta->bindValue(':id', $id, PDO::PARAM_STR);

            return $consulta->execute();

        }
        //<--------------------------------------------------------------------------------------->




    }
    
?>