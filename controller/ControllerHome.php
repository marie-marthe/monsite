<?php

namespace controller

use controller\Controller
use monsite\model\Post

class ControllerHome extends Controller
{
private $post;


public function __construct()
{
$this->post = new Post();
}

/*
Affiche le dernier post publié sur le site
Appelle la methode abstraite index() du Controller.php l.36. Cette méthode oblige les classes dérivées
à implémenter cette action par défaut
*/
public function index()
{
//va chercher la méthode lasPost dans le Model/Post.php l.8
$posts = $this->post->lastPost();
// détermine la nouvelle vue. Appelle la protected function BuildView du Controller.php l.40
$this->buildView(array('posts' => $posts));

}
}