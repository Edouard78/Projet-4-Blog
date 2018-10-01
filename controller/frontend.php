<?php

require_once('/../model/post.php');
require_once('/../model/postManager.php');
require_once('/../model/comment.php');
require_once('/../model/commentManager.php');


//Admin

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

function listComments()
{
    include('/../model/db.php');
	$commentManager = new CommentManager($db);
	$comments = $commentManager->getListForAdmin();
	var_dump($comments);
   
	$postManager = new PostManager($db);
	$posts = $postManager->getListForAdmin();



    var_dump($posts);
	require('/../view/admin/commentsView.php');
}


// Front


function home()
{
	include('/../model/db.php');

    $postManager = new PostManager($db);
    $posts = $postManager->getList();

    require('/../view/homeView.php');


}

function postUnique($id)
{
	include('/../model/db.php');

	$postManager = new PostManager($db);
	$post = $postManager->getUnique($id);

	$commentManager = new CommentManager($db);
	$comments = $commentManager->getList($id);

	require('/../view/postUniqueView.php');
}

function addComment($data)
{
	include('/../model/db.php');

	$comment = new Comment($data);

	$commentManager = new CommentManager($db);

	$commentManager->addComment($comment);

}
