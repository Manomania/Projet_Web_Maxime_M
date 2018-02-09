<?php
    require_once '../Classes/Utilisateur.php';
    session_start();
    $isOk = Utilisateur::insertUtilisateur($_POST['First_Name'],$_POST['Name'],$_POST['Email'],$_POST['Password'],$_POST['Date'],$_POST['Gender']);
    if($isOk){
        $_SESSION['Email']=$_POST['Email'];
        header ('Location: ../Pages/Index.php');
    }else{
        header ('Location: ../Pages/oouupsss.php');
    }
?>