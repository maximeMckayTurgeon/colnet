<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo">
    <title>donnees</title>
    <style>
    <?php include "style.css" ?>
    </style>
</head>
<body>
<div class="content">
<?php
include "header.html";
?>



<h2>Veuillez consulter les statistiques des étudiants</h2>

<?php

include "connexion.php";

// nombre d'étudiants évalués

$getEtudiants = $connect ->prepare("
SELECT COUNT(*) FROM etudiant");

$getEtudiants-> execute();

$nbrEtudiants = $getEtudiants->fetchAll(PDO::FETCH_ASSOC)[0]['COUNT(*)'];

echo "<strong>$nbrEtudiants</strong> étudiants ont été évalués<br><br>";

// nombre de reussites

$getReussites = $connect ->prepare("
SELECT COUNT(*) FROM etudiant
WHERE moyenne >= 12");

$getReussites-> execute();

$nbrReussites = $getReussites->fetchAll(PDO::FETCH_ASSOC)[0]['COUNT(*)'];

echo "<strong>$nbrReussites</strong> étudiants ont réussi<br><br>";

// join de etudiants avec groupe 

$etudiantGroupe = $connect->prepare('
SELECT e.moyenne, g.type FROM etudiant as e 
INNER JOIN groupe as g on e.codeGroupe = g.code
;');

$etudiantGroupe->execute();

$etudiantArr = $etudiantGroupe->fetchAll(PDO::FETCH_ASSOC);

$enLigneArr = [];

$enClasseArr = [];

$hybrideArr = [];

foreach($etudiantArr as $etudiant) {
    switch ($etudiant["type"]) {
        case "En ligne":
            array_push($enLigneArr, $etudiant["moyenne"]);
            break;
        case "En classe":
            array_push($enClasseArr, $etudiant["moyenne"]);
            break;
        default:
            array_push($hybrideArr, $etudiant["moyenne"]);

    }
}

// fonction calculer le taux de reussite a partir d'un tableau

function calcTauxReussite($array) {
    $counter = 0;
    foreach($array as $moyenne) {
        if($moyenne >= 12) {
        $counter++;
        }
    }
    return round(($counter / sizeof($array)) * 100, 2);
}

$tauxLigne = calcTauxReussite($enLigneArr);
$tauxClasse = calcTauxReussite($enClasseArr);
$tauxHybride = calcTauxReussite($hybrideArr);

echo "Le taux de réussite en Ligne est <strong>$tauxLigne%</strong><br><br>";
echo "Le taux de réussite en Classe est <strong>$tauxClasse%</strong><br><br>";
echo "Le taux de réussite en Hybride est <strong>$tauxHybride%</strong><br><br>";

?>

<p >Revenir vers l'<a href="accueil.php">accueil</a></p>
<?php
include "footer.html";
?>
</div>
    
</body>
</html>