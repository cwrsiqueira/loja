<?php 

class Users extends model {

	public function emailExists($email) {

		$sql = $this->db->prepare("SELECT * FROM users WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function validate($email, $password) {
		$dados = array();

		$sql = $this->db->prepare("SELECT id FROM users WHERE email = :email AND password = :password");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', md5($password));
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch()['id'];
		}

		return $dados;
	}

	public function createUser($name, $email, $password) {

		$sql = $this->db->prepare("INSERT INTO users SET name = :name, email = :email, password = :password");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', md5($password));
		$sql->bindValue(':name', $name);
		$sql->execute();

		return $this->db->lastInsertId();
	}

	public function userContact($name, $email, $phone, $msg) {

		$sql = $this->db->prepare("INSERT INTO user_contacts SET name = :name, email = :email, phone = :phone, msg = :msg");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':phone', $phone);
		$sql->bindValue(':name', $name);
		$sql->bindValue(':msg', $msg);
		$sql->execute();

		return true;
	}

	public function userNewsletter($email) {

		$sql = $this->db->prepare("INSERT INTO user_newsletter SET email = :email, subscribe_date = NOW()");
		$sql->bindValue(':email', $email);
		$sql->execute();

		return true;
	}
}