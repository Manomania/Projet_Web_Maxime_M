<?php
    include('../Modules/bdd.php');

    class Message extends bdd{
        var $id;
        var $idUtilisateur;
        var $text;

        function __construct(){
        }

        /**
         * Permet la récupéra
         */
        public static function getMessageFromUtilisateur($idUtilisateur){
            $messages = array();
            $messages = new Message();
            $statement = $utilisateur->queryList('SELECT * FROM message WHERE idUtilisateur=? order by date desc', array($idUtilisateur));
            while( $result = $statement->fetch())
            {
                Message::fetchFromStatement($message,$result);
                $messages .= $message;
            }
            return $messages;
        }

        public static function insertUtilisateur($First_Name,$Name,$Email ,$Password ,$Date,$Gender){
            $utilisateur = new Utilisateur();
            $statement = $utilisateur->queryList('INSERT INTO membres (Prenom, Nom, Email, Mot_de_passe, Age, Sexe) VALUES (?, ?, ?, ?, ?, ?)',
            array($First_Name,$Name,$Email ,$Password ,$Date,$Gender));
            if($statement) return true;
            return false;
        }
        
        public function delete(){
            $statement = $utilisateur->queryList('delete membres where id = ?',
            array($this->id));
            if($statement) return true;
            return false;
        }
        private static function fetchFromStatement(Message  message, $statement){
        }
    }
?>