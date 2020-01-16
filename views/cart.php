
<body>
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="<?php echo BASE_URL; ?>product">Produtos</a></li>
			<li class="active">Carrinho de Compras</li>
		</ol>
	</div>

<!-- check out -->
<div class="container">
	<div class="check-sec">	 
		<div class="col-md-3 cart-total">
			<a class="continue" href="<?php echo BASE_URL; ?>product">Continue Comprando</a>
			<div class="price-details">
				<h3>Preço Detalhado</h3>
				<span>Total</span>
				<span class="total1"><?php echo number_format($_SESSION['subtotal'], 2); ?></span>
				<span>(Macapá e Santana-AP)</span>
				<span class="total1">Frete Grátis</span>
				<span><a href="https://wa.me/5596991480058" target="_blank">Consultar Fretes para outras localidades</a></span>
				<div class="clearfix"></div>				 
			</div>	
			<ul class="total_price">
			   <li class="last_price"> <h4>TOTAL</h4></li>	
			   <li class="last_price"><span><?php echo number_format($_SESSION['subtotal'], 2); ?></span></li>			   
			</ul> 
			<div class="clearfix"></div>
			<div class="clearfix"></div>
			<a class="order" href="#">Efetuar Pagamento</a>
		</div>
		<div class="col-md-9 cart-items">
			<h1>Meu Carrinho de Compras (<?php echo $_SESSION['quant']; ?>)</h1>

			<?php foreach($list as $prod): ?>
			<div class="cart-header">
				<a href="<?php echo BASE_URL; ?>cart/del/<?php echo $prod['id']; ?>">
					<div class="close_cart"></div>
				</a>
				<div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							<img src="<?php echo $prod['image']; ?>" class="img-responsive" alt=""/>
						</div>
					   <div class="cart-item-info">
						    <h3><a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><?php echo $prod['name']; ?></a></h3>
							<ul class="qty">
								<li><p>Quant : <?php echo $prod['qt']; ?></p></li>
								<li><p>Preço Unitário : <?php echo number_format($prod['price'],2); ?></p></li>
								<li><p>Sub-Total : <?php echo number_format($prod['qt']*$prod['price'],2); ?></p></li>
							</ul>
							<div class="delivery">
								 <p>Frete para Macapá e Santana-AP : Grátis</p>
								 <span>Entrega em 2-3 dias úteis</span>
								 <div class="clearfix"></div>
							</div>								
					   </div>
					   <div class="clearfix"></div>
											
				  </div>
			 </div>	
			<?php endforeach; ?>


		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //check out -->
</body>