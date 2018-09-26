<?php

require('controller/frontend.php');


if(isset($_GET['action'])){
	if($_GET['action'] == "connection"){
		listPosts();
	}
	if($_GET['action'] == "home"){
		home();
	}
	if($_GET['action'] == "postUnique" && $_GET['id'])
	{
		postUnique($_GET['id']);
	}
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

}
else
{
	home();
}