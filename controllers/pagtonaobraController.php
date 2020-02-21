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
            $areacode = addslashes($_POST['areacode']);
            $street = addslashes($_POST['street']);
            $number = addslashes($_POST['number']);
            $complement = addslashes($_POST['complement']);
            $neighborhood = addslashes($_POST['neighborhood']);
            $city = addslashes($_POST['city']);
            $state = addslashes($_POST['state']);

            $cpf = trim($cpf);
            $cpf = str_replace('.', '', $cpf);
            $cpf = str_replace('-', '', $cpf);

            $phone = trim($phone);
            $phone = str_replace('(', '', $phone);
            $phone = str_replace(')', '', $phone);
            $phone = str_replace(' ', '', $phone);
            $phone = str_replace('-', '', $phone);

            $areacode = trim($areacode);
            $areacode = str_replace('.', '', $areacode);
            $areacode = str_replace('-', '', $areacode);

            if ($users->emailExists($email)) {
                $uid = $users->validateClient($email);

                if (empty($uid)) {
                    $dados['error'] = "ERROREMAILPASSWORD";
                }
            } else {
                $uid = $users->createClient($name, $cpf, $phone, $email, $areacode, $street, $number, $complement, $neighborhood, $city, $state);
            }

            if (!empty($uid)) {
                $list = $cart->getList();
                $total = 0;

                foreach ($list as $item) {
                    $total += (floatval($item['price']) * intval($item['qt']));
                }

                $id_purchase = $purchases->createPurchase($uid, $total, 'pagto_na_obra');

                foreach ($list as $item) {
                    $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                }

            }

            unset($_SESSION['shipping']);
            unset($_SESSION['cart']);
            unset($_SESSION['subtotal']);
            unset($_SESSION['quant']);

            $this->loadTemplate('thankyou', $dados);
            exit;

        }

        $dados['ceps'] = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        ];

        $this->loadTemplate('pagtonaobra', $dados);
	}







}