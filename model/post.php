<?php

namespace monsite\model

use controller\Model


class Post extends Model
{

    /**
     * Pour afficher le dernier chapitre en home
     * vue home/index
     * @return \PDOStatement
     */
    public function lastPost()
    {
        $sql = 'SELECT id, titre, text, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_fr FROM blog ORDER BY date DESC LIMIT 0,1';
        $posts = $this->executeRequest($sql);
        return $posts;
    }


    /**
     * Pour afficher tous les posts
     * @return PDOStatement
     */
    public function getPosts()
    {
        $sql = 'SELECT p.id, titre, text, DATE_FORMAT(p.date_creation, \'%d/%m/%Y\') AS date_fr, count(c.id) as nbcomment FROM blog as p 
        LEFT JOIN comment as c ON p.id = c.post_id GROUP BY p.id ORDER BY p.date';
        $posts = $this->executeRequest($sql);
        return $posts;
    }

    /**
     * Pour afficher le contenu d'un post
     * @param $postId
     * @return mixed
     * @throws Exception
     */
    public function getPost($postId)
    {
        $sql = 'SELECT id, titre, text, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_fr FROM blog WHERE id = ?';
        $post = $this->executeRequest($sql, array($postId));

        if($post->rowCount() > 0) // RowCount retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement
        {
            return $post->fetch(); // Accès à la 1e ligne de résultat
        }

        else
        {
            throw new \Exception('Aucun billet ne correspond à l\'identifiant suivant : ' .$postId . '.<br/>');
        }
    }


    /**
     * Méthode pour compter le nombre de posts publiés.
     * count permet de compter le nombre d'enregistrement dans la table.
     * @return mixed
     */
    Public function getNumberPosts()
    {
        $sql = 'SELECT count(*) as nbTitre from blog';
        $result = $this->executeRequest($sql);
        $line = $result->fetch(); // Le résultat comporte toujours une ligne
        return $line['nbPosts'];
    }


    /**
     * Méthode ajouter un post
     */
    public function addPost($titre, $text)
    {
        $sql = 'INSERT INTO blog(titre, text, date_creation)' . ' values(?,?, NOW())';
        $post = $this->executeRequest($sql, array($titre, $text));
        return $post;
    }


    /**
     * Méthode mettre à jour un post
     */
    public function updatePost($titre, $text, $id)
    {
        $sql = 'UPDATE blog SET titre = ? , text = ? WHERE id = ?';
        $post = $this->executeRequest($sql, array($titre, $text, $id));
        return $post;
    }


    /**
     * Méthode supprimer un post
     */
    public function deletePost($id)
    {
        $sql = 'DELETE FROM blog WHERE id = ?';
        $post = $this->executeRequest($sql, array($id));
        return $post;
    }

}
