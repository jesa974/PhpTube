<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=phptube', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}



if (isset($_POST['user']) && isset($_POST['password'])) {

    $user = $_POST['user'];
    $password = $_POST['password'];

    /* On insert le nouvel utilisateur dans la bdd puis on le redirectionne sur la page de connexion
     * 
     */
    $sql = "INSERT INTO connexion(user,password) VALUES ('$user', '$password')";
    $bdd->exec($sql);
    header('Location:login.php');
}
