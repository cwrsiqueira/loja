<?php 

class checkoutTransparentController extends controller {

	public function index() {
		$store = new Store();
        $products = new Products();
        $cart = new Cart();
        $dados = $store->getTemplateData();

        $list = $cart->getList();
        $total = 0;

        foreach ($list as $item) {
            $total += (floatval($item['price']) * intval($item['qt']));
        }

        unset($_SESSION['shipping']);
        $_SESSION['shipping'] = 0;

        if (!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];

            if (isset($shipping['price'])) {
                $ship = floatval(str_replace(',', '.', $shipping['price']));
            } else {
                $ship = 0;
            }

            $total += $ship;
        }

        try {

        	$sessionCode = \PagSeguro\Services\Session::create(
        		\PagSeguro\Configuration\Configure::getAccountCredentials()
        	);

        	$dados['sessionCode'] = $sessionCode->getResult();

        } catch(Exception $e) {
        	echo "ERRO: ".$e->getMessage();
        	exit;
        }

        $dados['total'] = $total;

        $this->loadTemplate('checkoutTransparent', $dados);
	}

    public function checkout() {
        $cart = new Cart();
        $purchases = new Purchases();
        $users = new Users();

        $id = addslashes($_POST['id']);
        $name = addslashes($_POST['name']);
        $cpf = addslashes($_POST['cpf']);
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);
        $areacode = addslashes($_POST['areacode']);
        $street = addslashes($_POST['street']);
        $number = addslashes($_POST['number']);
        $complement = addslashes($_POST['complement']);
        $neighborhood = addslashes($_POST['neighborhood']);
        $city = addslashes($_POST['city']);
        $state = addslashes($_POST['state']);
        $cardholder = addslashes($_POST['cardholder']);
        $cardholder_cpf = addslashes($_POST['cardholder_cpf']);
        $card_number = addslashes($_POST['card_number']);
        $cvv = addslashes($_POST['cvv']);
        $exp_month = addslashes($_POST['exp_month']);
        $exp_year = addslashes($_POST['exp_year']);
        $card_token = addslashes($_POST['card_token']);
        $inst = explode(';', $_POST['inst']);
        $phone = addslashes($_POST['phone']);

        if ($users->emailExists($email)) {
            $uid = $users->validate($email, $password);

            if (empty($uid)) {
                $array = array('error'=>true, 'msg'=>$this->lang->get('ERROREMAILPASSWORD'));
                echo json_encode($array);
                exit;
            }
        } else {
            $uid = $users->createUser($name, $email, $password);
        }

        $list = $cart->getList();
        $total = 0;
        $ship = 0.00;

        foreach ($list as $item) {
            $total += (floatval($item['price']) * intval($item['qt']));
        }

        /*
        if (!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];

            if (isset($shipping['price'])) {
                $ship = floatval(str_replace(',', '.', $shipping['price']));
            } else {
                $ship = 0;
            }

            $total += $ship;
        }
        */

        $id_purchase = $purchases->createPurchase($uid, $total, 'pscheckoutTransparent');

        foreach ($list as $item) {
            $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
        }

        global $config;

        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
        $creditCard->setReceiverEmail($config['pagseguro_seller']);
        $creditCard->setReference($id_purchase);
        $creditCard->setCurrency("BRL");

        foreach ($list as $item) {
            $creditCard->addItems()->withParameters(
                $item['id'],
                $item['name'],
                intval($item['qt']),
                floatval($item['price'])
            );
        }

        $creditCard->setSender()->setName($name);
        $creditCard->setSender()->setEmail($email);
        $creditCard->setSender()->setDocument()->withParameters('CPF', $cpf);

        $ddd = substr($phone, 0, 2);
        $phone = substr($phone, 2);

        $creditCard->setSender()->setPhone()->withParameters(
            $ddd,
            $phone
        );

        $creditCard->setSender()->setHash($id);
        $creditCard->setSender()->setIp($_SERVER['REMOTE_ADDR']);

        $creditCard->setShipping()->setAddress()->withParameters(
            $street, 
            $number, 
            $neighborhood, 
            $areacode, 
            $city, 
            $state,  
            'BRA',
            $complement
        );

        $creditCard->setBilling()->setAddress()->withParameters(
            $street, 
            $number, 
            $neighborhood, 
            $areacode, 
            $city, 
            $state,  
            'BRA',
            $complement
        );

        $quantity = $inst[0]; // installment quantity
        $value = $inst[1]; // installment value

        $creditCard->setToken($card_token);
        $creditCard->setInstallment()->withParameters($quantity, $value);
        $creditCard->setShipping()->setCost()->withParameters($ship);
        $creditCard->setHolder()->setName($cardholder);
        $creditCard->setHolder()->setDocument()->withParameters('CPF', $cardholder_cpf);

        $creditCard->setMode('DEFAULT');

        $creditCard->setNotificationUrl(BASE_URL."checkoutTransparent/notification");

        try {
            $result = $creditCard->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            echo json_encode($result);
            exit;
        } catch(Exception $e) {
            echo "ERRO: ".$e->getMessage();
            exit;
        }
    }

    public function notification() {
        $purchases = new Purchases();

        try {

            if(\PagSeguro\Helpers\Xhr::hasPost()) {
                $r = \PagSeguro\Services\Transactions\Notification::check(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );

                $ref = $r->getReference();
                $status = $r->getStatus();
                /*
                1 - Aguardando Pagamento
                2 - Em análise
                3 - Paga
                4 - Disponível
                5 - Em disputa
                6 - Devolvida
                7 - Cancelada
                8 - Debitado
                9 - Retenção Temporária = Chargeback
                */

                $purchases->setPaid($ref, $status);
            }

        } catch(Exception $e) {
            echo "ERRO: ".$e->getMessage();
            exit;
        }
    }

    public function thankyou() {
        $dados = array();
        unset($_SESSION['shipping']);
        unset($_SESSION['cart']);
        $this->loadView('thankyou', $dados);
    }

}