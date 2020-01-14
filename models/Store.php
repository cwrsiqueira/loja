<?php 

class Store extends model {

	public function getTemplateData() {
	$dados = array();

	$products = new Products();
        $categories = new Categories();
        $company = new Company();
        $cart = new Cart();

        $dados['categories'] = $categories->getList();
        $dados['widget_featured1'] = $products->getList(0, 5, array('featured'=>'1'), true);
        $dados['widget_featured2'] = $products->getList(0, 3, array('featured'=>'1'), true);
        $dados['widget_sale'] = $products->getList(0, 3, array('sale'=>'1'), true);
        $dados['widget_toprated'] = $products->getList(0, 3, array('toprated'=>'1'));
        $dados['company'] = $company->getCompany();

        // CONTAR A QUANTIDADE TOTAL DE ITENS NO CARRINHO
        /*if (isset($_SESSION['cart'])) {
        	$qt = 0;
        	foreach ($_SESSION['cart'] as $item) {
        		$qt += intval($item);
        	}
        	$dados['cart_qt'] = $qt;	
        } else {
        	$dados['cart_qt'] = 0;
        }*/

        // CONTAR A QUANTIDADE DE PRODUTOS DIFERENTES NO CARRINHO
        if (isset($_SESSION['cart'])) {
                $dados['cart_qt'] = count($_SESSION['cart']);
        } else {
                $dados['cart_qt'] = 0;
        }
        
        $dados['cart_subtotal'] = $cart->getSubtotal();
        

	return $dados;
	}
}