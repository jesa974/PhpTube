<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=phptube', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Php Project</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/creative.min.css" rel="stylesheet">



    </head>

    <body id="page-top" >
        <!-- Navigation -->

        <nav class="navbar navbar-expand-lg navbar-light fixed-top  " id="mainNav">
            <div class="container ">
                <a class="navbar-brand black nav-size " href="index.php">PhpTube</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link black nav-size " href="#video">Vidéo</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <header class="text-center text-white d-flex">
        </header>
        <div class="fond">
            <div class="menu">
                <a style="color : black;" href="#Musique">Musique</a><br>
                <a style="color : black;" href="#Informatique">Informatique</a><br>
                <a style="color : black;" href="#Science">Science</a><br>
                <a style="color : black;" href="#Tuto">Tuto</a><br>
                <a style="color : black;" href="#Stream">Stream</a><br>
                <a style="color : black;" href="#Humour">Humour</a><br>
                <a style="color : black;" href="#Sport">Sport</a>
            </div>
            <div>
                <?php
                // Récupère le nom des catégories qui sont représentées par des colonnes dans la BDD
                $result = $bdd->query("SHOW columns FROM Categorie");
                // Compteur de vidéos
                $cpt = 0;
                // Tant qu'il y a des catégories
                while ($category = $result->fetch()) {
                    // Afficher toutes les colonnes sauf celle qui se nomme "Choisir"
                    if ($category[0] != "Choisir") {
                        if ($category[0] != "Musique") {
                            ?>
                            <div  id="<?php echo $category[0]; ?>" style="text-align: center; margin-top : 25%;"> <h2 class="text-uppercase">
                                    <strong><?php echo $category[0]; ?></strong>
                                </h2>
                                <div> 
                                <?php } else {
                                    ?>  <div  style="text-align: center; margin-top : 20%;"> <h2 id="Musique" class="text-uppercase">
                                            <strong>Musique</strong>
                                        </h2>
                                        <div> <?php
                                        }
                                        // Récupère les vidéos de la catégorie correspondante dans la BDD
                                        $get_video = $bdd->query("SELECT $category[0] FROM categorie WHERE $category[0] IS NOT NULL");

                                        // Tant qu'il y a une vidéo dans la catégorie
                                        while ($var = $get_video->fetch()) {
                                            // Augmente le compteur du nombre de vidéos
                                            $cpt++;
                                        }

                                        // Test s'il y a des vidéos présentes dans la catégorie
                                        if ($cpt > 0) {
                                            // Récupère la catégorie de la vidéo afin de construire le chemin d'accès de la vidéo
                                            $video_chemin = "video/" . $category[0];
                                            $upload_by_category = $bdd->query("SELECT * FROM upload WHERE category = '$category[0]'");

                                            while ($upload_table = $upload_by_category->fetch()) {

                                                $video = $video_chemin . "/" . $upload_table[2];
                                                ?>
                                                <div style="float: left; margin: 0 5% 2% 7%;">
                                                    <a><?php echo $upload_table[2]; ?></a>
                                                    <br>
                                                    <video width="160" height="120" controls>
                                                        <source src="<?php echo $video ?>" type="video/mp4">
                                                    </video>
                                                    <br>
                                                    <a>Ajouté par : <?php echo $upload_table[5] . "&nbsp;"; ?></a>
                                                    <br>
                                                    <a href="<?php echo $video ?>" download="<?php echo $upload_table[2] ?>">Download</a>
                                                    <br>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <br><br><br><br><br><br><br><br><br>
                                        <?php
                                        // S'il n'y a pas de vidéo dans la catégorie
                                    } else {
                                        echo "Pas de vidéo disponible dans cette catégorie";
                                    }
                                }
                            }
                            ?></div>
                    </div>
                </div>
            </div>

        </div>
    </body>

</html>
