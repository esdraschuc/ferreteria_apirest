<?php 
    // Clase para establecer la conexión de la BD usando PDO
    class Conectar {
        protected $dbhost; // variable protegida reconocida en su clase

        // función para conectar la BD
        protected function conexion() {
            try {
                # $conectar = $this->dbhost = new PDO("mysql:host=localhost; dbname=ferreteria_apirest","root","");
                $conectar = $this->dbhost = new PDO("mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_e18b91cd779b6f5","b9063e116a63ca","cddf5742");
                return $conectar;
            } catch (Exception $e) {
                print "!!!Error : ".$e->getMessage()." <br>";
                die();
            }
        }

        // función para la codificación de caracteres UTF8
        public function set_names() {
            return $this->dbhost->query("SET NAMES 'utf8'");
        }

    }
?>