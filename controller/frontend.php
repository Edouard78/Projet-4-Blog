<?php

require_once('/../model/post.php');
require_once('/../model/postManager.php');


function addPost($data)
{
include_once('/../model/db.php');

  $post = new Post($data);
	$postManager = new PostManager($db);
	$postManager->addPost($post);
}

function listPosts()
{
  include_once('/../model/db.php');

  $postManager = new PostManager($db);
  $posts = $postManager->getList();

  require_once('/../view/admin/postsView.php');

  


}
