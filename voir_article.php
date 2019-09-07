<?php
    session_start();

    include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

    $get_id = (int) trim($_GET['id']);

    if(empty($get_id)){
        header('Location: /blog');
        exit;
    }

    $req = $DB->query("SELECT b.*, u.prenom, u.nom, c.titre as titre_cat
        FROM blog b
        LEFT JOIN utilisateur u ON u.id = b.id_user
        LEFT JOIN categorie c ON c.id_categorie = b.id_categorie
        WHERE b.id = ?
        ORDER BY b.date_creation", 
        array($get_id));

    $req = $req->fetch();
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="/"/>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Blog : <?= $req['titre'] ?></title>
        <link rel="stylesheet" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
    </head>

    <body>
        <?php
            require_once('../menu.php');    
        ?>

        <div class="container">
            <div class="row" style="margin-top: 20px">  

                <div class="col-sm-12 col-md-12 col-lg-12">                 

                    <a class="btn btn-primary" href="/blog" role="button">Retour</a>

                    <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
                        <h1 style="color: #666; text-decoration: none; font-size: 28px;"><?= $req['titre'] ?></h1>
                        <div style="border-top: 2px solid #EEE; padding: 15px 0">
                            <?= nl2br($req['text']); ?>
                        </div>
                        <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
                            Fait par  <?= $req['nom'] . " " . $req['prenom'] ?> le <?= date_format(date_create($req['date_creation']), 'D d M Y à H:i'); ?> dans le thème <?= $req['titre_cat'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>