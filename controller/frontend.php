<?php

require('/../model/post.php');
require('/../model/postManager.php');


function addPost($donnees)
{
include('/../model/db.php');

  $post = new Post($donnees);
	$postManager = new PostManager($db);
	$postManager->addPost($post);
}
