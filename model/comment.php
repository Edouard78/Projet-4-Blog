<?php

class Comment
{
	protected postId,
	          author,
						comment,
						creationDate;

  CONST INVALID_AUTHOR = 1;
	CONST INVALID_COMMENT = 2;

	//GETTERS

	public function postId()
	{
		return $this->_id;
	}

	public function author()
	{
		return $this->_author;
	}

	public function comment()
	{
		return $this->_comment;
	}

	public function creationDate()
	{
		return $this->_creationDate;
	}

	//SETTERS

	public function setPostId($id)
	{
		$id = (int)$id;

		$this->_id = $id;
	}
	public function setAuthor($author)
	{
		if (!is_string($author) || empty($author))
		{
			return self::INVALID_AUTHOR;
		}
		else
		{
			$this->_author = $author
		}

	public function setComment($comment)
	{
		if (!is_string($comment) || empty($comment))
		{
			return self::INVALID_COMMENT;
		}
		else
		{
			$this->_author = $author
		}
	}

	public function setCreationDate($creationDate)
	{
		$this->_creationDate = $creationDate;
	}
}
