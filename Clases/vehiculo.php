<?php
    /**
     * 
     */

     require "../php/AccesoDatos.php";
     
    class vehiculo
    {
        //Atributos
        private $patente;
        private $color;
        private $marca;
        private $prioridad; //boolean 0 = sin prioridad, 1 = Discapacidad/Embarazo.

        //<---------constructor---------->
        function __construct($patente, $color, $marca, $prioridad)
        {
            $this->patente = $patente;
            $this->color = $color;
            $this->marca = $marca;
            $this->prioridad = $prioridad;
        }

        //<---------Metodos---------->

        //<---------Geters----------->
        public function GetPatente()
        {
            return $this->patente;
        }

         public function GetColor()
        {
            return $this->color;
        }

         public function GetMarca()
        {
            return $this->Marca;
        }

         public function GetPrioridad()
        {
            return $this->prioridad;
        }
        //<----------------------------->

        //<----------Setters------------->
        public function SetPatente($valor)
        {
            $this->patente = $valor;
        }

         public function SetColor($valor)
        {
             $this->color = $valor;
        }

         public function SetMarca($valor)
        {
             $this->marca = $valor;
        }

         public function SetPrioridad($valor)
        {
             $this->prioridad = $valor;
        }
        //<------------------------------>

        public function toString()
        {
            return $this->patente."-".$this->color."-".$this->marca."-".$this->prioridad;
        }

        // <----------------Funciones de acceso a datos MYSQL---------------------->

        public function TraerVehiculoSegunPatente($patente)
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT patente AS patente, color AS color, marca AS marca, prioridad AS prioridad FROM vehiculo WHERE patente = :patente");
            $consulta->execute(array(":patente" => $patente));

            $VehiculoBuscado = array();

            $VehiculoTodos = $consulta->fetchAll();

            foreach($VehiculoTodos as $Vehiculo)
            {
                $VehiculoBuscado[] = new Vehiculo ($Vehiculo[0], $Vehiculo[1], $Vehiculo[2], $Vehiculo[3]);
            }
            
            return $VehiculoBuscado;
        }

        public function TraerTodosLosVehiculo()
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT patente AS patente, color AS color, marca AS marca, prioridad as prioridad FROM vehiculo");
            
            $consulta->execute();

            $VehiculoBuscado = array();

            $VehiculoTodos = $consulta->fetchAll();
            
            foreach($VehiculoTodos as $Vehiculo)
            {
                $VehiculoBuscado[] = new Vehiculo ($Vehiculo[0], $Vehiculo[1], $Vehiculo[2], $Vehiculo[3]);
            }

            return $VehiculoBuscado;
        }

        public function InsertarVehiculo()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO vehiculo (patente, color, marca, prioridad)"
                                                        . "VALUES(:patente, :color, :marca, :prioridad)");
            
            $consulta->bindValue(':patente', $this->patente, PDO::PARAM_STR);
            $consulta->bindValue(':color', $this->color, PDO::PARAM_STR);
            $consulta->bindValue(':marca', $this->marca, PDO::PARAM_STR);
            $consulta->bindValue(':prioridad', $this->prioridad, PDO::PARAM_INT);

            return $consulta->execute();   
      }

        public static function ModificarVehiculo($patente, $color, $marca, $prioridad)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE vehiculo SET patente = :patente, color = :color, 
                                                            marca = :marca, prioridad = :prioridad WHERE patente = :patente");
            
            $consulta->bindValue(':prioridad', $prioridad, PDO::PARAM_INT);
            $consulta->bindValue(':patente', $patente, PDO::PARAM_STR);
            $consulta->bindValue(':color', $color , PDO::PARAM_STR);
            $consulta->bindValue(':marca', $marca, PDO::PARAM_STR);

            return $consulta->execute();

        }

        public static function EliminarVehiculo($patente)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM vehiculo WHERE patente = :patente");
            
            $consulta->bindValue(':patente', $patente, PDO::PARAM_STR);

            return $consulta->execute();

        }
        //<--------------------------------------------------------------------------------------->

    }
    
?>