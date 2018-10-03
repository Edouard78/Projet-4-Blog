<?php
session_start();
require('controller/frontend.php');


if(isset($_GET['action'])){

	if ($_GET['action'] == 'connexion' && isset($_POST['login']))
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		authentication($login, $password);
		header('Location: index.php');

	}

	if($_GET['action'] == 'subscribePage')
	{
		subscribePage();
	}
	if($_GET['action'] == 'subscribe' && isset($_POST['login']))
	{   

		if (!$_POST['password'] == $_POST['password2'])
		{
			$alertMsg = 'Les mots de passe ne sont pas identiques';
		}
		else
		{
		$data = array('login' => $_POST['login'], 'password' => $_POST['password'], 'email' => $_POST['email'] );
        subscribe($data);
        }
	}

	if($_GET['action'] == 'adminPage'){
		listPosts();
	}


	if($_GET['action'] == "home"){
		home();
	}
	if($_GET['action'] == "postUnique" && $_GET['id'])
	{
		postUnique($_GET['id']);
	}
	if($_GET['action'] == 'addComment' && isset($_POST['author']) && $_GET['postId'] && isset($_POST['comment']))
	{
		$data = array('postId' => $_GET['postId'], 'author' => $_POST['author'], 'comment' => $_POST['comment']);
		addComment($data);

		header('Location: index.php?action=postUnique&id='.$_GET['postId']);
	}

// ADMINISTRATION

	if($_GET['action'] == 'addPost' && isset($_POST['author']))
	{
		$data = array('author' => $_POST['author'] , 'title' => $_POST['title'] , 'content' => $_POST['content']);

		addPost($data);
		header('Location: index.php?action=connection');
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
		header('Location: index.php');
	}

	if($_GET['action'] == 'commentsAdmin')
	{
		listComments();
	}

	
}

else
{
	home();
}