<?php
class cartController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $store = new Store();
        $products = new Products();
        $cart = new Cart();


        /*
        // calculo CEP
        $cep = '';
        $shipping = array();
        if (!empty($_POST['cep'])) {
            $cep = addslashes($_POST['cep']);
            $cep = str_replace('.', '', $cep);
            $cep = str_replace('-', '', $cep);
            $cep = intval($cep);

            $shipping = $cart->shippingCalculate($cep);
            $_SESSION['shipping'] = $shipping;
        }
        if (!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];
        }
        // ---
        */

        // Calculo Frete por localidade
        $cep = '';
        $shipping = '';
        
        if (!empty($_POST['cep'])) {
            $cep = addslashes($_POST['cep']);

            if ($cep == 'macapa' || $cep == 'santana') {
                $shipping = 'Frete Grátis';
            } else {
                $shipping = 'Consultar Frete';
            }

            $_SESSION['shipping'] = $shipping;
        }

        if (!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];
        }
        // ---


        if (!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart']) == 0)) {
            unset($_SESSION['subtotal']);
            unset($_SESSION['quant']);
            header("Location: ".BASE_URL."product");
            exit;
        }

        $dados = $store->getTemplateData();

        $dados['cep'] = $cep;
        $dados['shipping'] = $shipping; 
        $dados['list'] = $cart->getList();
        $dados['allProducts'] = $products->getAllProducts();

        $_SESSION['subtotal'] = $cart->getSubtotal();
        $_SESSION['quant'] = $cart->getQuant();

        $this->loadTemplate('cart', $dados);
    }

    public function add() {

        if (isset($_POST['id_product'])) {
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);

            if ($qt <= 0) {
                $qt = 1;
            }

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] += $qt;
            } else {
                $_SESSION['cart'][$id] = $qt;
            }
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }

    public function del($id) {
        if (!empty($id)) {
            unset($_SESSION['cart'][$id]);
        }

        header("Location: ".BASE_URL."cart");
    }

    public function changeQuant() {
        if (isset($_POST['item']) && !empty($_POST['item'])) {
            $item = addslashes($_POST['item']);
            $cart_qt = addslashes($_POST['cart_qt']);

            $_SESSION['cart'][$item] = $cart_qt;
        }

        echo json_encode($item, $cart_qt);
    }

    public function payment_redirect() {

        if (!empty($_POST['pay_method'])) {
            $pay_method = $_POST['pay_method'];

            header("Location: ".BASE_URL.$pay_method);
            exit;

        }

        header("Location: ".BASE_URL."cart");
        exit;
        
    }

}