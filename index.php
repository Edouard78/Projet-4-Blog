<?php
session_start();
require('controller/frontend.php');


if(isset($_GET['action'])){
	if($_GET['action'] == 'reportComment' && isset($_GET['commentId']) && isset($_GET['postId']))
	{   
		verifyReport($_GET['commentId'], $_SESSION['id'], $_GET['postId'] );
        
	}

	if ($_GET['action'] == 'connexion' && isset($_POST['login']))
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		authentication($login, $password);
		

	}

	if($_GET['action'] == 'authenticationPage')
	{
		authenticationPage();
	}

	if($_GET['action'] == 'disconnect'){
		session_destroy();
		header('Location: index.php');
	}

	if($_GET['action'] == 'subscribePage')
	{
		subscribePage();
	}
	if($_GET['action'] == 'subscribe' && isset($_POST['login']))
	{   
		$data = array('login' => $_POST['login'], 'password' => $_POST['password'], 'password2' => $_POST['password2'],  'email' => $_POST['email'] );
        subscribe($data);

	}

	if($_GET['action'] == 'adminPage'){
		listPosts(0,5);
	}

	if ($_GET['action'] == 'userPage')
	{
		listUserInfos($_SESSION['id']);
	}


	if ($_GET['action'] == "home" && !isset($_GET['homePage']))
	{
	   $postsListsNb = countPostsLists();

	   home($postsListsNb,0, 5);
	}

	elseif ($_GET['action'] == "home" && isset($_GET['homePage']) )
	{
		$postsListsNb = countPostsLists();
		
		$postsNb = $postsListsNb * 5;
// Boutton précedent		
		if($_GET['homePage'] == 0)
		{
			header('Location: index.php?action=home');
		}
// Boutton suivant
		elseif ($_GET['homePage'] >= $postsNb + 5)
		{
		$end = intval($_GET['homePage']) - 5 ;
		header('Location: index.php?action=home&homePage='.$end);
		}

		else
		{
		$start = intval($_GET['homePage']) - 5;
		$end = intval($_GET['homePage']);

		
		$postsListsNb = countPostsLists();
	   home($postsListsNb, $start, $end);
		}
	}

	if($_GET['action'] == "postUnique" && $_GET['id'])
	{
		postUnique($_GET['id']);
	}
	if($_GET['action'] == 'addComment' && isset($_POST['author']) && $_GET['postId'] && isset($_POST['comment']))
	{
		$data = array('postId' => $_GET['postId'], 'author' => $_POST['author'], 'comment' => $_POST['comment']);
		var_dump($data);
		addComment($data);


		header('Location: index.php?action=postUnique&id='.$_GET['postId']);
	}

// ADMINISTRATION

if($_GET['action'] == 'addPostPage')
{
	addPostPage();
	
}

	if($_GET['action'] == 'addPost' && isset($_POST['author']))
	{
		$data = array('author' => $_POST['author'] , 'title' => $_POST['title'] , 'content' => $_POST['content']);

		addPost($data);
		listPosts(0,5);
		
	}
	if($_GET['action'] == 'updatePostDirection' && isset($_GET['id'])){

		updatePostPage($_GET['id']);
	}

	if ($_GET['action'] == 'updatePost' && isset($_POST['author']) && isset($_GET['id']))
	{
		$data = array('id' => $_GET['id'], 'author' => $_POST['author'], 'title' => $_POST['title'], 'content' => $_POST['content']);
		updatePost($data);
		header('Location: index.php');

	}
	if($_GET['action'] == 'deletePost' && isset($_GET['id']))
	{
		deletePost($_GET['id']);
		listPosts(0,5);

	}

	if($_GET['action'] == 'commentsAdmin')
	{
		listComments();
	}

	if($_GET['action'] == 'deleteComment' && isset($_GET['id']))
	{
		deleteComment($_GET['id']);
		header('Location: index.php?action=commentsAdmin');
	}

	if($_GET['action'] == 'postsAdmin')
	{
		listPosts(0,5);
	}

	if ($_GET['action'] == 'usersAdmin')
	{
		listUsers();
	}

	if ($_GET['action'] == 'updateUser' AND isset($_POST['admin']) AND isset($_GET['id'])){

		$data = array('id' => $_GET['id'], 'admin' => $_POST['admin'] );
		updateUser($data);
		listUsers();
	}

	if ($_GET['action'] == 'deleteUser' AND isset($_GET['id']))
	{
		deleteUser($_GET['id']);
		listUsers();

	}

	
}

else
{
	$postsListsNb = countPostsLists();
	home($postsListsNb, 0, 5);
}