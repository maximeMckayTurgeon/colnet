<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo">
    <title>groupe</title>
    <style>
    <?php include "style.css" ?>
    </style>
</head>
<body>
<div class="content">
<?php
include "header.html";
?>

<?php

include "connexion.php";

if (isset($_POST["submitGroupe"])) {
    $insertGroup = $connect -> prepare("
    INSERT INTO groupe VALUES(:code, :nom, :type)");

    $insertGroup -> bindParam(":code", $code);
    $insertGroup -> bindParam(":nom", $nom);
    $insertGroup -> bindParam(":type", $type);

    $code = $_POST["code"];
    $nom = $_POST["nomGroupe"];
    $type = $_POST["type"];

    $insertGroup -> execute();

    echo "Le groupe " . $_POST["code"] . " a été ajouté avec succès";

}


?>

<h2>Ajouter un groupe</h2>

<form method="post" action="groupe.php">
<div class="formLine">
    <label for="code" class="etiquette">Code: </label>
    <input type="text" id="code" name="code"><br><br>
</div>

<div class="formLine">
    <label for="nomGroupe" class="etiquette">Nom: </label>
    <input type="text" id="nomGroupe" name="nomGroupe"><br><br>
</div>

<div class="formLine">
    <label for="type" class="etiquette">Choisir un type: </label>
    <select id="type" name="type">
            <option value="En ligne">En ligne</option>
            <option value="En classe">En classe</option>
            <option value="Hybride">Hybride</option>
    </select><br>
</div>

    <input type="submit" name="submitGroupe" value="Ajouter">
</form>

<p class="center">Revenir vers l'<a href="accueil.php">accueil</a></p>



<?php
include "footer.html";
?>
</div>
    
</body>
</html>