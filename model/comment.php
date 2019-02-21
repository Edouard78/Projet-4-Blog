<?php

class Comment
{
	protected $_id,
	$_postId,
	$_author,
	$_comment,
	$_creationDate,
	$_reportedTimes,
	$_errors=[];

	CONST INVALID_AUTHOR = 1;
	CONST INVALID_COMMENT = 2;

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

	public function postId()
	{
		return $this->_postId;
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

	public function reportedTimes()
	{
	  	return $this->_reportedTimes;
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

	public function setPostId($postId)
	{
		$postId = (int)$postId;

		$this->_postId = $postId;
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

		public function setComment($comment)
		{
			if (!is_string($comment) || empty(trim($comment)) )
			{
				$this->_errors[]=self::INVALID_COMMENT;
			}
			else
			{
				$this->_comment = $comment;
			}
		}

		public function setCreationDate($creationDate)
		{
			$this->_creationDate = $creationDate;
		}

		public function setReportedTimes($reportedTimes)
		{
			$reportedTimes = (int)$reportedTimes;

			$this->_reportedTimes = $reportedTimes;
		}

	}
