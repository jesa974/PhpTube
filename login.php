
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
                            <form action="validation.php" method="post" enctype="multipart/form-data">

                                <label >Login</label> <br/>
                                <input type="text" name="user" autocomplete='off' ><br/>
                                <label class="By" id="image">Password</label> <br/>
                                <input type="password" name="password" autocomplete='off' ><br/><br>
                                <input type="submit"  value="Connexion" name="submit">

                            </form>
                            <form action="register.php" method="post" enctype="multipart/form-data">
                                <input type="submit"  value="Register" name="submit">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <?php
            if (isset($user) && isset($password)) {
// On récupère login et mot de passe pour vérifier la connexion
                $user = $_POST['user'];
                $password = $_POST['password'];
            }
            ?>
        </header>
    </body>

</html>