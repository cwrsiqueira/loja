<?php 

class pagtonaobraController extends controller {

	public function index() {
		$store = new Store();
        $users = new Users();
        $cart = new Cart();
        $purchases = new Purchases();
        $dados = $store->getTemplateData();

        if (!empty($_POST['name'])) {
            $name = addslashes($_POST['name']);
            $cpf = addslashes($_POST['cpf']);
            $phone = addslashes($_POST['phone']);
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $areacode = addslashes($_POST['areacode']);
            $street = addslashes($_POST['street']);
            $number = addslashes($_POST['number']);
            $complement = addslashes($_POST['complement']);
            $neighborhood = addslashes($_POST['neighborhood']);
            $city = addslashes($_POST['city']);
            $state = addslashes($_POST['state']);

            if ($users->emailExists($email)) {
                $uid = $users->validate($email, $password);

                if (empty($uid)) {
                    $dados['error'] = "ERROREMAILPASSWORD";
                }
            } else {
                $uid = $users->createUser($name, $email, $password);
            }

            if (!empty($uid)) {
                $list = $cart->getList();
                $total = 0;

                foreach ($list as $item) {
                    $total += (floatval($item['price']) * intval($item['qt']));
                }

                $id_purchase = $purchases->createPurchase($uid, $total, 'boleto');

                foreach ($list as $item) {
                    $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                }

            }

            $this->loadTemplate('thankyou', $dados);
            exit;

        }

        $this->loadTemplate('pagtonaobra', $dados);
	}







}