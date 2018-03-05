<?php

//Lorsque une erreur se produit, ce message apparait.
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur s\'est produite';
   exit('<p>'.$mess.'</p>
   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body></html>');
}

// Lors de l'inscription l'avatar chargé est déplacé dans le fichier Avatars
function move_avatar($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "./Images/Avatars/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}

//Lors de l'accès à une page, une vérification est en place
function verif_auth($auth_necessaire)
{
    $level=(isset($_SESSION['level']))?$_SESSION['level']:1;
    return ($auth_necessaire <= intval($level));
}
if(verif_auth(2))
{
    //Afficher le forum si on est minimum inscrit
}
else
{
    //N'affiche pas le forum si non inscrit
}

?>
