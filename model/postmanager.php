<?php

class PostManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

	public function addPost(Post $post)
	{
		$req = $this->_db->prepare('INSERT INTO posts(author, title, content, contentResume, creationDate, updatingDate) VALUES(:author, :title, :content, :contentResume, NOW(), NOW() )');

    $req->bindValue(':title', $post->title());
    $req->bindValue(':author', $post->author());
	$req->bindValue(':content', $post->content());
	$req->bindValue(':contentResume', $post->contentResume());
    $req->execute();
	}

	public function count()
	{
    return $this->_db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
	}

	public function delete($id)
	{
		$id = (int) $id;
    $req = $this->_db->prepare('DELETE FROM posts WHERE id = :id');
    $req->bindValue(':id', $id );
    $req->execute();
	}

	public function getList($start , $end){

		$request = $this->_db ->prepare('SELECT id, title, author, content, contentResume, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr, DATE_FORMAT(updatingDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updatingDateFr  FROM posts ORDER BY creationDateFr DESC LIMIT :start ,:end');
		$request->bindValue(':start', $start, PDO::PARAM_INT);
		$request->bindValue(':end', $end, PDO::PARAM_INT);
	    $request->execute();
		return $request;
	}

	public function countPosts()
	{
		$req = $this->_db->prepare('SELECT COUNT(id) AS postsNb FROM posts');
		$req->execute();
		return $req;
	}

		public function getListForAdmin(){
 
		$req = $this->_db ->prepare('SELECT id, title FROM posts');
		$req->execute();
		return $req;
	}

	public function getUnique($id)
	{
		$request = $this->_db->prepare('SELECT id, title, author, content,DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDateFr FROM posts WHERE id = ?');
			$request->execute(array($id));

			return $request;
	}

	public function update(Post $post)
	{
		$request = $this->_db->prepare('UPDATE posts SET author = :author, title = :title, content = :content, updatingDate = NOW() WHERE id = :id');

    $request->bindValue(':title', $post->title());
    $request->bindValue(':author', $post->author());
    $request->bindValue(':content', $post->content());
    $request->bindValue(':id', $post->id());

    $request->execute();
	}

}
