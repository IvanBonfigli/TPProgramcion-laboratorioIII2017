<?php
    /**
     * 
     */

     require "../php/AccesoDatos.php";

    class empleado
    {
        //Atributos
        private $id;
        private $nombre;
        private $apellido;
        private $usuario;
        private $password;
         

        //<---------constructor---------->
        function __construct($nombre, $apellido, $usuario, $password)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->usuario = $usuario;
            $this->password = $password;
        }

        //<---------Metodos---------->

        //<---------Geters----------->
        public function GetId()
        {
            return $this->id;
        }

         public function GetNombre()
        {
            return $this->nombre;
        }

         public function GetApellido()
        {
            return $this->apellido;
        }

         public function GetUsuario()
        {
            return $this->usuario;
        }
        public function GetPassword()
        {
            return $this->password;
        }
        //<----------------------------->

        //<----------Setters------------->

         public function SetNombre($valor)
        {
             $this->nombre = $valor;
        }

         public function SetApellido($valor)
        {
             $this->apellido = $valor;
        }

         public function SetUsuario($valor)
        {
             $this->usuario = $valor;
        }

        public function SetPassword($valor)
        {
            $this->password = $valor;
        }
        //<------------------------------>

        public function toString()
        {
            return $this->$this->nombre."-".$this->apellido."-".$this->usuario."-".$this->password;
        }

        // <----------------Funciones de acceso a datos MYSQL---------------------->

        public static function TraerEmpleadoSegunId($id)
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT nombre AS nombre, apellido AS apellido, usuario AS usuario, password AS password FROM empleado WHERE id = :id");
            $consulta->execute(array(":id" => $id));

            $EmpleadoBuscado = array();

            $EmpleadoTodos = $consulta->fetchAll();

            foreach($EmpleadoTodos as $Empleado)
            {
                $EmpleadoBuscado[] = new Empleado ($Empleado[0], $Empleado[1], $Empleado[2], $Empleado[3]);
            }
            
            return $EmpleadoBuscado;
        }

        public static function TraerTodosLosEmpleado()
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT nombre AS nombre, apellido AS apellido, usuario AS usuario, password as password FROM empleado");
            
            $consulta->execute();

            $EmpleadoBuscado = array();

            $EmpleadoTodos = $consulta->fetchAll();
            
            foreach($EmpleadoTodos as $Empleado)
            {
                $EmpleadoBuscado[] = new Empleado ($Empleado[0], $Empleado[1], $Empleado[2], $Empleado[3]);
            }

            return $EmpleadoBuscado;
        }

        public function InsertarEmpleado()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO empleado (nombre, apellido, usuario, password)"
                                                        . "VALUES(:nombre, :apellido, :usuario, :password)");
            
            $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
            $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
            $consulta->bindValue(':password', $this->password, PDO::PARAM_STR);

           return  $consulta->execute();   
      }

        public static function ModificarEmpleado($id, $nombre, $apellido, $usuario, $password)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE empleado SET nombre = :nombre, apellido = :apellido, 
                                                            usuario = :usuario, password = :password WHERE id = :id");
            
            $consulta->vindValue(':id', $id, PDO::PARAM_INT);
            $consulta->bindValue(':password', $password, PDO::PARAM_STR);
            $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido', $apellido , PDO::PARAM_STR);
            $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);

            return $consulta->execute();

        }

        public static function EliminarEmpleado($id)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM empleado WHERE id = :id");
            
            $consulta->bindValue(':id', $id, PDO::PARAM_INT);

            return $consulta->execute();

        }
        //<--------------------------------------------------------------------------------------->
    }
    
?>