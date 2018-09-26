<?php

class CommentManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

	public function addComment(Comment $comment)
	{
		$request = $this->_db->prepare('INSERT INTO comments(postId, author, comment, creationDate) VALUES(:postId, :author, :comment, NOW())');

    $request->bindValue(':postId', $comment->postId());
    $request->bindValue(':author', $comment->author());
    $request->bindValue(':comment', $comment->comment());

    $request->execute();
	}

	public function getList($postId)
	{
		$req = $this->_db->prepare('SELECT id, author, comment, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr FROM comments WHERE postId = ? ORDER BY creationDateFr DESC');
    $req->execute(array($postId));

    return $req;
	}

	public function delete($id)
	{
		$id = (int) $id;
	  $this->_db->exec('DELETE FROM comments WHERE id = $id');
	}

	
}
