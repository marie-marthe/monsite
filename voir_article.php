<?php
    session_start();

include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD


$req = $DB->query("SELECT b.*, u.prenom, u.nom, c.titre as titre_cat
        FROM blog b
        LEFT JOIN utilisateur u ON u.id = b.id_user
        LEFT JOIN categorie c ON c.id_categorie = b.id_categorie
        ORDER BY b.date_creation DESC");

$req = $req->fetchAll();

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


        <div class="container">
            <div class="row" style="margin-top: 20px">  

                <div class="col-sm-12 col-md-12 col-lg-12">                 

                    <a class="btn btn-primary" href="http://localhost:8888/monsite/index.php" role="button">Retour</a>
                    <?php
                    if(!isset($_SESSION['id'])){
                        ?>

                        <?php
                    }
                    ?>
                    <?php
                    foreach($req as $r){
                        ?>
                        <div style="margin-top: 20px; background: white; box-shadow: 0 5px 10px rgba(0, 0, 0, .09); padding: 5px 10px; border-radius: 10px">
                            <a href="blog/<?= $r['id'] ?>" style="color: #666; text-decoration: none; font-size: 28px;"><?= $r['titre'] ?></a>
                            <div style="border-top: 2px solid #EEE; padding: 15px 0">
                                <?= nl2br($r['text']); ?>
                            </div>
                            <div style="padding-top: 15px; color: #ccc; font-style: italic; text-align: right;font-size: 12px;">
                                Fait par  <?= $r['nom'] . " " . $r['prenom'] ?> le <?= date_format(date_create($r['date_creation']), 'D d M Y a H:i');?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <h3>Laisser un commentaire</h3>

                    <form method="post">

                        <?php
                        // S'il y a une erreur sur la catégorie alors on affiche
                        if (isset($er_categorie)){
                            ?>
                            <div class="er-msg"><?= $er_categorie ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <div class="input-group mb-3">


                                <?php
                                $req_cat = $DB->query("SELECT * FROM forum");

                                $req_cat = $req_cat->fetchALL();

                                foreach($req_cat as $rc){
                                    ?>
                                    <option value="<?= $rc['id'] ?>"><?= $rc['titre'] ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        if (isset($er_titre)){
                            ?>
                            <div class="er-msg"><?= $er_titre ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Pseudo" name="titre" value="<?php if(isset($titre)){ echo $titre; }?>">
                        </div>
                        <?php
                        if (isset($er_contenu)){
                            ?>
                            <div class="er-msg"><?= $er_contenu ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" placeholder="Decrivez votre impression" name="contenu"><?php if(isset($contenu)){ echo $contenu; }?></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="creer-topic">Envoyer</button>
                        </div>

                    </form>

                </div>

                </section>
            </div>
        </div>
        </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>