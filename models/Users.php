<?php 

class Users extends model {

	public function emailExists($email) {

		$sql = $this->db->prepare("SELECT * FROM purchases_client WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function validate($email) {
		$dados = array();

		$sql = $this->db->prepare("SELECT id FROM users WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch()['id'];
		}

		return $dados;
	}

	public function validateClient($email) {
		$dados = array();

		$sql = $this->db->prepare("SELECT id FROM purchases_client WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch()['id'];
		}

		return $dados;
	}

	public function createUser($name, $email) {

		$sql = $this->db->prepare("INSERT INTO users SET name = :name, email = :email");
		$sql->bindValue(':email', $email);
		$sql->bindValue(':name', $name);
		$sql->execute();

		return $this->db->lastInsertId();
	}

	public function createClient($name, $cpf, $phone, $email, $areacode, $street, $number, $complement, $neighborhood, $city, $state) {
		
		//var_dump($name, $cpf, $phone, $email, $areacode, $street, $number, $complement, $neighborhood, $city, $state);exit;

		$sql = $this->db->prepare("
			INSERT INTO 
				purchases_client 
			SET 
				name = :name, 
				cpf = :cpf, 
				email = :email, 
				phone = :phone, 
				areacode = :areacode, 
				street = :street, 
				street_number = :street_number, 
				complement = :complement, 
				n_hood = :neighborhood, 
				city = :city, 
				state = :state,
				reg_date = NOW()"
			);
		$sql->bindValue(':name', $name);
		$sql->bindValue(':cpf', $cpf);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':phone', $phone);
		$sql->bindValue(':areacode', $areacode);
		$sql->bindValue(':street', $street);
		$sql->bindValue(':street_number', $number);
		$sql->bindValue(':complement', $complement);
		$sql->bindValue(':neighborhood', $neighborhood);
		$sql->bindValue(':city', $city);
		$sql->bindValue(':state', $state);
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