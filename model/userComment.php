<?php

class UserComment
{
    protected $_userId;
    protected $_commentId;

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

    // GETTERS

    public function userId()
    {
        return $this->_userId;
    }

    public function commentId()
    {
        return $this->_commentId;
    }

    //SETTERS

    public function setUserId($userId)
    {
        $userId = (int)$userId;
        $this->_userId = $userId;
    }

    public function setCommentId($commentId)
    {
        $commentId = (int)$commentId;
        $this->_commentId = $commentId;
    }
}