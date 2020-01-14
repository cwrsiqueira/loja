<?php 

class mpController extends controller {

	public function index() {
		$store = new Store();
        $users = new Users();
        $cart = new Cart();
        $purchases = new Purchases();
        $dados = $store->getTemplateData();

        if (!empty($_POST['name'])) {
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

                if (!empty($_SESSION['shipping'])) {
                    $shipping = $_SESSION['shipping'];

                    if (isset($shipping['price'])) {
                        $ship = floatval(str_replace(',', '.', $shipping['price']));
                    } else {
                        $ship = 0;
                    }

                    $total += $ship;
                }

                $id_purchase = $purchases->createPurchase($uid, $total, 'mp');

                foreach ($list as $item) {
                    $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                }

                global $config;
                $mp = new MP($config['mp_appid'], $config['mp_key']);                

                $data = array(
                    'items' => array(),
                    'shipments' => array(
                        'mode' => 'custom',
                        'cost' => $ship,
                        'receiver_address' => array(
                            'zip_code' => $areacode
                        )
                    ),
                    'back_urls' => array(
                        'success' => BASE_URL.'mp/success',
                        'pending' => BASE_URL.'mp/pending',
                        'failure' => BASE_URL.'mp/failure',
                    ),
                    'notification_url' => BASE_URL.'mp/notification',
                    'auto_return' => 'approved',
                    'external_reference' => $id_purchase
                );

                foreach($list as $item) {
                    $data['items'][] = array(
                        'title' => $item['name'],
                        'quantity' => $item['qt'],
                        'currency_id' => 'BRL',
                        'unit_price' => floatval($item['price'])
                    );
                }

                $link = $mp->create_preference($data);

                if ($link['status'] == '201') {
                    $link = $link['response']['init_point'];
                    //$link = $link['response']['sandbox_init_point'];
                    header("Location: ".$link);
                    exit;
                } else {
                    $dados['error'] = "Tente novamente mais tarde!";
                }

            }

        }

        $this->loadTemplate('mercado_pago', $dados);
	}

    public function notification() {
        $purchases = new Purchases();
        global $config;
        $mp = new MP($config['mp_appid'], $config['mp_key']);
        $mp->sandbox_mode(false);

        $info = $mp->get_payment_info($_GET['id']);

        if ($info['status'] == '200') {
            
            $array = $info['response'];
            $ref = $array['collection']['external_reference'];
            $status = $array['collection']['status'];

            /*
            pending = Em análise
            approved = Aprovado
            in_process = Em Revisão
            in_mediation = Em disputa
            rejected = Rejeitado
            cancelled = Cancelado
            refunded = Reembolsado
            charge_back = chargeback (contestado no cartão)
            */

            $purchases->setPaid($ref, $status);
        }
    }

    public function success() {
        $dados = array();
        unset($_SESSION['shipping']);
        unset($_SESSION['cart']);
        $this->loadView('thankyou', $dados);
    }

    public function pending() {
        $dados = array();
        unset($_SESSION['shipping']);
        unset($_SESSION['cart']);
        $this->loadView('mp_pending', $dados);
    }

    public function failure() {
        $dados = array();
        unset($_SESSION['shipping']);
        unset($_SESSION['cart']);
        $this->loadView('mp_failure', $dados);
    }
}