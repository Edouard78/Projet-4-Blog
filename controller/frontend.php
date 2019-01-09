
<?php
require_once ('model/post.php');

require_once ('model/postManager.php');

require_once ('model/comment.php');

require_once ('model/commentManager.php');

require_once ('model/user.php');

require_once ('model/userManager.php');

require_once ('model/userComment.php');

require_once ('model/userCommentManager.php');

// Admin

function addPostPage()
{
	require ('view/admin/addPostView.php');

}

function addPost($data)
{
	include ('model/db.php');

	$post = new Post($data);
    
	$errorsFromModel = $post->errors();
	if (count($errorsFromModel) > 0)
	{
		if (in_array(Post::INVALID_AUTHOR, $errorsFromModel) OR in_array(Post::INVALID_TITLE, $errorsFromModel) OR in_array(Post::INVALID_CONTENT, $errorsFromModel) )
		{
			header('Location: index.php?action=addPostPage&errors=1');
		}

	}
	else{

	$postManager = new PostManager($db);
	$postManager->addPost($post);

	header('Location: index.php?action=postsAdmin');
	}
}

function listPosts($start, $end)
{
	include ('model/db.php');

	$postManager = new PostManager($db);
	$posts = $postManager->getList($start, $end);
	require ('view/admin/postsView.php');

}

function updatePostPage($id)
{
	include ('model/db.php');

	$postManager = new PostManager($db);
	$post = $postManager->getUnique($id);
	require ('view/admin/updatePostView.php');

}

function updatePost($data, $id)
{
	include ('model/db.php');

	$post = new Post($data);
	
	$errorsFromModel = $post->errors();

	if (count($errorsFromModel) > 0)
	{
		if (in_array(Post::INVALID_AUTHOR, $errorsFromModel) OR in_array(Post::INVALID_TITLE, $errorsFromModel) OR in_array(Post::INVALID_CONTENT, $errorsFromModel) )
		{
			header('Location: index.php?action=updatePostDirection&id='.$id.'&errors=1');
		
		}

	}
	else{
	$postManager = new PostManager($db);
	$postManager->update($post);

	header('Location: index.php?action=postsAdmin');
	}
}

function deletePost($id)
{
	include ('model/db.php');

	$postManager = new PostManager($db);
	$postManager->delete($id);
	$commentManager = new CommentManager($db);
	$result = $commentManager->getId($id);
	$commentId = $result->fetch();
	$commentManager->deleteFromPost($id);
	$userCommentManager = new UserCommentManager($db);
	$userCommentManager->delete($commentId['id']);
}

function listComments()
{
	include ('model/db.php');

	$commentManager = new CommentManager($db);
	$comments = $commentManager->getListForAdmin();
	require ('view/admin/commentsView.php');

}

function deleteComment($id)
{
	include ('model/db.php');

	$commentManager = new CommentManager($db);
	$comments = $commentManager->delete($id);
}

function listUsers()
{
	
	include ('model/db.php');

	$userManager = new UserManager($db);
	$users = $userManager->getList();
	require ('view/admin/usersView.php');

}

function updateUser($data)
{
	include ('model/db.php');
	$user = new User($data);
	$userManager = new UserManager($db);
	$userManager->update($user);

	include ('model/db.php');


}

function deleteUser($id)
{
	include ('model/db.php');

	$userManager = new UserManager($db);
	$user = $userManager->delete($id);
}

// Front
function countPostsLists()
{
	include ('model/db.php');
	$postManager = new PostManager($db);
	$result = $postManager->countPosts();

	$postsNbStr = $result->fetch();
	$postsNb = intval($postsNbStr[0]);

	$postsListsNb = $postsNb / 5;

    return $postsListsNb;
}
function home($postsListsNb, $start, $end)
{
	include ('model/db.php');

	$postManager = new PostManager($db);
	$posts = $postManager->getList($start, $end);
	require ('view/homeView.php');

}

function listUserInfos($id)
{
	include ('model/db.php');

	$userManager = new UserManager($db);
	$userInfos = $userManager->getInfos($id);
	require ('view/user/infosView.php');

}

