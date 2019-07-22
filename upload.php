<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=phptube', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Php Project</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">


        <script src="oXHR.js"></script>

        <!-- Custom styles for this template -->
        <link href="css/creative.min.css" rel="stylesheet">

        <!-- Toute cette partie fonctionne correctement vous pouvez decommenter pour tester seulement 
             nous avons eu un petit soucis de version et celle ci affiche un pop-up en allant 
             sur la page, elle n'attend pas que l'on clique sur le bouton. Mise à part ceci elle est 
             fonctionnel mais on l'a commente pour le rendu -->



<!-- <script type='text/JavaScript'>

    function getXhr(){
        var xhr = null; 
        if(window.XMLHttpRequest) // Firefox et autres
        xhr = new XMLHttpRequest(); 
        else if(window.ActiveXObject){ // Internet Explorer 
        try {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        }
        else { // XMLHttpRequest non supporté par le navigateur 
        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
        xhr = false; 
        } 
        return xhr;
        }

    // Node cleaner
    function go(c){
        if(!c.data.replace(/\s/g,''))
        c.parentNode.removeChild(c);
    }

    function clean(d){
    var bal=d.getElementsByTagName('*');

    for(i=0;i<bal.length;i++){
    a=bal[i].previousSibling;
    if(a && a.nodeType==3)
    go(a);
    b=bal[i].nextSibling;
    if(b && b.nodeType==3)
    go(b);
    }
    return d;
    } 

    /**
    * Méthode qui sera appelée sur le click du bouton
    */
    function gophp(){
    var xhr = getXhr();
    // On défini ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
    // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
    if(xhr.readyState == 4 && xhr.status == 200){
    reponse = clean(xhr.responseXML.documentElement);
    alert(reponse.getElementsByTagName("message")[0].firstChild.nodeValue);
    }
    }
    xhr.open("GET","ajaxxml.php",true);
    xhr.send(null);

    }

</script> -->
    </head>

    <body id="page-top">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand nav-size " href="index.php">PhpTube</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-size" href="video.php">Vidéo</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <header class="masthead text-center text-white d-flex">

            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-10 mx-auto">

                        <h1 class="text-uppercase">
                            <strong>Ajouter votre contenu</strong>
                        </h1>
                        <hr>
                    </div>
                    <div class="col-lg-8 mx-auto">
                        <p class="text-faded mb-5">Pas de vidéo X.</p>    
                        <div class="btn btn-primary btn-xl">
                            <form action="upload.php" method="post" enctype="multipart/form-data">

                                <label>Choisir vidéo</label> 
                                <p class="text_form">(mp4, avi, mpeg)</p>
                                <input class="label-file input-file" type="file" name="file" id="file" required >
                                <label class="By">Nom de la vidéo</label> <br/>
                                <input class="rename" type="text" name="rename" placeholder="      Renommer la vidéo" autocomplete='off' required><br/>
                                <label class="categorie"> Catégorie </label>
                                <select name="categorie" >

                                    <?php

                                    function chargerClasse() {
                                        require 'comment.php'; // On inclut la classe contenant les requetes sql principales
                                    }

                                    spl_autoload_register('chargerClasse');

                                    $sql = new requete_sql();

                                    /* On affiche nos catégorie dans le formulaire */

                                    $req = "SHOW columns FROM Categorie";
                                    $result = $bdd->query($req);
                                    $i = 0;

                                    while ($donnees = $result->fetch()) {
                                        $i++;
                                        ?>
                                        <option name="categorie" id="category" value="<?php echo $donnees[0]; ?>"><?php echo $donnees[0]; ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select> <br/>
                                <label class="By">Ajouté par</label> <br/>
                                <input type="text" name="add_by" placeholder="      Exemple : Matthieu" autocomplete='off' required><br/>
                                <input class="submit" type="submit"  value="Upload la vidéo" name="submit">

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </header>

        <?php
        /* Cette fonctin permet d'upload les vidéos 
         * Elle verifie que la video a le bon format puis l'envoie dans le bon dossier avec un nom que l'utilisateur aura choisi
         */
        if (isset($_FILES["file"]["type"]) && isset($_FILES["file"]["name"]) && isset($_FILES["file"]["size"]) && isset($_FILES["file"]["tmp_name"]) && ($_POST['categorie'] != "Choisir") && isset($_POST['rename'])) {

            if (($_FILES["file"]["type"] == "video/mpeg") || ($_FILES["file"]["type"] == "video/mp4") || ($_FILES["file"]["type"] == "video/avi") && ($_FILES["file"]["size"] < 200000000000000000)) {
                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                } else {

                    $categorie = $_POST['categorie'];
                    $new_name = $_POST['rename'];

                    if (isset($new_name)) {
                        if ($_FILES["file"]["type"] == "video/mp4") {
                            if (file_exists("video/$categorie/" . $new_name . ".mp4")) {
                                
                            } else {
                                // Stockage vidéo
                                move_uploaded_file($_FILES["file"]["tmp_name"], "video/$categorie/" . $new_name . ".mp4");
                            }
                        }
                        if ($_FILES["file"]["type"] == "video/mpeg") {
                            if (file_exists("video/$categorie/" . $new_name . ".mpeg")) {
                                
                            } else {
                                // Stockage vidéo
                                move_uploaded_file($_FILES["file"]["tmp_name"], "video/$categorie/" . $new_name . ".mpeg");
                            }
                        }
                        if ($_FILES["file"]["type"] == "video/avi") {
                            if (file_exists("video/$categorie/" . $new_name . ".avi")) {
                                
                            } else {
                                // Stockage vidéo
                                move_uploaded_file($_FILES["file"]["tmp_name"], "video/$categorie/" . $new_name . ".avi");
                            }
                        }
                    }
                }
            }

            /* Pour remplir la table upload */
            $add_by = $_POST['add_by'];
            $name = $_FILES["file"]["name"];
            $size = ($_FILES["file"]["size"] / 1024);
            $categorie = $_POST['categorie'];
            // use exec() because no results are returned
            $bdd->exec($sql->insert_for_upload($name, $size, $add_by, $new_name, $categorie));

            /* Pour remplir la table categorie */
            $bdd->exec($sql->insert_for_categorie($categorie, $new_name));
        } /* else {
          ?>
          <script>gophp()</script>
          <?php
          } */
        ?>
    </body>

</html>
