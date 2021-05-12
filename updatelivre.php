<?php

require('connexion_bdd.php'); //connexion à la base de donnée

if(isset($_POST['btn_modifier'])){//SI je clique sur le bouton 'btn_modifier'


    $sql_update = "UPDATE `livres` SET `id`=[value-1],`nom`=[value-2],`prix`=[value-3] WHERE id=1";
    var_dump($sql_update);
    // $conn->query($sql);
}

?>