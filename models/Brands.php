<?php
class Brands extends model {

	public function getList() {
		$array = array();

		$sql = $this->db->query("SELECT * FROM brands");

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getNameById($id) {

		$sql = "SELECT name FROM brands WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data['name'];
		} else {
			return '';
		}

	}

}