<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $f = new Filters();

        $dados = $store->getTemplateData();

        $filters = array();
        if(!empty($_GET['filter']) && is_array($_GET['filter'])) {
            $filters = $_GET['filter'];
        }

        $currentPage = 1;
        $offset = 0;
        $limit = 8;

        if (!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        if (!empty($_SESSION['msgSuccess'])) {
            $dados['msgSuccess'] = $_SESSION['msgSuccess'];
            unset($_SESSION['msgSuccess']);
        }

        if (!empty($_SESSION['msgFailure'])) {
            $dados['msgFailure'] = $_SESSION['msgFailure'];
            unset($_SESSION['msgFailure']);
        }

        if (!empty($_SESSION['cart'])) {
            $dados['cart'] = $_SESSION['cart'];
        }

        $dados['list'] = $products->getList($offset, $limit,$filters);
        $dados['allProducts'] = $products->getAllProducts();
        $dados['bestsellers'] = $products->getBestsellers();
        $dados['totalItems'] = $products->getTotal($filters);
        $dados['numberOfPages'] = ceil(($dados['totalItems']/$limit));
        $dados['currentPage'] = $currentPage;
        $dados['filters'] = $f->getFilters($filters);
        $dados['filters_selected'] = $filters;
        $dados['sidebar'] = true;

        $this->loadTemplate('home', $dados);
    }

}