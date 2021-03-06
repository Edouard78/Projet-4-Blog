<?php

class Post
{
	protected $_id,
	          $_author,
			  $_title,
			  $_content,
			  $_contentResume,
			  $_creationDate,
			  $_updatingDate,
			  $_errors=[];

	const INVALID_AUTHOR = 1;
	const INVALID_TITLE = 2;
	const INVALID_CONTENT = 3;

	
  public function __construct($data)
	{
		$this->hydrate($data);
	}

  public function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);

		  if (method_exists($this, $method))
		  {
			  $this->$method($value);
		  }
		}
			
	}

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
		return $this->_content;
	}

	public function contentResume()
	{
		return $this->_contentResume;
	}

	public function creationDate()
	{
		return $this->_creationDate;
	}

	public function updatingDate()
	{
		return $this->_updatingDate;
	}

	public function errors()
	{
		return $this->_errors;
	}


  //SETTERS

	public function setId($id)
	{
		$id = (int)$id;

		$this->_id = $id;
	}

	public function setAuthor($author)
	{
		if (!is_string($author) || empty(trim($author)) )
		{
			$this->_errors[]=self::INVALID_AUTHOR;
		}
		else
		{
			$this->_author = $author;
		}
	}

	public function setTitle($title)
	{
		if (!is_string($title) || empty(trim($title)) )
		{
			$this->_errors[]=self::INVALID_TITLE;
		}
		else
		{
			$this->_title = $title;
		}
	}

	public function setContent($content)
	{
		
		// NETTOYAGE DES DONNEES RECU DU MODULE TINY MCE
		$cleanContent = strip_tags($content);
		$cleanContent = str_replace("&nbsp;","",$cleanContent);
		$cleanContent = trim($cleanContent);

		if (!is_string($content) || empty($cleanContent) )
		{
			$this->_errors[]=self::INVALID_CONTENT;
		}
		else
		{
			$this->_content = $content;
			$this->_contentResume = substr(strip_tags($content), 0, 30);
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
