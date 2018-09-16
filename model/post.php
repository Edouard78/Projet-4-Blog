<?php

class Post
{
	protected $_id,
	          $_author,
						$_title,
						$_content,
						$_creationDate,
						$_updatingDate,

	const INVALID_AUTHOR = 1;
	const INVALID_TITLE = 2;
	const INVALID_CONTENT = 3;

	//GETTERS

	public function id()
	{
		return $this->_id;
	}

	public function author()
	{
		return $this->_author;
	}

	public function title()
	{
		return $this->_title;
	}

	public function content()
	{
		return $this->content;
	}

	public function creationDate()
	{
		return $this->_creationDate;
	}

	public function updatingDate()
	{
		return $this->_updatingDate;
	}

  //SETTERS

	public function setId($id)
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
	}

	public function setTitle($title)
	{
		if (!is_string($title) || empty($title))
		{
			return self::INVALID_AUTHOR;
		}
		else
		{
			$this->_title = $title;
		}
	}

	public function setContent($content)
	{
		if (!is_string($content) || empty($content))
		{
			return self::INVALID_CONTENT;
		}
		else
		{
			$this->_content = $content;
		}
	}

	public function setCreationDate($creationDate)
	{
		$this->_creationDate = $creationDate;
	}

	public function setUpdatingDate($updatingDate)
	{
		$this->_updatingDate = $updatingDate;
	}

}
