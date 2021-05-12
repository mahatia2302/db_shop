<?php
require('connexion_bdd.php'); //connexion au serveur de base de données
include('class/classdbshoop.php');


// instancier OU appeler une class (object)
$dbshoop = new dbshoop();

// =========================
// gestion des boutons
// =========================
if (isset($_POST['btn'])) {

    // si bouton == supprimer
    if ($_POST['btn'] == "Supprimer") {
        $etat = "fermer";

        // je récupère mon formulaire supprimer
        $id = $_POST['id_livre'];

        // j"execute ma requête supprimer
        // dans ma fonction deleteDbShoop
        $dbshoop->deleteDbShoop($id);
    }

    if ($_POST['btn'] == "Modifier") {
        $etat = "ouvrir";
        $id_clique = $_POST['id_livre'];
    }

    if ($_POST['btn'] == "Confirmer") {
        $etat = "fermer";
        $new_nom = $_POST['new_nom'];
        $new_prix = $_POST['new_prix'];
        $id_livre = $_POST['id_livre'];

        $dbshoop->updateDbShoop($new_nom, $new_prix, $id_livre);
    }


    if ($_POST['btn'] == "Valider") {

        $etat = "fermer";

        // récupérer les valeurs 
        $nom = $_POST['nom']; //Variable $nom contient les données de l'input 'nom'

        $prix = $_POST['prix']; //Variable $nom contient les données de l'input 'prix'

        $dbshoop->createDbShoop($nom, $prix);
    }
} else {

    $etat = "fermer";
}

// j'affiche ma liste
$res_listLivres = $dbshoop->getDbShoop();

?>

<html>

<head>
    <!-- META -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link href="style.css" rel="stylesheet">


    <title>DB SHOP</title>

    <!-- BOOTSTRAP -->
    <!-- CSS -->
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- JS -->
    <script src="assets/bootstrap/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/jquery-slim.min.js"></script>
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/bootstrap/js/util.js"></script>
</head>


<body>

    <div class="row">
        <div class="col-md-9">

            <label>
                <u>
                    <b>
                        LISTE DES LIVRES
                    </b>
                </u>
            </label>


            <?php


            // CONDITIONS \\
            // Afficher la liste des livres
            //si $res_listLivres contient au moins une données 
            if ($res_listLivres->num_rows > 0) {
                //faire ceci
                echo "<table>";

                    echo "<th>";
                        echo "Nom";
                    echo "</th>";

                    echo "<th>";
                        echo "Prix";
                    echo "</th>";

                    echo "<th>";
                        echo "Actions";
                    echo "</th>";

                foreach ($res_listLivres as $valeur) { //Boucle : Pour chaque resultat 

                    if (($etat == "ouvrir") && ($id_clique == $valeur['id'])) {

                    echo '<form action="index.php" method="post">';
                        echo "<input type='hidden' name='id_livre' value=" . $valeur['id'] . ">";
                            echo "<tr>";

                                echo "<td>";
                                    echo "<input type='text' name='new_nom'  value='" . $valeur['nom'] . "'>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<input type='text' name='new_prix'  value='" . $valeur['prix'] . "'>";
                                echo "</td>";

                                echo "<td>";
                                    echo "<input type='submit' name='btn' value='Confirmer'/>";
                                echo "</td>";

                            echo "<tr>";
                    echo '</form>';




                        // -------------------------------------------------------
                    } else {

                    echo "<tr>";

                        echo "<td>";
                            echo $valeur['nom'];
                        echo "</td>";

                        echo "<td>";
                            echo $valeur['prix'];
                        echo "</td>";

                        echo "<td>";

                            echo '<form action="index.php" method="post">';

                                echo "<input type='submit' name='btn' value='Modifier'/>";
                                echo "<input type='hidden' name='id_livre' value=" . $valeur['id'] . ">";

                            echo '</form>';

                            echo '<form action="index.php" method="post">';

                                echo "<input type='hidden' name='id_livre' value=" . $valeur['id'] . ">";
                                echo "<input type='submit' name='btn' value='Supprimer'/>";

                            echo '</form>';

                        echo "</td>";

                    echo "</tr>";
                    //afficher nom
                    //echo '<br>';
                    //echo $valeur['nom']." | ";
                    //afficher prix
                    //echo $valeur['prix']."<br/>";
                    }
                }

                echo "</table>";
            } else { //sinon
                //faire cela
                echo "Il n'y a aucun résultats";
            }

            ?>

        </div>

            <br>

        <div class="col-md-3">

            <label>
                <u>
                    <b>
                        CREER UN LIVRES
                    </b>
                </u>
            </label>

        

            <?php

            // <!-- CREER UN LIVRE  -->
            echo '<form  method="POST" action="index.php">';
                echo '<u>';
                    echo '<p>';
                        echo 'Ajouter un livre:';
                    echo '</p>';
                echo '</u>';

                echo '<p>';
                // echo '<label>';
                // echo 'Nom :'; 
                // echo '</label>';
                    echo '<input type="text" name="nom" placeholder="Nom">';
                echo '</p>';

                echo '<p>';
                // echo '<label>';
                // echo 'Prix : ';
                // echo '</label>';
                    echo '<input type="text" name="prix" placeholder="Prix">';
                echo '</p>';

                echo '<p>';
                    echo '<input type="submit" name="btn" value="Valider">';
                echo '</p>';
            echo '</form>';
            ?>

        </div>

    </div>

</body>

</html>