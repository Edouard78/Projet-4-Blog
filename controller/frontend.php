<?php

require_once('/../model/post.php');
require_once('/../model/postManager.php');


function addPost($data)
{
include('/../model/db.php');

  $post = new Post($data);
	$postManager = new PostManager($db);
	$postManager->addPost($post);
}

function listPosts()
{
  include('/../model/db.php');

  $postManager = new PostManager($db);
  $posts = $postManager->getList();

  require('/../view/admin/postsView.php');

}

function updatePostPage($id)
{
	include('/../model/db.php');
	$postManager = new PostManager($db);
	$post = $postManager->getUnique($id);

    
	require('/../view/admin/updatePostView.php');

}

function updatePost($data)
{  

	include('/../model/db.php');
    
	$post = new Post($data);
	$postManager = new PostManager($db);
	$postManager->update($post);


}

function deletePost($id)
{
   include('/../model/db.php');
    
	
	$postManager = new PostManager($db);
	$postManager->delete($id);
}
