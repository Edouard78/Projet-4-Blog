<?php

class UserManager
{
	private $_db;

	public function __construct($db)
	{
		$this->_db = $db;
	}

	public function authenticationGet($login)
	{
		$req = $this->_db->prepare('SELECT id, login, password, admin FROM users WHERE login = :login');
		$req->execute(array(
			'login' => $login));
		return $req;
	}

	public function countLogin($login)
	{
		$req = $this->_db->prepare('SELECT COUNT(login) AS nb FROM users WHERE login = :login');
		$req->bindValue(':login', $login);
		$req->execute();
		return $req;
	}
		public function countEmail($email)
	{
		$req = $this->_db->prepare('SELECT COUNT(email) AS nb FROM users WHERE email = :email');
		$req->bindValue(':email', $email);
		$req->execute();
		return $req;
	}

	public function createUser(User $user)
	{
         $req = $this->_db->prepare('INSERT INTO users(login, password, email, admin) VALUES(:login, :password, :email, :admin)');

    $req->bindValue(':login', $user->login());
    $req->bindValue(':password', $user->password());
    $req->bindValue(':email', $user->email());
    $req->bindValue(':admin', $user->admin());

    $req->execute();
	}

	public function getInfos($id)
	{
		$req = $this->_db ->prepare('SELECT id, login, email FROM users WHERE id = :id');
		$req->bindValue(':id', $id);
		$req->execute();

		return $req;
	}

	public function getList()
	{
		$req = $this->_db ->prepare("SELECT id, login, email, admin FROM users WHERE login != 'jean'");
		$req->execute();

		return $req;
	}

	public function update(User $user)
	{
		$req = $this->_db->prepare('UPDATE users SET admin = :admin WHERE id = :id');

    $req->bindValue(':admin', $user->admin());

    $req->bindValue(':id', $user->id());

    $req->execute();
	}

	public function delete($id)
	{
		
	  $req = $this->_db->prepare('DELETE FROM users WHERE id = :id');
	  $req->bindValue(':id', $id);
	  $req->execute();

	}
}