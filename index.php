<?php
ob_start(); 
session_start();
require ('controller/controller.php');


try {
if (isset($_GET['action']))
	{

	/*  USER LOGIN AND SUBSCRIBE   */

	/*---------------------------------------
	USER LOGIN
	----------------------------------------*/

	if ($_GET['action'] == 'connexion' && isset($_POST['login']))
		{
		$login = $_POST['login'];
		$password = $_POST['password'];
		authentication($login, $password);

		}
	elseif ($_GET['action'] == 'authenticationPage')
		{
		authenticationPage();
		}
	elseif ($_GET['action'] == 'adminPage')
		{
		listPosts(0, 5);
		}
	elseif ($_GET['action'] == 'disconnect')
		{
		session_destroy();
		header('Location: index.php');
		}

	/*---------------------------------------
	USER SUBSCRIBE
	----------------------------------------*/

	elseif ($_GET['action'] == 'subscribe' && isset($_POST['login']))
		{
		$data = array(
			'login' => $_POST['login'],
			'password' => $_POST['password'],
			'password2' => $_POST['password2'],
			'email' => $_POST['email']
		);
		subscribe($data);
		}
	elseif ($_GET['action'] == 'subscribePage')
		{
		subscribePage();
		}


	/* GUEST/USER SECTION */

	/*---------------------------------------
	HOME PAGE
	----------------------------------------*/

	// HOME PAGE

	elseif ($_GET['action'] == "home" && !isset($_GET['page']))
		{
		$postsListsNb = countPostsLists();
		home($postsListsNb, 1);
		}
	// HOME PAGE NUMBER X

	elseif ($_GET['action'] == "home" && isset($_GET['page']))
		{
		$postsListsNb = countPostsLists();

		// NEXT HOME PAGE

		if ($_GET['page'] <= 0)
			{
			header('Location: index.php?action=home');
			}

		// PREVIOUS HOME PAGE

		elseif ($_GET['page'] > $postsListsNb + 1)
			{
			$end = intval($_GET['page']) - 1;
			header('Location: index.php?action=home&page=' . $end);
			}
		  else
			{
			home($postsListsNb, $_GET['page']);
			}
		}

	/*---------------------------------------
	POST UNIQUE PAGE
	----------------------------------------*/

	elseif ($_GET['action'] == "postUnique")
	{
	if (isset($_GET['id']) && $_GET['id'] > 0)
		{
		postUnique($_GET['id']);
		}
	else
	{
		throw new Exception('Aucun identifiant de billet envoyé');
	}
}

// --------------------------------------------------------SESSION -----------------------------------------------------//

	elseif (isset($_SESSION['login']) && isset($_SESSION['admin'])){

		// ADD COMMENT

	if ($_GET['action'] == 'addComment')
	{
	if( isset($_POST['author']) && isset($_POST['comment']) && isset($_GET['postId']) )
		{
		$data = array(
			'postId' => $_GET['postId'],
			'author' => $_POST['author'],
			'comment' => $_POST['comment']
		);
		addComment($data);
		}
}
	

	// REPORT COMMENT

	elseif ($_GET['action'] == 'reportComment')
		{
			if(isset($_GET['commentId']) && isset($_GET['postId']) && $_GET['commentId'] > 0 && $_GET['postId'] > 0 )
			{
		verifyReport($_GET['commentId'], $_SESSION['id'], $_GET['postId']);
		}
		else
		{
			throw new Exception('Aucun identifiant de billet ou de commentaire envoyé');
		}

	}

	/*  ADMIN SECTION  */

	/*---------------------------------------
	POSTS ADMIN SECTION
	----------------------------------------*/

	// POSTS  HANDLER PAGE

		if($_SESSION['admin'] == TRUE)
		{

	if ($_GET['action'] == 'postsAdmin')
		{
		listPosts();
		}

	// ADD POST

	elseif ($_GET['action'] == 'addPostPage')
		{
		addPostPage();
		}
	elseif ($_GET['action'] == 'addPost' && isset($_POST['author']))
		{
		 $author = strip_tags(trim($_POST['author']));
		 $title = strip_tags(trim($_POST['title']));
		$content = strip_tags(trim($_POST['content']));

		$data = array(
			'author' => $author,
			'title' => $title,
			'content' => $content
		);
		addPost($data);
		listPosts(0, 5);
		}

	// UPDATE POST

	elseif ($_GET['action'] == 'updatePostDirection'){
	if (isset($_GET['id']) && $_GET['id'] > 0)
		{
		updatePostPage($_GET['id']);
		}
	else
	{
		throw new Exception('Aucun identifiant de billet envoyé');
	}
}
	
	elseif ($_GET['action'] == 'updatePost')
	{
	if (isset($_GET['id']) && $_GET['id'] > 0)
	{
	     
		$data = array(
			'id' => $_GET['id'],
			'author' => $_POST['author'],
			'title' => $_POST['title'],
			'content' => $_POST['content']
		);

		$id = $_GET['id'];

		updatePost($data, $id);
		}
		else {
		throw new Exception('Aucun identifiant de billet envoyé');
		}
	}
	// DELETE POST

	elseif ($_GET['action'] == 'deletePost' && isset($_GET['id']))
		{
		deletePost($_GET['id']);
		listPosts(0, 5);
		}

	/*---------------------------------------
	COMMENTS ADMIN SECTION
	----------------------------------------*/

	// COMMENTS HANDLER PAGE

	elseif ($_GET['action'] == 'commentsAdmin')
		{
		listComments();
		}

	// DELETE COMMENTS

	elseif ($_GET['action'] == 'deleteComment') {
	if (isset($_GET['id']) && $_GET['id'] > 0)
		{
		deleteComment($_GET['id']);
		header('Location: index.php?action=commentsAdmin');
		}
	else{
		throw new Exception('Aucun identifiant de commentaire envoyé');
	}
}

	/*---------------------------------------
	USER ADMIN SECTION
	----------------------------------------*/

	// USERS HANDLER PAGE

	elseif ($_GET['action'] == 'usersAdmin')
		{
		listUsers();
		}

	// UPDATE USER

	elseif ($_GET['action'] == 'updateUser' )
	{
		if(isset($_POST['admin']))
		{
			if( isset($_GET['id']) && $_GET['id'] > 0)
		  	{
			$data = array(
			'id' => $_GET['id'],
			'admin' => $_POST['admin']
			);
			updateUser($data);
			listUsers();
			}
			else{
			throw new Exception('Aucun identifiant dutilisateur envoyé');
			}
		}
		else{
			throw new Exception('Aucune valeur de status dutilisateur envoyée');
		}
	}

	// DELETE USER

	elseif ($_GET['action'] == 'deleteUser')
	{
	if (isset($_GET['id']) && $_GET['id'] > 0)
		{
		deleteUser($_GET['id']);
		listUsers();
		}
	else{
		throw new Exception('Aucun identifiant dutilisateur envoyé');
	}
	 }
	 
	else{
		throw new Exception('Vous n\'avez pas les droits pour accéder à cette page');
	}
	}
	else{
		
	if ($_GET['action'] == 'userPage')
	{
	listUserInfos($_SESSION['id']);
	}
	else{
		throw new Exception('Vous n\'avez pas les droits pour accéder à cette page');
	}

	}
}
	else{
		throw new Exception('Vous n\'avez pas les droits pour accéder à cette page');
	}
	}
  else
	{
	$postsListsNb = countPostsLists();
	home($postsListsNb, 1);
	}

}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
