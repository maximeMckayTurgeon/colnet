<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo">
    <title>Creation de compte</title>
    <style>
    <?php include "style.css" ?>
    </style>
</head>
<body>
<div class="content">
<?php
include "header.html";
?>

<h2>Veuillez créer un compte</h2>

<form method="post" action="creation_compte.php">
<div class="formLine">
    <label for="nomComplet" class="etiquette">Nom complet: </label>
    <input type="text" id="nomComplet" name="nomComplet"><br><br>
</div>

<div class="formLine">
    <label for="username" class="etiquette">Username: </label>
    <input type="text" id="username" name="username"><br><br>
</div>

<div class="formLine">
    <label for="codePostal" class="etiquette">Code Postal: </label>
    <input type="text" id="codePostal" name="codePostal"><br><br>
</div>

<div class="formLine">
    <label for="email" class="etiquette">Email: </label>
    <input type="email" id="email" name="email"><br><br>
</div>

<div class="formLine">
    <label for="mdp" class="etiquette">Mot de passe: </label>
    <input type="password" id="mdp" name="mdp"><br><br>
</div>

<div class="formLine lone">
    <input type="submit" name="submit" value="S'enregistrer">
</div>

</form>

<?php
include "connexion.php";

$createUser = $connect ->prepare("
INSERT INTO utilisateur(nomComplet, username, codePostal, email, motDePasse) 
VALUES(:nomComplet, :username, :codePostal, :email, :motDePasse)");

$createUser -> bindParam(":nomComplet", $nomComplet);
$createUser -> bindParam(":username", $username);
$createUser -> bindParam(":codePostal", $codePostal);
$createUser -> bindParam(":email", $email);
$createUser -> bindParam(":motDePasse", $mdp);

if(isset($_POST["submit"])) {

$nomComplet = $_POST["nomComplet"]; 
$username = $_POST["username"];
$codePostal = $_POST["codePostal"];
$email = $_POST["email"];
$mdp = $_POST["mdp"];

$createUser->execute();

echo '<p class="vert">Votre compte à été créé, vous pouvez vous <a href="login.php">connecter</a>';
}

?>

<?php
include "footer.html";
?>
</div>
    
</body>
</html>