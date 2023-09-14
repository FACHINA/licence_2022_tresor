<?php
    // Appel à la connexion
    include('connexion.php');
    // On prépare la requête
    $requete = "
        SELECT `oeuvre`.`idOeuvre`, `oeuvre`.`nom` , `oeuvre`.`annee` ,`artiste`.`nom` AS `nomArtiste`, `categorie`.`nomCategorie` 
        FROM `oeuvre`,`artiste`,`categorie`
        WHERE `oeuvre`.`idArtiste` = `artiste`.`idArtistes`
        AND `oeuvre`.`idCategorie` = `categorie`.`idCategorie`;
    ";

    // Exécution
    $reponse = $bdd->query($requete);

    // Récupération des données
    $donnees = $reponse->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des oeuvres</title>
    <link rel="stylesheet" href="inc/bootstrap.css">
</head>
<body>
    <h2>Liste des oeuvres</h2>
    <br>
    <button>
        <a href="create.php">Ajouter une oeuvre</a>
    </button>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Oeuvre</th>
                <th>Auteur</th>
                <th>Année</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($donnees as $key => $art) {
            ?>
            <tr>
                <td> <?= $art['nom'] ?> </td>
                <td> <?= $art['nomArtiste'] ?> </td>
                <td> <?= $art['annee'] ?> </td>
                <td> <?= $art['nomCategorie'] ?> </td>
                <td> 
                    <button type="submit" name="modifier">
                        <a href="modifier.php?id=<?= $art['idOeuvre'] ?>">
                            Modifier
                        </a>
                    </button>
                    <button type="submit" name="supprimer">Supprimer</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>