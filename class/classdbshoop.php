<?php
include("connexion_bdd.php");


class dbshoop {
    
    /**
     * delete DbShoop Delete from livres
     *
     * @param int $id 
     *
     */
    public function  deleteDbShoop($id){
        
        global $connect_bdd; 
        //sql to delete a record
        $sql_delete = "DELETE FROM livres WHERE id=".$id;

        // execute la requête précédente
        $connect_bdd->query($sql_delete);

    }
    
    /**
     * Dèscription de la function 
     *
     * @return $res_listLivres
     */
    public function getDbShoop(){
        global $connect_bdd; 

        $req_listLivres = "SELECT * from livres" ; //$sql : contient la requete sql 
        $res_listLivres = $connect_bdd->query($req_listLivres); //$result : execute la requete $sql

        return $res_listLivres;

    }

        
    /**
     * create dbshoop into "livres"
     *
     * @param string $nom
     * @param int $prix
     *
     */
    public function createDbShoop($nom,$prix){

        global $connect_bdd;

        $sql = "INSERT INTO `livres`(`nom`,`prix`) VALUES ('".$nom."' , ".$prix." )";
        $connect_bdd->query($sql);

    }

    
    
    /**
     * Update DbShoop "livres"
     *
     * @param string $new_nom 
     * @param int $new_prix 
     * @param int $id_livre
     *
     */
    public function updateDbShoop($new_nom,$new_prix,$id_livre){
        global $connect_bdd;

        $sql_update = "UPDATE `livres` SET `nom`= '".$new_nom."',`prix`= $new_prix WHERE id =".$id_livre;
        $connect_bdd->query($sql_update);

    }


}