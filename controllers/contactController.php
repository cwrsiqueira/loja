<?php
class contactController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $store = new Store();
        $products = new Products();
        $company = new Company();
        $dados = $store->getTemplateData();

        if (!empty($_SESSION['msgSuccess'])) {
            $dados['msgSuccess'] = $_SESSION['msgSuccess'];
            unset($_SESSION['msgSuccess']);
        }

        if (!empty($_SESSION['msgFailure'])) {
            $dados['msgFailure'] = $_SESSION['msgFailure'];
            unset($_SESSION['msgFailure']);
        }

        $dados['allProducts'] = $products->getAllProducts();
        $dados['company'] = $company->getCompany();

        $this->loadTemplate('contact', $dados);
    }

    public function receive() {
        $user = new Users();

        if (isset($_POST['userName']) && !empty($_POST['userName'])) {
            $name = addslashes($_POST['userName']);
            $email = addslashes($_POST['userEmail']);
            $phone = addslashes($_POST['userPhone']);
            $msg = addslashes($_POST['userMsg']);

            if ($user->userContact($name, $email, $phone, $msg)) {
                $_SESSION['msgSuccess'] = "Obrigado pela mensagem. Retornaremos em breve!";
                header("Location: ".BASE_URL."contact");
                exit;
            } else {
                $_SESSION['msgFailure'] = "Desculpe, mensagem não enviada. Tente novamente em alguns minutos. Obrigado!";
                header("Location: ".BASE_URL."contact");
                exit;
            }

        } else {
            header("Location: ".BASE_URL."contact");
            exit;
        }
    }

}