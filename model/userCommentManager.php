<?php

class UserCommentManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
    }
    
    public function countVerify($commentId, $userId)
    {
		$req = $this->_db->prepare('SELECT COUNT(id) AS nb FROM userComment WHERE userId = :userId and commentId = :commentId');
        $req->bindValue(':commentId', $commentId);
        $req->bindValue(':userId',$userId);
        $req->execute();

        return $req;
    }

    public function create(Usercomment $userComment)
    {
        $request = $this->_db->prepare('INSERT INTO userComment(commentId, userId) VALUES(:commentId, :userId)');

        $request->bindValue(':commentId', $userComment->commentId());
        $request->bindValue(':userId', $userComment->userId());
    
        $request->execute();
    }

    public function delete($id)
    {
        $id = (int) $id;
        $req = $this->_db->prepare('DELETE FROM usercomment WHERE commentId = :id');
        $req->bindValue(':id', $id);
        $req->execute();
    }
}
