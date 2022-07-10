<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo">
    <title>etudiant</title>
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
// get la colonne code de groupe pour generer la partie select du form
$groupesSelect = $connect ->prepare("
SELECT code FROM groupe");

$groupesSelect -> execute();

$groupesArr = $groupesSelect->fetchAll(PDO::FETCH_ASSOC);
// 

// Ajout d'etudiants via form
$nouvelEtudiant = $connect->prepare("
INSERT INTO etudiant VALUES(:codePermanent, :nomComplet, :adresse, :telephone, :moyenne, :codeGroupe)");

$nouvelEtudiant -> bindParam(":codePermanent", $codePermanent);
$nouvelEtudiant -> bindParam(":nomComplet", $nomComplet);
$nouvelEtudiant -> bindParam(":adresse", $adresse);
$nouvelEtudiant -> bindParam(":telephone", $telephone);
$nouvelEtudiant -> bindParam(":moyenne", $moyenne);
$nouvelEtudiant -> bindParam(":codeGroupe", $codeGroupe);

if(isset($_POST["submitEtudiant"])) {
    
    $codePermanent = $_POST["codeP"];
    $nomComplet = $_POST["nomEtudiant"];
    $adresse = $_POST["adresseEtudiant"];
    $telephone = $_POST["telEtudiant"];
    $moyenne = $_POST["moyenne"];
    $codeGroupe = $_POST["groupeEtudiant"];

    $nouvelEtudiant -> execute();

    echo "L'étudiant(e) " . $_POST["nomEtudiant"] . " a été ajouté(e) avec succès";
};
?>

<h2>Ajouter un étudiant</h2>

<form method="post" action="etudiant.php">

<div class="formLine">
    <label for="codeP">Code Permanent:</label>
    <input type="text" id="codeP" name="codeP">
</div>

<div class="formLine">
    <label for="nomEtudiant">Nom complet:</label>
    <input type="text" id="nomEtudiant" name="nomEtudiant">
</div>

<div class="formLine">
    <label for="adresseEtudiant">Adresse:</label>
    <input type="text" id="adresseEtudiant" name="adresseEtudiant">
</div>

<div class="formLine">
    <label for="telEtudiant">Téléphone:</label>
    <input type="text" id="telEtudiant" name="telEtudiant">
</div>

<div class="formLine">
    <label for="moyenne">Moyenne:</label>
    <input type="number" id="moyenne" name="moyenne" step="0.01">
</div>

<div class="formLine">
    <label for="groupeEtudiant" class="etiquette">Choisir un groupe: </label>
    <select id="groupeEtudiant" name="groupeEtudiant">
        <?php
        foreach($groupesArr as $code) {
            $codeP = $code["code"];
            echo "<option value='$codeP'>$codeP</option>";
        };
        ?>
    </select><br>
</div>

    <input type="submit" name="submitEtudiant" value="Ajouter">
</form>

<p class="center">Revenir vers l'<a href="accueil.php">accueil</a></p>



<?php
include "footer.html";
?>
</div>
    
</body>
</html>