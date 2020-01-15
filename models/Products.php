<?php
class Products extends model {

	public function getAvailableOptions($filters = array()) {
		$groups = array();
		$ids = array();

		$where = $this->buildWhere($filters);

		$sql = $this->db->prepare("SELECT id, options FROM products WHERE ".implode(' AND ', $where));

		$this->bindWhere($filters, $sql);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			foreach ($sql->fetchAll() as $product) {
				$ops = explode(',', $product['options']);
				$ids[] = $product['id'];
				foreach ($ops as $op) {
					if(!in_array($op, $groups)) {
						$groups[] = $op;
					}
				}
			}
		}

		$options = $this->getAvailableValuesFromOptions($groups, $ids);

		return $options;

	}

	public function getAvailableValuesFromOptions($groups, $ids) {
		$array = array();
		$options = new Options();
		foreach ($groups as $op) {
			$array[$op] = array(
				'name' => $options->getName($op),
				'options' => array()
			);
		}

		$sql = $this->db->query("
			SELECT p_value, id_option, COUNT(id_option) as c
			FROM products_options
			WHERE id_option IN ('".implode("','", $groups)."')
			AND id_product IN ('".implode("','", $ids)."')
			GROUP BY p_value ORDER BY id_option");
		if ($sql->rowCount() > 0) {
			foreach ($sql->fetchAll() as $ops) {
				
				$array[$ops['id_option']]['options'][] = array(
					'id' => $ops['id_option'],
					'value' => $ops['p_value'],
					'count' => $ops['c']
				);
			}
		}

		return $array;
	}

	public function getSaleCount($filters = array()) {
		$where = $this->buildWhere($filters);

		$where[] = 'sale = "1"';

		$sql = "
		SELECT COUNT(*) as c
		FROM products 
		WHERE ".implode(' AND ', $where);
		$sql = $this->db->prepare($sql);

		$this->bindWhere($filters, $sql);

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();

			return $array['c'];
		} else {
			return '0';
		}
	}

	public function getMinPrice($filters = array()) {

		$sql = "
		SELECT price 
		FROM products 
		ORDER BY price
		LIMIT 1
		";
		$sql = $this->db->prepare($sql);

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();

			return $array['price'];
		} else {
			return '0';
		}
	}

	public function getMaxPrice($filters = array()) {

		$sql = "
		SELECT price 
		FROM products 
		ORDER BY price DESC
		LIMIT 1
		";
		$sql = $this->db->prepare($sql);

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();

			return $array['price'];
		} else {
			return '0';
		}
	}

	public function getListOfStars($filters = array()) {
		$array = array();
		$where = $this->buildWhere($filters);

		$sql = $this->db->prepare("
			SELECT rating, COUNT(id) as c 
			FROM products 
			WHERE ".implode(' AND ', $where)."
			GROUP BY rating");

		$this->bindWhere($filters, $sql);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getListOfBrands($filters = array()) {
		$array = array();

		$where = $this->buildWhere($filters);

		$sql = $this->db->prepare("
			SELECT id_brand, COUNT(id) as c 
			FROM products 
			WHERE ".implode(' AND ', $where)."
			GROUP BY id_brand");

		$this->bindWhere($filters, $sql);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getList($offset = 0, $limit = 3, $filters = array(), $random = false) {
		$array = array();

		$orderBySQL = '';
		if ($random == true) {
			$orderBySQL = 'ORDER BY RAND()';
		}

		if (!empty($filters['toprated'])) {
			$orderBySQL = 'ORDER BY rating DESC';
		}

		$where = $this->buildWhere($filters);

		$sql = "SELECT *,
		( select brands.name from brands where brands.id = products.id_brand ) as brand_name,
		( select categories.name from categories where categories.id = products.id_category ) as category_name
		FROM products
		WHERE ".implode(' AND ', $where)."
		".$orderBySQL."
		LIMIT $offset, $limit";
		$sql = $this->db->prepare($sql);

		$this->bindWhere($filters, $sql);

		$sql->execute();

		if($sql->rowCount() > 0) {

			$array = $sql->fetchAll();

			foreach($array as $key => $item) {

				$array[$key]['images'] = $this->getImagesByProductId($item['id']);

			}


		}

		return $array;
	}

	public function getImagesByProductId($id) {
		$array = array();

		$sql = "SELECT url FROM products_images WHERE id_product = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getTotal($filters = array()) {
		$where = $this->buildWhere($filters);

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM products WHERE ".implode(' AND ', $where));
		$this->bindWhere($filters, $sql);
		$sql->execute();
		$sql = $sql->fetch();

		return $sql['c'];
	}

	private function buildWhere($filters) {
		$where = array(
			'1=1'
		);

		if (!empty($filters['category'])) {
			$where[] = "id_category = :id_category";
		}

		if (!empty($filters['brand'])) {
			$where[] = "id_brand IN ('".implode("','", $filters['brand'])."')";
		}

		if (!empty($filters['star'])) {
			$where[] = "rating IN ('".implode("','", $filters['star'])."')";
		}

		if (!empty($filters['sale'])) {
			$where[] = "sale = '1'";
		}

		if (!empty($filters['featured'])) {
			$where[] = "featured = '1'";
		}

		if (!empty($filters['options'])) {
			$where[] = "id IN (select id_product from products_options where products_options.p_value IN ('".implode("','", $filters['options'])."'))";
		}

		if (!empty($filters['slider0'])) {
			$where[] = "price >= :slider0";
		}

		if (!empty($filters['slider1'])) {
			$where[] = "price <= :slider1";
		}

		if (!empty($filters['searchTerm'])) {
			$where[] = "name LIKE :searchTerm";
		}

		return $where;
	}

	private function bindWhere($filters, &$sql) {
		if (!empty($filters['category'])) {
			$sql->bindValue(':id_category', $filters['category']);
		}

		if (!empty($filters['slider0'])) {
			$sql->bindValue(':slider0', $filters['slider0']);
		}

		if (!empty($filters['slider1'])) {
			$sql->bindValue(':slider1', $filters['slider1']);
		}

		if (!empty($filters['searchTerm'])) {
			$sql->bindValue(':searchTerm', '%'.$filters['searchTerm'].'%');
		}
	}

	public function getProductInfo($id) {
		$array = array();

		if (!empty($id)) {
			
			$sql = $this->db->prepare
			("SELECT *,
			( select brands.name from brands where brands.id = products.id_brand ) as brand_name,
			( select products_images.url from products_images where products_images.id_product = :id LIMIT 1) as image
			FROM products WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$array = $sql->fetch();
			}
		}

		return $array;
	}

	public function getOptionsByProductId($id) {
		$options = array();

		$sql = $this->db->prepare("SELECT options FROM products WHERE id = :id");
		$sql->bindValue(':id', $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$options = $sql->fetch()['options'];

			if (!empty($options)) {

				$sql = $this->db->query("SELECT * FROM options WHERE id IN (".$options.")");
				$options = $sql->fetchAll();
			}

			$sql = $this->db->prepare("SELECT * FROM products_options WHERE id_product = :id");
			$sql->bindValue(':id', $id);
			$sql->execute();
			$options_values = array();
			if ($sql->rowCount() > 0) {
				foreach ($sql->fetchAll() as $op) {
					$options_values[$op['id_option']] = $op['p_value'];
				}
			}
			if ($options != '') {
				foreach ($options as $ok => $op) {
					if (isset($options_values[$op['id']])) {
						$options[$ok]['value'] = $options_values[$op['id']];
					} else {
						$options[$ok]['value'] = '';
					}
				}
			}
		}

		return $options;
	}

	public function getRates($id, $qt) {
		$array = array();

		$rates = new Rates();

		$array = $rates->getRates($id, $qt);

		return $array;
	}

	public function getBestsellers() {
		$array = array();

		$sql = $this->db->query("SELECT *, (select count(*) from products_images where id_product = products.id) as quant FROM products WHERE bestseller = 1 ORDER BY RAND() LIMIT 2");

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);

			foreach ($array as $key => $item) {
				$array[$key]['image'] = array();

				for ($i=0; $i < $item['quant']; $i++) { 

					$sql = $this->db->prepare("SELECT url FROM products_images WHERE id_product = :id_product");
					$sql->bindValue(':id_product', $item['id']);
					$sql->execute();

					if ($sql->rowCount() > 0) {

						$array[$key]['image'][$i] = $sql->fetch();

					}
				}
			}
		}

		return $array;
	}

	public function getRelatedProducts($id_category) {
		$array = array();

		$sql = $this->db->prepare("SELECT *, (select count(*) from products_images where id_product = products.id) as quant FROM products WHERE id_category = :id_category ORDER BY RAND() LIMIT 5");
		$sql->bindValue(':id_category', $id_category);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);

			foreach ($array as $key => $item) {
				$array[$key]['image'] = array();

				for ($i=0; $i < $item['quant']; $i++) { 

					$sql = $this->db->prepare("SELECT url FROM products_images WHERE id_product = :id_product");
					$sql->bindValue(':id_product', $item['id']);
					$sql->execute();

					if ($sql->rowCount() > 0) {

						$array[$key]['image'][$i] = $sql->fetch();

					}
				}
			}
		}

		return $array;
	}

	public function getAllProducts() {
		$array = array();

		$sql = $this->db->query("SELECT *,
		( select brands.name from brands where brands.id = products.id_brand ) as brand_name,
		( select categories.name from categories where categories.id = products.id_category ) as category_name
		FROM products ORDER BY name");

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}


















}