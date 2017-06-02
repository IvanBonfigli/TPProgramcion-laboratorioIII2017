<?php
    /**
     * 
     */

     require "../php/AccesoDatos.php";
     
    class cochera
    {
        //Atributos
        private $piso;
        private $numero;
        private $estado; //Boolean 0 = desocupado, 1 = ocupado
        private $prioridad; //boolean 0 = sin prioridad, 1 = Discapacidad/Embarazo.

        //<---------constructor---------->
        function __construct($piso, $numero, $estado, $prioridad)
        {
            $this->piso = $piso;
            $this->numero = $numero;
            $this->estado = $estado;
            $this->prioridad = $prioridad;
        }

        //<---------Metodos---------->

        //<---------Geters----------->
        public function GetPiso()
        {
            return $this->piso;
        }

         public function GetNumero()
        {
            return $this->numero;
        }

         public function GetEstado()
        {
            return $this->estado;
        }

         public function GetPrioridad()
        {
            return $this->prioridad;
        }
        //<----------------------------->

        //<----------Setters------------->
        public function SetPiso($valor)
        {
            $this->piso = $valor;
        }

         public function SetNumero($valor)
        {
             $this->numero = $valor;
        }

         public function SetEstado($valor)
        {
             $this->estado = $valor;
        }

         public function SetPrioridad($valor)
        {
             $this->prioridad = $valor;
        }
        //<------------------------------>

        public function toString()
        {
            return $this->piso."-".$this->numero."-".$this->estado."-".$this->prioridad;
        }


        // <----------------Funciones de acceso a datos MYSQL---------------------->

        public function TraerCocheraSegunNumero($numero)
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT numero AS numero, piso AS piso, estado AS estado, prioridad AS prioridad FROM cochera WHERE numero = :numero");
            $consulta->execute(array(":numero" => $numero));

            $cocheraBuscado = array();

            $cocheraTodos = $consulta->fetchAll();

            foreach($cocheraTodos as $cochera)
            {
                $cocheraBuscado[] = new cochera ($cochera[0], $cochera[1], $cochera[2], $cochera[3]);
            }
            
            return $cocheraBuscado;
        }

        public function TraerTodosCochera()
        {
            $ObjetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $ObjetoAccesoDato->RetornarConsulta("SELECT numero AS numero, piso AS piso, estado AS estado, prioridad as prioridad FROM cochera");
            
            $consulta->execute();

            $cocheraBuscado = array();

            $cocheraTodos = $consulta->fetchAll();
            
            foreach($cocheraTodos as $cochera)
            {
                $cocheraBuscado[] = new cochera ($cochera[0], $cochera[1], $cochera[2], $cochera[3]);
            }

            return $cocheraBuscado;
        }

        public function Insertarcochera()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO cochera (numero, piso, estado, prioridad)"
                                                        . "VALUES(:numero, :piso, :estado, :prioridad)");
            
            $consulta->bindValue(':numero', $this->numero, PDO::PARAM_INT);
            $consulta->bindValue(':piso', $this->piso, PDO::PARAM_INT);
            $consulta->bindValue(':estado', $this->estado, PDO::PARAM_INT);
            $consulta->bindValue(':prioridad', $this->prioridad, PDO::PARAM_INT);

            return $consulta->execute();   
      }

        public static function Modificarcochera($numero, $piso, $estado, $prioridad)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE cochera SET numero = :numero, piso = :piso, 
                                                            estado = :estado, prioridad = :prioridad WHERE numero = :numero");
            
            $consulta->bindValue(':prioridad', $prioridad, PDO::PARAM_INT);
            $consulta->bindValue(':numero', $numero, PDO::PARAM_INT);
            $consulta->bindValue(':piso', $piso , PDO::PARAM_INT);
            $consulta->bindValue(':estado', $estado, PDO::PARAM_INT);

            return $consulta->execute();

        }

        public static function Eliminarcochera($numero)
        {

            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            
            $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM cochera WHERE numero = :numero");
            
            $consulta->bindValue(':numero', $numero, PDO::PARAM_INT);

            return $consulta->execute();

        }
        //<--------------------------------------------------------------------------------------->


    }
    
?>