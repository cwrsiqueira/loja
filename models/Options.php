<?php 

class Options extends model {

	public function getName($id) {
		$sql = $this->db->prepare("SELECT name FROM options WHERE id = :id");
		$sql->bindValue(':id', $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['name'];
		}
	}
}