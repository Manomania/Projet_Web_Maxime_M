<?php
require_once "Modules/Header.php"; 
?>

<body>
    <h1>Klipay</h1>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- FORMULAIRE CONNEXION -->
    <div class="Menu_id">
        <form action="Action-Inscription.php" method="post">
            <table>
                <tr>
                    <td>
                        <label>Adresse e-mail </label>
                    </td>
                    <td>
                        <label>Mot de passe </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="Login">
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
        <form action="Action-Inscription.php" method="post">
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
                            <input type="radio" name="gender" value="male">
                            <label>Homme</label>
                        </td>
                        <td>
                            <input type="radio" name="gender" value="female">
                            <label>Femme</label>
                        </td>
                        <td>
                            <input type="radio" name="gender" value="other">
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

<?php 
require_once "Modules/Footer.php"; 
?>