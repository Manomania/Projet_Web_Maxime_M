<?php
    include('../Modules/bdd.php'); 
    require_once('../Modules/Header.php');
    session_start ();
?>

<body>

    <h1>Klipay</h1>

    <!-- FORMULAIRE CONNEXION -->
    <div class="Menu_id">
        <form action="../Modules/Login.php" method="get">
            <table>
                <tr>
                    <td>
                        <label for="Email">Adresse e-mail </label>
                    </td>
                    <td>
                        <label for="Mot_de_passe">Mot de passe </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="Email">
                    </td>
                    <td>
                        <input type="password" name="Password">
                    </td>
                    <td>
                        <button type="submit" name="Submit">Connexion</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- SLOGAN -->
    <h2>Klipay : faites semblant d’avoir une vie intéressante !</h2>

    <!-- FORUM OU AUTRE (A modifier) -->
    <div class="Moments">
        <!-- Tous les forums seront en prévisualisation ici -->
    </div>

    <!-- Inscription -->
    <div class="Inscription">
        <form action="../Modules/Inscription.php" method="post">
            <div class="Formulaire">
                <table>
                    <header>
                        <h3 class="Inscription-header">INSCRIPTION</h3>
                    </header>
                    <tr>
                        <td>
                            <input type="text" name="First_Name" placeholder="Entrez votre prénom">
                        </td>
                        <td>
                            <input type="text" name="Name" placeholder="Entrez votre nom">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="email" name="Email" placeholder="Entrez votre e-mail">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="password" name="Password" placeholder="Entrez votre mot de passe">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="FormulaireSuite">
                <table>
                    <tr>
                        <td>
                            <label>Âge</label>
                            <input type="number" name="Date" min="0" max="70" value="0">
                        </td>
                        <td>
                            <input type="radio" name="Gender" value="Male">
                            <label>Homme</label>
                        </td>
                        <td>
                            <input type="radio" name="Gender" value="Female">
                            <label>Femme</label>
                        </td>
                        <td>
                            <input type="radio" name="Gender" value="Other">
                            <label>Autre</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="submit" name="Signin">Inscription</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>

<?php require_once('../Modules/Footer.php'); ?>