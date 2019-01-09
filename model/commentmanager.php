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
	$request = $this->_db->prepare('INSERT INTO comments(postId, author, comment, creationDate, reportedTimes) VALUES(:postId, :author, :comment, NOW(), 0)');

    $request->bindValue(':postId', $comment->postId());
    $request->bindValue(':author', $comment->author());
    $request->bindValue(':comment', $comment->comment());
    $request->execute();
	}

	public function getList($postId)
	{
		$req = $this->_db->prepare('SELECT id, postId, author, comment, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr FROM comments WHERE postId = ? ORDER BY creationDateFr ASC');
    $req->execute(array($postId));

    return $req;
	}

	public function getListForAdmin()
	{
		$req = $this->_db->prepare('SELECT id, postId, author, comment, reportedTimes, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr FROM comments ORDER BY reportedTimes DESC');
    $req->execute();

    return $req;
	}

	public function delete($id)
	{
		$id = (int) $id;
	  $req = $this->_db->prepare('DELETE FROM comments WHERE id = :id');
	  $req->bindValue(':id', $id);
	  $req->execute();
	  
	}

	public function deleteFromPost($id)
	{
		$id = (int) $id;
	  $req = $this->_db->prepare('DELETE FROM comments WHERE postId = :id');
	  $req->bindValue(':id', $id);
	  $req->execute();
	  
	}

	public function reportComment($id)
	{
			$req = $this->_db->prepare('UPDATE comments SET reportedTimes = reportedTimes + 1 WHERE id = :id ');
			$req->bindValue(':id', $id);
			$req->execute();
	}

	public function getId($id)
	{   
		$id = (int) $id;
		$req = $this->_db->prepare('SELECT id FROM comments WHERE postId = :id');
		$req->bindValue(':id', $id);
		$req->execute();
	
		return $req;
	}

	
}
