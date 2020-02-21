<?php 

class Purchases extends model {

	public function createPurchase($id, $total, $payment_type) {

		$sql = $this->db->prepare("INSERT INTO purchases SET id_client = :id, total_amount = :total, payment_type = :payment_type, payment_status = 1, date_purchase = NOW(), date_status = NOW()");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':total', $total);
		$sql->bindValue(':payment_type', $payment_type);
		$sql->execute();

		return $this->db->lastInsertId();
	}

	public function addItem($id_purchase, $item_id, $item_qt, $item_price) {

		$sql = $this->db->prepare("INSERT INTO purchases_products SET id_purchase = :id_purchase, id_product = :item_id, quantity = :item_qt, product_price = :item_price");
		$sql->bindValue('id_purchase', $id_purchase);
		$sql->bindValue('item_id', $item_id);
		$sql->bindValue('item_qt', $item_qt);
		$sql->bindValue('item_price', $item_price);
		$sql->execute();
		
	}

	public function setPaid($ref, $status) {

		$sql = $this->db->prepare("UPDATE purchases SET payment_status = :payment_status, date_status = NOW() WHERE id = :id");
		$sql->bindValue(':id', $ref);
		$sql->bindValue(':payment_status', $status);
		$sql->execute();
	}

	public function updateBilletUrl($id_purchase, $link) {

		$sql = $this->db->prepare("UPDATE purchases SET billet_link = :link WHERE id = :id");
		$sql->bindValue(':id', $id_purchase);
		$sql->bindValue(':link', $link);
		$sql->execute();

	}
}