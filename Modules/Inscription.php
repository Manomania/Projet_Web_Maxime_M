<?php
    $bdd = new PDO('mysql:host=localhost;dbname=Klipay;charset=utf8', 'root', 'root');
    $req = $bdd->prepare('INSERT INTO membres (Prenom, Nom, Email, Mot_de_passe, Age, Sexe) VALUES (?, ?, ?, ?, ?, ?);');
    $req->execute(array($_POST['First_Name'],$_POST['Name'],$_POST['Email'],$_POST['Password'],$_POST['Date'],$_POST['Gender']));
    $_SESSION['Email']=$_POST['Email'];
    header ('Location: ../Pages/Index.php');
?>