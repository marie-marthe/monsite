<?php
    session_start();

    include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

    if (!isset($_SESSION['id'])){
        header('Location: creer_article');
        exit;
    }

    if($_SESSION['role'] <> 1){
        header('Location: creer_topic');
        exit;
    }

    if(!empty($_POST)){
        extract($_POST);
        $valid = true;

        if (isset($_POST['creer-article'])){

            $titre  = (string) htmlentities(trim($titre)); 
            $contenu = (string) htmlentities(trim($contenu)); 
            $categorie = (int) htmlentities(trim($categorie));

            if(empty($titre)){
                $valid = false;
                $er_titre = ("Il faut mettre un titre");
            }       

            if(empty($contenu)){
                $valid = false;
                $er_contenu = ("Il faut mettre un contenu");
            }       

            if(empty($categorie)){ 
                $valid = false;
                $er_categorie = "Le thème ne peut pas être vide";

            }else{
                // On vérifit que le mail est disponible
                $verif_cat = $DB->query("SELECT id, titre 
                    FROM categorie 
                    WHERE id = ?",
                    array($categorie));

                $verif_cat = $verif_cat->fetch();

                if (!isset($verif_cat['id'])){
                    $valid = false;
                    $er_categorie = "Ce thème n'existe pas";
                }
            }

            if($valid){

                $date_creation = date('Y-m-d H:i:s');        
                $DB->insert("INSERT INTO blog (id_user, titre, text, date_creation, id_categorie) VALUES 
                    (?, ?, ?, ?, ?)", 
                    array($_SESSION['id'], $titre, $contenu, $date_creation, $categorie));

                header('Location: /profil');
                exit;
            }
        }
    }

?>

<?php $this->title = "Billet pour l'Alaska - Administration"; ?>


<div class="breadcrumb">
    <li><a href="admin/creer_article"> >> Ajouter un chapitre </a></li>
</div>



<form method="post" action="admin/creer_article">

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <!-- affiche l'erreur en fonction de la condition dans laquelle tu arrives.
                    Boucle foreach car on appelle une erreur insérée dans un tableau.-->
                    <?php foreach ($errors as $error): ?>
                        Erreur : <?= $error ?><br/>
                    <?php endforeach; ?>


                    <div class="sub-title">Titre :</div>
                    <input value="<?= $titre ?>" type="text" name="title" class="form-control" size="53" max="600" placeholder="Saisissez votre titre">
                    <br/>
                    <div class="sub-title">Contenu : </div>
                    <textarea name="content"><?= $text?></textarea>
                    <br/>
                    <button type="submit" class="btn btn-default">Enregistrer</button>


                </div>
            </div>
        </div>
    </div>

</form></html>