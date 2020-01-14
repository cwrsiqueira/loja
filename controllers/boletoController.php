<?php 

class boletoController extends controller {

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

                $id_purchase = $purchases->createPurchase($uid, $total, 'boleto');

                foreach ($list as $item) {
                    $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                }

                global $config;

                // Integração a Boleto

                $options = array(
                    'client_id' => $config['gerencianet_clientid'],
                    'client_secret' => $config['gerencianet_clientsecret'],
                    'sandbox' => $config['gerencianet_sandbox']
                );

                $items = array();
                foreach ($list as $item) {
                    $items[] = array(
                        'name' => $item['name'],
                        'amount' => intval($item['qt']),
                        'value' => ($item['price'] * 100)
                    );
                }

                $metadata = array(
                    'custom_id' => $id_purchase,
                    'notification_url' => BASE_URL.'boleto/notification'
                );

                $shippings = array(
                    array(
                        'name' => 'FRETE',
                        'value' => 0 //($ship * 100)
                    )
                );

                $body = array(
                    'metadata' => $metadata,
                    'items' => $items,
                    'shippings' => $shippings
                );

                try {

                    $api = new \Gerencianet\Gerencianet($options);
                    $charge = $api->createCharge(array(), $body);

                    if ($charge['code'] == '200') {
                        $charge_id = $charge['data']['charge_id'];

                        $params = array(
                            'id' => $charge_id
                        );

                        $customer = array(
                            'name' => $name,
                            'cpf' => $cpf,
                            'phone_number' => $phone
                        );

                        $bankingBillet = array(
                            'expire_at' => date('Y-m-d', strtotime('+5 days')),
                            'customer' => $customer,
                            'message' => ''
                        );

                        $payment = array(
                            'banking_billet' => $bankingBillet
                        );

                        $body = array(
                            'payment' => $payment
                        );

                        try {

                            $charge = $api->payCharge($params, $body);

                            if($charge['code'] == '200') {

                                $link = $charge['data']['link'];

                                $purchases->updateBilletUrl($id_purchase, $link);

                                unset($_SESSION['shipping']);
                                unset($_SESSION['cart']);

                                $dados['link'] = $link;
                                
                                $this->loadView('thankyou', $dados);
                                exit;   
                            }

                        } catch(Exception $e) {
                            unset($_SESSION['shipping']);
                            $dados['error'] = "ERROR: ".$e->getMessage();
                            $this->loadView('mp_failure', $dados);
                            exit;
                        }
                    }

                } catch(Exception $e) {
                    unset($_SESSION['shipping']);
                    $dados['error'] = "ERROR: ".$e->getMessage();
                    $this->loadView('mp_failure', $dados);
                    exit;
                }



            }

        }

        $this->loadTemplate('boleto', $dados);
	}

    public function notification() {

        global $config;

        $options = array(
            'client_id' => $config['gerencianet_clientid'],
            'client_secret' => $config['gerencianet_clientsecret'],
            'sandbox' => $config['gerencianet_sandbox']
        );

        $token = $_POST['notification'];

        $params = array(
            'token' => $token
        );

        try {

            $api = new \Gerencianet\Gerencianet($options);
            $c = $api->getNotification($params, array());

            $last = end($c['data']);

            $custom_id = $last['custom_id'];
            $status = $last['status']['current'];

            $purchases = new Purchases();
            $purchases->setPaid($ref, $status);

        } catch(Exception $e) {
            echo "ERROR: ";
            print_r($e->getMessage());
            exit;
        }

    }







}