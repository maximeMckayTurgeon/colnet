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

<?php

include "connexion.php";
// get la colonne code de groupe pour generer la partie select du form
$groupesSelect = $connect ->prepare("
SELECT DISTINCT codeGroupe FROM etudiant");

$groupesSelect -> execute();

$groupesArr = $groupesSelect->fetchAll(PDO::FETCH_ASSOC);
// 

if(isset($_POST["submitDonnees"])) {

    $groupeTri = $_POST["groupeDonnees"];

    $ordreTri = $_POST["triMoyenne"];

    $orderByMoyenne = $connect->prepare("
    SELECT * FROM etudiant
    WHERE codeGroupe = '$groupeTri'
    ORDER BY moyenne $ordreTri;");

    $orderByMoyenne->execute();

    $resultatArr = $orderByMoyenne->fetchall(PDO::FETCH_ASSOC);

    $resultatTable = "<table>
                        <tr>
                            <th>Code Permanent</th>
                            <th>Nom Complet</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Moyenne</th>
                            <th>Groupe</th>
                        </tr>";

    foreach($resultatArr as $etudiant) {
        $codeP = $etudiant["codePermanent"];
        $nom = $etudiant["nomComplet"];
        $adresse = $etudiant["adresse"];
        $telephone = $etudiant["telephone"];
        $moyenne = $etudiant["moyenne"];
        $codeG = $etudiant["codeGroupe"];
        
        $resultatTable .= "<tr>
                                <td>$codeP</td>
                                <td>$nom</td>
                                <td>$adresse</td>
                                <td>$telephone</td>
                                <td>$moyenne</td>
                                <td>$codeG</td>
                            </tr>";
    }
    
    $resultatTable .= "</table>";

    echo $resultatTable;
    
};

?>

<h2>Veuillez appliquer vos filtres</h2>

<form method="post" action="donnees.php">

<div class="formLine">
    <label for="groupeDonnees" class="etiquette">Choisir un groupe: </label>
    <select id="groupeDonnees" name="groupeDonnees">
        <?php
        foreach($groupesArr as $code) {
            $codeP = $code["codeGroupe"];
            echo "<option value='$codeP'>$codeP</option>";
        };
        ?>
    </select><br>
</div>

<div class="formLine">
    <label for="triMoyenne" class="etiquette">Tri sur la moyenne: </label>    
    <select id="triMoyenne" name="triMoyenne">
        <option value="DESC">Descendant</option>
        <option value="ASC">Ascendant</option>
    </select><br>
</div>

<div class="formLine lone">
    <input type="submit" name="submitDonnees" value="Afficher Résultats">
</div>
</form>

<p class="center">Revenir vers l'<a href="accueil.php">accueil</a></p>



<?php
include "footer.html";
?>
</div>
    
</body>
</html>