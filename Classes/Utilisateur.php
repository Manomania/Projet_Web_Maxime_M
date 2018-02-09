<?php
    include('../Modules/bdd.php');

    class Utilisateur extends bdd{
        var $id;
        var $Prenom;
        var $Nom;
        var $Email;
        var $Password;
        var $Age;
        var $Sexe;

        function __construct(){
            $this->id = 0;
            $this->Prenom = '';
            $this->Email = '';
            $this->Nom = '';
            $this->Password = '';
        }

        /**
         * Permet la récupéra
         */
        public static function getUtilisateurFromLoginPwd($Email, $Password){
            $utilisateur = new Utilisateur();
            $statement = $utilisateur->queryList('SELECT * FROM membres WHERE Email=? AND Mot_de_passe=?', array($Email, $Password));
            if($statement && $result = $statement->fetch())
            {
                Utilisateur::fetchFromStatement($utilisateur,$result);
                return $utilisateur;
            }
            return false;
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
        public  function  update($args)
        {
            $req = 'UPDATE membres SET Email =?, Mot_de_passe =?';
        }
        private static function fetchFromStatement(Utilisateur  $utilisateur, $statement){
            $utilisateur->id = $statement['id'];
            $utilisateur->Prenom = $statement['Prenom'];
            $utilisateur->Nom = $statement['Nom'];
            $utilisateur->Email = $statement['Email'];
            $utilisateur->Password = $statement['Mot_de_passe'];
        }
    }
?>