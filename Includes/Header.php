<!DOCTYPE html>
<html>
    <head>
        <?php
        echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> Forum </title>';
        ?>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
        <link rel="icon" href="/Images/Favicon.ico" />
    </head>

    <?php
    //Les variables de session
    $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
    $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
    $pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
    //Introduction des paramètres
    include("./Includes/functions.php");
    include("./Includes/constants.php");
    ?>
    <body>
        <div class="Menu_id">
            <form action="./connexion.php" method="get">
                <table>
                    <tr>
                        <td>
                            <label for="pseudo">Pseudo </label>
                        </td>
                        <td>
                            <label for="password">Mot de passe </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="pseudo">
                        </td>
                        <td>
                            <input type="password" name="password">
                        </td>
                        <td>
                            <button type="submit" name="Submit">Connexion</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h5>Si vous n'avez pas de compte vous pouvez vous enregistrer <a href="register.php">ici</a></h5>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <!-- Nom du site -->
        <h1>Klipay</h1>
        
        <!-- Slogan -->
        <h2>Faites semblant d'avoir une vie interessante !</h2>