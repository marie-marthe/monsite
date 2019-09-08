<?php
    session_start();

    include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD


    $req = $DB->query("SELECT * 
        FROM topic_commentaire
        ORDER BY id_user");

    $req = $req->fetchAll();
?>

<!DOCTYPE html>

<html>
    <head>
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <title>Accueil</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        </head>

    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://localhost:8888/monsite/index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <?php
                if(!isset($_SESSION['id'])){
                }else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8888/monsite/profil">Mon profil</a>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <ul class="navbar-nav ml-md-auto">
                <?php
                if(!isset($_SESSION['id'])){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion">Connexion</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="motdepasse.php">Mot de passe oublie</a>
                    </li>

                    <?php
                }else{
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8888/monsite/f_blog/blog.php">Gestion des Articles</a>
                    </li>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8888/monsite/f_forum/forum.php">Gestion des Commentaires</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8888/monsite/deconnexion">Deconnexion</a>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>
    </nav>

        <base href="/"/>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Forum</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Accueil</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
    </head>

    <body>
        <?php
            require_once('../menu.php');    
        ?>

        <div class="container">
            <div class="row">

                <head>
                    <meta charset="utf-8"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                </head>

                <div class="col-sm-0 col-md-0 col-lg-0"></div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 style="text-align: center">Gestion des commentaires</h1>

                    <div class="table-responsive" style="margin-top: 10px">
                        <table class="table table-striped">

                        <?php
                            foreach($req as $r){ 
                            ?>
                                <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
                                    <a href="forum/<?= $r['id'] ?>" style="color: #666; text-decoration: none; font-size: 28px;"><?= $r['text'] ?></a>
                                    <div style="border-top: 2px solid #EEE; padding: 15px 0">
                                    </div>
                                    <div class="button"><a href="topic.php"> </a></div>
                                    <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
                                    </div>
                                    <a href="blog/creer-mon-article" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Supprimer</a>
                                </div>
                            <?php
                            }
                        ?>
                        </table>                    
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>