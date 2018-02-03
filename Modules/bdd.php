<?php
    session_start();

    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Klipay;', 'root', 'root');
        $stmt = $bdd->prepare('INSERT INTO membres (Prénom, Nom, Email, Age, Sexe) VALUES (:Prénom, :Nom, :Email, :Age, :Sexe);');
        $stmt->bindValues(':Prénom', $_POST['First_Name'], PDO::PARAM_STR);
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
?>