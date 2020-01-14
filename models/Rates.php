<?php 

class Rates extends model {

	public function getRates($id, $qt) {
		$array = array();

		$sql = $this->db->prepare("
			SELECT *,
			(select users.name from users where users.id = rates.id_user) as user_name 
			FROM rates 
			WHERE id_product = :id 
			ORDER BY date_rated 
			DESC LIMIT ".$qt);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}


		return $array;
	}
}