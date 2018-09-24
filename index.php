<?php

require('controller/frontend.php');


if(isset($_GET['action'])){
if($_GET['action'] == 'addPost' && isset($_POST['author']))
  {
  	$data = array('author' => $_POST['author'] , 'title' => $_POST['title'] , 'content' => $_POST['content']);

    addPost($data);
    header('Location: index.php');
  }
 if($_GET['action'] == 'updatePostDirection' && isset($_GET['id'])){
 
  updatePostPage($_GET['id']);

  if ($_GET['action'] == 'updatePost' && isset($_POST['author']))
  {
  	$data = array('id' => $_GET['id'], 'author' => $_POST['author'], 'title' => $_POST['title'], 'content' => $_POST['content']);
  	updatePost($data);
  }
}

}else
{
	
listposts();
}