<?php
    abstract class bdd{
        const USERNAME="root";
        const PASSWORD="root";
        const HOST="localhost";
        const DB="Klipay";
    
        /* PERMETTRE LA CONNEXION AU SERVEUR MYSQL */
        private function getConnection(){
            $username = self::USERNAME;
            $password = self::PASSWORD;
            $host = self::HOST;
            $db = self::DB;
            $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
            return $connection;
            if ($connection->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        /* PERMETTRE UNE SECURITE AU SITE WEB */
        protected function queryList($sql, $args){
            $connection = $this->getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }
    }
?>