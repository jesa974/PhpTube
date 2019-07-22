<!DOCTYPE html>
<?php
session_start();
?>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
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
        <link href="../../../../../../../../../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">



        <!-- Custom styles for this template -->
        <link href="../../../../../../../../../../css/creative.min.css" rel="stylesheet">

    </head>

    <body id="page-top" class="fond">
        <!-- Navigation -->

        <nav class="navbar navbar-expand-lg navbar-light fixed-top  " id="mainNav">
            <div class="container ">
                <a class="navbar-brand black" href="x.php">PhpTeub</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link black " href="#video">Vidéo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link black " href="#categorie">Catégorie</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="text-center text-white d-flex">

        </header>

        <div>
            <p class="construction">
                En cours de construction
            </p>
        </div>

    </body>

</html>
