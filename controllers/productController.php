<?php
class productController extends controller {

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

        $dados['list'] = $products->getList($offset, $limit, $filters);
        $dados['allProducts'] = $products->getAllProducts();
        $dados['bestsellers'] = $products->getBestsellers();
        $dados['totalItems'] = $products->getTotal($filters);
        $dados['numberOfPages'] = ceil(($dados['totalItems']/$limit));
        $dados['currentPage'] = $currentPage;
        $dados['filters'] = $f->getFilters($filters);
        $dados['filters_selected'] = $filters;
        $dados['sidebar'] = true;

        $this->loadTemplate('product', $dados);
    }

    public function open($id) {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        
        $dados = $store->getTemplateData();
        
        $info = $products->getProductInfo($id);

        if (count($info) > 0) {

            $dados['product_info'] = $info;
            $dados['product_images'] = $products->getImagesByProductId($id);
            $dados['product_options'] = $products->getOptionsByProductId($id);
            $dados['product_rates'] = $products->getRates($id, 5);

            $this->loadTemplate('product', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

}