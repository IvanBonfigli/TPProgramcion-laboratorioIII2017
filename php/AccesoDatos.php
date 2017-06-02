<?php
    class AccesoDatos
    {
        private static $ObjetoAccesoDatos;
        private $ObjetoPDO;

        private function __construct()
        {
            try
            {
                $this->ObjetoPDO = new PDO ('mysql:host=localhost; dbname=parksystem; charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $this->ObjetoPDO->exec("SET CHARACTER SET utf8");
            }
            catch(PDOException $e)
            {
                print "Error!: ".$e->getMessage();
                die();
            }
        }

        public static function dameUnObjetoAcceso()
        {
            if(!isset(self::$ObjetoAccesoDatos))
            {
                self::$ObjetoAccesoDatos = new AccesoDatos();
            }
            return self::$ObjetoAccesoDatos;
        }

        public function retornarConsulta($sql)
        {
            return $this->ObjetoPDO->prepare($sql);
        }

        public function __clone()
        {
            trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
        }

    }


?>