<?php
    session_start(); // Permet de savoir s'il y a une session. C'est à dire si un utilisateur c'est connecté à votre site.

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
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Accueil</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
                            <a class="nav-link" href="f_blog/blog.php">Gestion des Articles</a>
                        </li>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="f_forum/forum.php">Gestion des Commentaires</a>
                        </li>

                        	<li class="nav-item">
	                            <a class="nav-link" href="deconnexion">Deconnexion</a>
        	                </li>
                	    <?php
	                } 
        	    ?>

	        </ul>
	    </div>
	</nav>
        <div class="container">
 	   <div class="row">   

	        <div class="col-0 col-sm-0 col-md-2 col-lg-3"></div>
	        <div class="col-12 col-sm-12 col-md-8 col-lg-6">

                <section class="banner style2">

                    <div class="content">
                        <a href="index.php"><h1>Billet simple pour l'Alaska</h1></a>
                        <h2>par Jean Forteroche,<br/>acteur et ecrivain</h2>
                        <br/>

	            <div>
        	        <?php
                	    if(!isset($_SESSION['id'])){
                        	?>

        	                <?php
                	    }
	                ?>
        	    </div>
	            <div>
        	            <?php
	                    if(isset($_SESSION['id'])){
	                    } 
        	            ?>

                    <div class="image">
                        <img src="content/html5up-story/images/alaska.png" alt="" />
                    </div>

                            <p class="major">Bienvenue sur mon nouveau blog ! <br/> Pour mon <b>prochain ouvrage</b>, j'ai decide d'innover
                                et de rendre ce livre <b>interactif</b>.

                                <br/>' Bienvenue en Alaska' ne sera ecrit avec vous, chers lecteurs.
                                <br/> <b>Je vous propose de decouvrir un chapitre de ce nouveau roman chaque semaine.
                                    <br/> </b>N'hesitez pas a <b>commenter chacun d'entre eux.
                                    <br/></b>Je vous ferai des retours.
                                <br/>Bonne lecture !</p>
                        </div>


                    </section>


                    <section class="spotlight style1 orient-right content-align-center">

                        <div class="content">
                            <h3 class="intro">Lisez et appreciez le dernier chapitre:</h3>

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

                            <div class="button"><a href="f_blog/blog.php"> Decouvrez les precedents chapitres !</a></div>

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