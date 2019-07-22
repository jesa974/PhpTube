<?php

class requete_sql {
    /* on remplie la table upload */

    public function insert_for_upload($name, $size, $add_by, $new_name, $categorie) {
        $sql = "INSERT INTO upload (up_name, new_name, category, up_size, add_by) VALUES ('$name','$new_name','$categorie','$size','$add_by')";
        return $sql;
    }

    /* on remplie la table categorie */

    public function insert_for_categorie($categorie, $new_name) {
        $sql = "INSERT INTO categorie($categorie) VALUES('$new_name')";
        return $sql;
    }

    /* on remplie la table connexion */

    public function insert_for_connexion($user, $password) {
        $sql = "INSERT INTO connexion(user,password) VALUES ('$user', '$password')";
        return $sql;
    }

}
