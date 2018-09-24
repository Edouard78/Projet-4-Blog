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
		$request = $this->_db->prepare('INSERT INTO posts(author, title, content, creationDate, updatingDate) VALUES(:author, :title, :content, NOW(), NOW() )');

    $request->bindValue(':title', $post->title());
    $request->bindValue(':author', $post->author());
    $request->bindValue(':content', $post->content());

    $request->execute();
	}

	public function count()
	{
    return $this->_db->query('SELECT COUNT(*) FROM posts')->fetchColumn();
	}

	public function delete($id)
	{
		$id = (int) $id;
    $this->_db->exec('DELETE FROM posts WHERE id = $id');
	}

	public function getList(){

		$request = $this->_db ->query('SELECT id, title, content, creationDate FROM posts ORDER BY creationDate DESC LIMIT 0, 5');

		return $request;
	}

	public function getUnique($id)
	{
		$request = $this->_db->prepare('SELECT id, title, author, content, creationDate, updatingDate FROM posts WHERE id = ?');
			$request->execute(array($id));

			return $request;
	}

	public function update(Post $post)
	{
		$request = $this->_db->prepare('UPDATE posts SET author = :author, title = :title, content = :content, updatingDate = NOW() WHERE id = :id');

    $request->bindValue(':title', $post->title());
    $request->bindValue(':author', $post->author());
    $request->bindValue(':content', $post->content());
    $request->bindValue(':id', $post->id(), PDO::PARAM_INT);

    $request->execute();
	}
}
