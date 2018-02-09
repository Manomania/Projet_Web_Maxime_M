<?php
    include('../Modules/bdd.php');

    class Utilisateur extends bdd{

        var $Prenom;
        var $Nom;
        var $Email;
        var $Password;
        var $Age;
        var $Sexe;
        function __construct(){
            $this->Email = '';
            $this->Nom = '';
            $this->Password = '';
        }
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
        public  function  update($args)
        {
            $req = 'UPDATE membres SET Email =?, Mot_de_passe =?';
        }
        private static function fetchFromStatement(Utilisateur  $utilisateur, $statement){
            $utilisateur->Prenom = $statement['Prenom'];
            $utilisateur->Nom = $statement['Nom'];
            $utilisateur->Email = $statement['Email'];
            $utilisateur->Password = $statement['Mot_de_passe'];
        }
    }
?>