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
    <meta charset="utf-8">
    <title>Admin Article </title>
</head>
<body>
<h1> Rédaction d'un article : </h1>
<div>

    <div>
       <h2><input id="titre" type="text" name="Titre" placeholder="Ajoutez un titre"></h2>
    </div>


    </div>
    <div><textarea name="editor"></textarea></div>
</div>

<div>
    <a href="profil" id="publish" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Publier<e</a>
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