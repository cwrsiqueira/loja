<?php
class buscaController extends controller {

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

        if (!empty($_GET['s'])) {

            $searchTerm = $_GET['s'];
            $category = $_GET['category'];

            $filters = array();
            if(!empty($_GET['filter']) && is_array($_GET['filter'])) {
                $filters = $_GET['filter'];
            }

            $filters['searchTerm'] = $searchTerm;
            $filters['category'] = $category;

            $currentPage = 1;
            $offset = 0;
            $limit = 9;

            if (!empty($_GET['p'])) {
                $currentPage = $_GET['p'];
            }

            $offset = ($currentPage * $limit) - $limit;

            $dados['list'] = $products->getList($offset, $limit,$filters);
            $dados['totalItems'] = $products->getTotal($filters);
            $dados['numberOfPages'] = ceil(($dados['totalItems']/$limit));
            $dados['currentPage'] = $currentPage;
            
            $dados['filters'] = $f->getFilters($filters);
            $dados['filters_selected'] = $filters;
            $dados['searchTerm'] = $searchTerm;
            $dados['category'] = $category;
            $dados['category_name'] = $categories->getCategoryName($category);
            
            $dados['sidebar'] = true;

            $this->loadTemplate('busca', $dados);
        } else {
            header("Location: ".BASE_URL);
        }
    }

}