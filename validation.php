
<?php

// On se connecte à la base de donnée
try {
    $bdd = new PDO('mysql:host=localhost;dbname=phptube', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$user = $_POST['user'];
$password = $_POST['password'];



if (isset($user) && isset($password)) {

    /* on recupere l'id 2 fois pour pouvoir comparer si l'id du mot de passe et de l'user est le même pour éviter
     * que n'importe quel utilisateur fonctionne avec n'importe quel mot de passe
     */

    $result1 = $bdd->query('SELECT id,user FROM connexion');
    $result2 = $bdd->query('SELECT id,password FROM connexion');

    while (($verif1 = $result1->fetch() ) && ( $verif2 = $result2->fetch())) {
        if ($verif1['id'] == $verif2['id']) { // ici on vérifie les id 
            if (($verif1['user'] === $user) && ($verif2['password'] === $password)) { // ici que les mots de passes et user sont compatibles 
                header('Location:index.php'); // Si c'est le cas redirection sur l'accueil 
            } else {
                header('Location:login.php'); // Sinon réessayez
            }
        }
    }
}
        

