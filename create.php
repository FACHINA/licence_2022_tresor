<?php 
    // Appel à la connexion
    include('connexion.php');
    
    // On prépare la requête (artiste)
    $requete_1 ="SELECT * FROM artiste ORDER BY nom;";
    // On execute la requete
    $reponse_1 = $bdd->query($requete_1);
    // On récupère les données
    $donnees_1 = $reponse_1->fetchAll();

    // On prépare la requête (catégorie)
    $requete_2 ="SELECT * FROM categorie ORDER BY nomCategorie;";
    // On execute la requete
    $reponse_2 = $bdd->query($requete_2);
    // On récupère les données
    $donnees_2 = $reponse_2->fetchAll(); 

    /////////// Formulaire //////////////

    if(isset($_POST['enregistrer'])){
        // On vérifie les données
        if(empty($_POST['s_nom']) || empty($_POST['s_categorie'])){
            echo "Veuillez renseigner les champs obligatoires";
        }else{

            // On recupère les données du formulaire
            $nom = $_POST['s_nom'];
            $desc = $_POST['s_description'];
            $an = $_POST['s_annee'];
            $art = $_POST['s_artiste'];
            $cat = $_POST['s_categorie'];

            // On prépare la requête d'insertion
            $requete_3 = "INSERT INTO oeuvre VALUES (0,'$nom','$desc',$an,$art,$cat);";
            // On execute la requête
            if($bdd->query($requete_3) == true){
                //echo "<script language='JavaScript'> alert('Oeuvre enregistrée avec succès') </script>";
                header("Location: index.php");
            }else{
                echo "Echec d'enregistrement";
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une oeuvre</title>
</head>
<body>
    <h2>Formulaire d'ajout d'une oeuvre</h2>
    <form method="post" action="create.php">
        <fieldset>
            <legend>Oeuvre</legend>
                <!-- Nom -->
                <label>Nom</label>
                <input type="text" name="s_nom">
                <br>
                <!-- Description -->
                <label>Description</label>
                <input type="text" name="s_description">
                <br>
                <!-- Année -->
                <label>Année</label>
                <input type="number" name="s_annee">
                <br>
                <!-- Artise (Zone de selection dynamique) -->
                <label>Artiste</label>
                <select name="s_artiste">
                    <?php foreach ($donnees_1 as $key => $artiste) { ?>
                        <option value="<?= $artiste['idArtistes'] ?>">
                            <?= $artiste['nom'] ?>  <?= $artiste['prenom'] ?> 
                        </option>
                    <?php } ?>
                </select>
                <br>
                <!-- Catégorie (Zone de selection dynamique) -->
                <label>Catégorie</label>
                <select name="s_categorie">
                    <?php foreach ($donnees_2 as $key => $categorie) { ?>
                        <option value="<?= $categorie['idCategorie'] ?>"> 
                            <?= $categorie['nomCategorie'] ?>
                        </option>
                    <?php } ?>
                </select>
                <br>
        </fieldset>
        <button type="submit" name="enregistrer">Enregistrer</button>
        <button type="reset" name="annuler">Annuler</button>
    </form>
</body>
</html>