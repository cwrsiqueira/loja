<?php
class Company extends model {

	public function getCompany() {
		$dados = array();

		$sql = $this->db->query("SELECT * FROM company WHERE id = 1");

		$dados = $sql->fetch();

		return $dados;
	}

}