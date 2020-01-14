<?php 

class paypalController extends controller {

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

                $id_purchase = $purchases->createPurchase($uid, $total, 'paypal');

                foreach ($list as $item) {
                    $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                }

                global $config;

                // Integração Paypal

                $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        $config['paypal_clientid'],
                        $config['paypal_secret']
                    )
                );

                $payer = new \PayPal\Api\Payer();
                $payer->setPaymentMethod('paypal');

                $amount = new \PayPal\Api\Amount();
                $amount->setCurrency('BRL')->setTotal($total);

                $transaction = new \PayPal\Api\Transaction();
                $transaction->setAmount($amount);
                $transaction->setInvoiceNumber($id_purchase);

                $redirectUrls = new \PayPal\Api\RedirectUrls();
                $redirectUrls->setReturnUrl(BASE_URL.'paypal/thankyou');
                $redirectUrls->setCancelUrl(BASE_URL.'paypal/cancel');

                $payment = new \PayPal\Api\Payment();
                $payment->setIntent('sale');
                $payment->setPayer($payer);
                $payment->setTransactions(array($transaction));
                $payment->setRedirectUrls($redirectUrls);

                try {

                    $payment->create($apiContext);
                    header("Location: ".$payment->getApprovalLink());
                    exit;

                } catch(\PayPal\Exception\PayPalConnectionException $e) {
                    echo $e->getData();
                    exit;
                }

            }

        }

        $this->loadTemplate('paypal', $dados);
	}

    public function thankyou() {
        $purchases = new Purchases();

        global $config;

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $config['paypal_clientid'],
                $config['paypal_secret']
            )
        );

        $paymentId = $_GET['paymentId'];
        $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);

        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        try {

            $result = $payment->execute($execution, $apiContext);

            try {

                $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
                $status = $payment->getState();
                $t = current($payment->getTransactions());
                $t = $t->toArray();
                $ref = $t['invoice_number'];

                $purchases->setPaid($ref, $status);

                if ($status == 'approved') {
                    $dados = array();
                    unset($_SESSION['shipping']);
                    unset($_SESSION['cart']);
                    $this->loadView('thankyou', $dados);
                } else {
                    header("Location: ".BASE_URL."paypal/cancel");
                    exit;
                }

            } catch(Exception $e) {
                header("Location: ".BASE_URL."paypal/cancel");
                exit;
            }

        } catch(Exception $e) {
            header("Location: ".BASE_URL."paypal/cancel");
            exit;
        }
    }

    public function cancel() {
        $dados = array();
        unset($_SESSION['shipping']);
        unset($_SESSION['cart']);
        $this->loadView('mp_failure', $dados);
    }







}