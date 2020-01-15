<?php
class categoriesController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header("Location: ".BASE_URL);
    }

    public function enter($id) {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $f = new Filters();

        $filters = array(
            'category' => $id
        );
        if(!empty($_GET['filter']) && is_array($_GET['filter'])) {
            $filters = $_GET['filter'];
        }

        $dados = $store->getTemplateData();

        $currentPage = 1;
        $offset = 0;
        $limit = 8;

        if (!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;
        $dados['category_name'] = $categories->getCategoryName($id);

        if (!empty($dados['category_name'])) {
            $dados['category_filter'] = $categories->getCategoryTree($id);
            $dados['allProducts'] = $products->getAllProducts();
            $dados['list'] = $products->getList($offset, $limit, $filters);
            $dados['totalItems'] = $products->getTotal($filters);
            $dados['numberOfPages'] = ceil(($dados['totalItems']/$limit));
            $dados['currentPage'] = $currentPage;
            $dados['id_category'] = $id;
            $dados['filters'] = $f->getFilters($filters);
            $dados['filters_selected'] = $filters;
            $dados['sidebar'] = true;

            $this->loadTemplate('categories', $dados);
        } else {
            header("Location: ".BASE_URL);
        }

        
    }

}