<?php

require_once('/../model/post.php');
require_once('/../model/postManager.php');
require_once('/../model/comment.php');
require_once('/../model/commentManager.php');
require_once('/../model/user.php');
require_once('/../model/userManager.php');



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

function authentication($login, $password)
{
	include('/../model/db.php');

	$userManager = new userManager($db);
	$user = $userManager->authenticationGet($login);

	$result = $user->fetch();
	$isPasswordCorrect = password_verify($password, $result['password']);

	if($login != $result['login'])
	{
		echo 'Mauvais Identifiant';
	}
	else if (!$isPasswordCorrect)
	{
        echo 'Mauvais mot de passe';
	}
	else
	{
		session_start();
		$_SESSION['login'] = $result['login'];
		$_SESSION['access'] =  $result['access'];
		echo 'Vous êtes connecté';
		
	}


}

function subscribePage()
{
	require('/../view/subscribeView.php');
}

function subscribe($data)
{
	include('/../model/db.php');
    $userManager = new userManager($db);

    $login = $data['login'];
	$countLogin = $userManager->countLogin($login);
	$dataCountLogin = $countLogin->fetch();
	var_dump($dataCountLogin['nb']);

	$email = $data['email'];
	$countEmail = $userManager->countEmail($email);
	$dataCountEmail = $countEmail->fetch();
    var_dump($dataCountEmail['nb']);
	

	if ($dataCountLogin['nb'] != 0)
	{
		$alertMsg = 'L\'utilisateur éxiste déjà';
		var_dump($alertMsg);
	}
	else if ($dataCountEmail['nb'] != 0)
	{
		$alertMsg = 'L\'émail est déja utilisée';
		var_dump($alertMsg);
	}
	else
	{
	$newUser = new User($data);
	$newUser->setAccess('user');

	var_dump($newUser);

	$userManager = new userManager($db);
	$userManager->createUser($newUser);

	var_dump($userManager);

	}
}
	
	function reportComment($id)
	{
		include('/../model/db.php');

		$commentManager = new CommentManager($db);
		$commentManager->reportComment($id);

		echo 'Le commentaire à bien été signalé';
	}





