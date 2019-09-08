<?php
session_start();

    include('bd/connexionDB.php'); 

    // S'il n'y a pas de session alors on ne va pas sur cette page
    if (!isset($_SESSION['id'])){
        header('Location: index.php'); 
        exit;
    }

    // On recupere les informations de l'utilisateur connecte
    $afficher_profil = $DB->query("SELECT * FROM utilisateur WHERE id = ?",
        array($_SESSION['id']));

    $afficher_profil = $afficher_profil->fetch();

$req = $DB->query( "SELECT b.*, u.prenom, u.nom, c.titre as titre_cat
        FROM blog b
        LEFT JOIN utilisateur u ON u.id = b.id_user
        LEFT JOIN categorie c ON c.id_categorie = b.id_categorie
        ORDER BY b.date_creation DESC");
$req = $req->fetchAll();

?>



<!DOCTYPE html>
<html lang="fr">
    <head>

        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Accueil</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mon profil</title>
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Accueil</a>
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
                        <a class="nav-link" href="profil">Mon profil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="f_blog/blog.php">Gestion des Articles</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="f_forum/forum.php">Gestion des Commentaires</a>


                    <?php
                }
                ?>
            </ul>

            <ul class="navbar-nav ml-md-auto">
                <?php
                if(!isset($_SESSION['id'])){
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="f_forum/forum.php">Gestion des Commentaires</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="f_blog/blog.php">Gestion des Articles</a>
                    </li>

                    <?php
                }else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion">Deconnexion</a>
                    </li>

                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>

        <!-- Ici on peut afficher toutes les informations que vous souhaitez : 
            - age,
            - sexe,
            - date,
            - mail,
            - etc.
        -->
        <h2>Voici le profil de <?= $afficher_profil['nom'] . " " .  $afficher_profil['prenom']; ?></h2>


        <div>Quelques informations sur vous : </div>

            <ul>
                <li>Votre Mail est : <?= $afficher_profil['mail'] ?></li>
                <li>Votre compte a été crée le : <?= $afficher_profil['date_creation_compte'] ?></li>
            </ul>

    <div>
        <a href="view/admin/redactor.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Créer un nouvel article</a>
    </div>

    <body>
</html>