function postUnique($id)
{
	include ('model/db.php');

	$postManager = new PostManager($db);
	$post = $postManager->getUnique($id);
	$commentManager = new CommentManager($db);
	$comments = $commentManager->getList($id);
	require ('view/postUniqueView.php');

}

function addComment($data)
{
	include ('model/db.php');

	$comment = new Comment($data);

	$errorsFromModel = $comment->errors();
	if (count($errorsFromModel) > 0)
	{
		if (in_array(Comment::INVALID_AUTHOR, $errorsFromModel) OR in_array(Comment::INVALID_COMMENT, $errorsFromModel) )
		{
			header('Location: index.php?action=postUnique&id='.$data['postId'].'&errors=1');
		}

	}
	else{
	$commentManager = new CommentManager($db);
	$commentManager->addComment($comment);

	header('Location: index.php?action=postUnique&id='.$data['postId']);
	}
}

function authentication($login, $password)
{
	include ('model/db.php');

	$userManager = new userManager($db);
	$user = $userManager->authenticationGet($login);
	$result = $user->fetch();
	$isPasswordCorrect = password_verify($password, $result['password']);

	
    if ($login != $result['login'] || !$isPasswordCorrect)
	{
		header('Location: index.php?action=authenticationPage&errors=1');
		exit();
	}

	else
	{

		session_start();
		$_SESSION['id'] = $result['id'];
		$_SESSION['login'] = $result['login'];
		$_SESSION['admin'] = $result['admin'];

        header('Location: index.php');
	
	}
}
function authenticationPage()
{
	require ('view/authenticationView.php');

}
function subscribePage()
{
	require ('view/subscribeView.php');

}

function subscribe($data)
{
	include ('model/db.php');

	$userManager = new userManager($db);
	$login = $data['login'];
	$countLogin = $userManager->countLogin($login);
	$dataCountLogin = $countLogin->fetch();
	$email = $data['email'];
	$countEmail = $userManager->countEmail($email);
	$dataCountEmail = $countEmail->fetch();
	$errors = array();
	if ($dataCountLogin['nb'] != 0)
	{
		array_push($errors, 1);
	}

	if ($_POST['password'] != $_POST['password2'])
	{
		array_push($errors, 2);
	}

	if ($dataCountEmail['nb'] != 0)
	{
		array_push($errors, 3);
	}

	$newUser = new User($data);
	$errorsFromModel = $newUser->errors();
	if (count($errorsFromModel) > 0)
	{
		if (in_array(User::INVALID_LOGIN, $errorsFromModel))
		{
			array_push($errors, 4);
		}

		if (in_array(User::INVALID_PASSWORD, $errorsFromModel))
		{
			array_push($errors, 5);
		}

		if (in_array(User::INVALID_EMAIL, $errorsFromModel))
		{
			array_push($errors, 6);
		}
	}

	if (count($errors) > 0)
	{
		$serialize = serialize($errors);
		$encode = urlencode($serialize);
		header('Location: index.php?action=subscribePage&errors=' . $encode);
	}
	else
	{
		$newUser->setAdmin(0);
		$userManager = new userManager($db);
		$userManager->createUser($newUser);
		header('Location: index.php?action=subscribePage&success=1');
	}
}

function verifyReport($commentId, $userId, $postId)
{
	include ('model/db.php');

	$userCommentManager = new UserCommentManager($db);
	$result = $userCommentManager->countVerify($commentId, $userId);
	$dataResult = $result->fetch();
	
	if ($dataResult['nb'] != 0)
	{
		header('Location: index.php?action=postUnique&id=' . $postId . '&reportError=1&commentId=' . $commentId);
	}
	else
	{
		reportComment($commentId, $userId, $postId);
	}
}

function reportComment($commentId, $userId, $postId)
{
	include ('model/db.php');

	$commentManager = new CommentManager($db);
	$commentManager->reportComment($commentId);
	$dataId = array(
		'commentId' => $commentId,
		'userId' => $userId
	);
	$userComment = new UserComment($dataId);
	
	$commentUserManager = new userCommentManager($db);
	$commentUserManager->create($userComment);
	header('Location: index.php?action=postUnique&id=' . $postId . '&reportSuccess=1&commentId=' . $commentId);
}

