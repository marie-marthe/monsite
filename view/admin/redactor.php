<?php

session_start();

if(!isset($_SESSION["id"]) || (isset($_SESSION["id"]) && !$_SESSION["id"])) {
    echo "Unauthorized Access";
    exit;
}

if (isset($_POST["titre"]) && isset($_POST["blog"])) {
$sql = "INSERT INTO blog(titre, text, date_creation)) VALUES (:titre, :text, :id_user, :date_creation)";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':titre', $_POST['title']);
$stmt->bindValue(':text', $_POST['post']);
$stmt->bindValue(':id_user', $_SESSION['id']);
$stmt->bindValue(':date_creation', date("Y-m-d H:i:s"));
$stmt->execute();
return;
}

?>


<html>
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
<head>
    <meta charset="utf-8">
    <title>Admin Article </title>
</head>
<body>
<h1> Rédaction d'un article : </h1>
<div>

    <div>
       <h5><input id="titre" type="text" name="Titre" placeholder="Ajoutez un titre"></h5>
    </div>


    </div>
    <div><textarea name="editor"></textarea></div>
</div>

<div>
    <a href="profil" id="publish" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Publier</a>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
    $('#publish').on('click', function(){
        $.ajax({
            method: "POST",
            data: {
                "post": CKEDITOR.instances.editor.getData(),
                "titre": $("#postTitle").val(),
            },
            success: function(){
                window.location.href = "/profil.php";
            }
        })
    });
</script>
</body>
</html>