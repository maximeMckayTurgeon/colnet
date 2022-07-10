<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo">
    <title>accueil</title>
    <style>
     <?php include "style.css" ?>
    </style>
</head>
<body>
<div class="contentWide">
<?php
include "header.html";
?>

<h2>Veuillez faire un choix</h2>

<div class="nav">
    <div class="navItem"><a href="groupe.php">Ajouter un groupe</a></div>
    <div class="navItem"><a href="etudiant.php">Ajouter un étudiant</a></div>
    <div class="navItem"><a href="donnees.php">Afficher données</a></div>
    <div class="navItem"><a href="stats.php">Compiler statistiques</a></div>
</div>
<?php
include "footer.html";
?>
</div>
    
</body>
</html>