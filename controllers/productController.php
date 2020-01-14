<?php
class productController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $store = new Store();
        $dados = $store->getTemplateData();

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