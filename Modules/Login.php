<?php

    require_once '../classes/Utilisateur.php';

    /* PERMETTRE LA CONNEXION AU SITE WEB */
    $utilisateur = Utilisateur::getUtilisateurFromLoginPwd($_GET['Email'], $_GET['Password']);
    if($utilisateur){
        $_SESSION['utilisateur'] = $utilisateur;
        header('Location: ../Pages/Klipay-Page2.php');
    }
    else{
        /* Si les identifiants ne sont pas valides */
        header('Location: ../Pages/Index.php');
    }
?>