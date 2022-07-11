<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo">
    <title>login</title>

<style>
  <?php include "style.css" ?>
</style>
</head>
<body>
<div class="content">
<?php
include "header.html";
?>

<h2>Veuillez vous connecter</h2>

<form method="post" action="index.php">
    <div class="formLine">
        <label for="nom" class="etiquette">Nom d'utilisateur: </label>
        <input type="text" id="nom" name="nom"><br><br>
    </div>
    <div class="formLine">
        <label for="mdp" class="etiquette">Mot de passe: </label>
        <input type="password" id="mdp" name="mdp"><br><br>
    </div>
    <div class="formLine">
        <input type="submit" name="submit" value="Se connecter">

        <input type="button" onclick="location.href='creation_compte.php'" value="Créer un compte">
    </div>

</form>

<?php

include "connexion.php";

$pwCheck = $connect->prepare("
SELECT COUNT(*) FROM utilisateur
WHERE username = :username AND motDePasse = :mdp");

$pwCheck -> bindParam(":username", $username);
$pwCheck -> bindParam(":mdp", $mdp);

if (isset($_POST["submit"])) {
    $username = $_POST["nom"];
    $mdp = $_POST["mdp"];

    $pwCheck -> execute();
    $reponse = $pwCheck -> fetchAll();

    if($reponse[0][0] == 0) {
        echo "<p class='rouge'>Crédentiels invalides, vérifiez vos informations ou créez un compte</p>";
    } else {
        echo "<p class='vert'>Crédentiels valides, vous pouvez accéder à <a href='accueil.php'>l'accueil</a></p>";
    }
}

?>

<?php
include "footer.html";
?>
</div>
    
</body>
</html>