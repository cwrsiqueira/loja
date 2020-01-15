<body> 
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="<?php echo BASE_URL; ?>product">Produtos</a></li>
			<li class="active">Detalhes do Produto</li>
		</ol>
	</div>

<!--header//-->
<div class="product">
	 <div class="container">				
		 <div class="product-price1">
			 <div class="top-sing">
				  <div class="col-md-7 single-top">	
					 <div class="flexslider">
							  <ul class="slides">
								<?php foreach($product_images as $img): ?>
									<li data-thumb="<?php echo BASE_URL; ?>media/products/<?php echo $img['url']; ?>">
										<div class="thumb-image"> 
											<img src="<?php echo BASE_URL; ?>media/products/<?php echo $img['url']; ?>" data-imagezoom="true" class="img-responsive" alt=""/> 
										</div>
									</li>
								<?php endforeach; ?>
							  </ul>
						</div>					 					 
					 <script src="<?php echo BASE_URL; ?>js/imagezoom.js"></script>
						<script defer src="<?php echo BASE_URL; ?>js/jquery.flexslider.js"></script>
						<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						  });
						});
						</script>

				 </div>	
			     <div class="col-md-5 single-top-in simpleCart_shelfItem">
					  <div class="single-para ">
						 <h4><?php echo $product_info['name']; ?></h4>							
							<h5 class="item_price">R$ <?php echo number_format($product_info['price'], 2, '.', ','); ?></h5>							
							<p class="para"><?php echo $product_info['description']; ?> </p>
							<div class="prdt-info-grid">
								 <ul>
								 	<?php if($product_options != ''): ?>
								 		<li>- Marca : <?php echo $product_info['brand_name']; ?></li>
								 		<?php foreach($product_options as $po): ?>
											<li>- <?php echo $po['name']; ?> : <?php echo $po['value']; ?></li>
										<?php endforeach; ?>
									 <?php else: ?>
										Produto cadastrado sem especificações
									<?php endif; ?>
								 </ul>
							</div>

							<a href="#" class="add-cart item_add">ADICIONAR NO CARRINHO</a>							
					 </div>
				 </div>
				 <div class="clearfix"> </div>
			 </div>
	     </div>
		 <div class="bottom-prdt">
			 <div class="btm-grid-sec">
			 	
			 	<?php foreach($allRelatedProducts as $prod): ?>
					<div class="col-md-2 btm-grid">
					 <a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>">
						<img width="100%" src="<?php echo BASE_URL; ?>media/products/<?php echo (!empty($prod['image']))?$prod['image'][0]['url']:''; ?>" alt=""/>
						<h4><?php echo $prod['name']; ?></h4>
						<span>R$ <?php echo number_format($prod['price_from'], 2, '.', ','); ?></span></a>
					</div>
				<?php endforeach; ?>


				  <div class="clearfix"></div>
			 </div>			
		 </div>
	 </div>
</div>
</body>