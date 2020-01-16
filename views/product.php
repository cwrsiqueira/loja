<body> 

<div class="product-model">	 
	 <div class="container">
			<ol class="breadcrumb">
		  <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
		  <li class="active">Produtos</li>
		 </ol>
			<h2>Nossos Produtos</h2>			
		 <div class="col-md-9 product-model-sec">

		 		<?php foreach($list as $prod): ?>
					 <a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><div class="product-grid">
						<div class="more-product"><span> </span></div>						
						<div class="product-img b-link-stripe b-animate-go  thickbox">
							<?php if(!empty($prod['images'])): ?>
								<img src="<?php echo BASE_URL; ?>media/products/<?php echo $prod['images'][0]['url']; ?>" class="img-responsive" alt="">
							<?php else: ?>
								<img src="<?php BASE_URL; ?>assets/images/logo.png" class="img-responsive" alt="">
							<?php endif; ?>
							<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
							<button><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Detalhes</button>
							</h4>
							</div>
						</div></a>						
						<div class="product-info simpleCart_shelfItem">
							<div class="product-info-cust prt_name">
								<h4><?php echo $prod['name']; ?></h4>								
								<span class="item_price">R$ <?php echo number_format($prod['price'], 2, '.', ','); ?></span>
								<div class="ofr">
								  <p class="pric1"><del>R$ <?php echo number_format($prod['price_from'], 2, '.', ','); ?></del></p>
						          <p class="disc">[<?php echo number_format((($prod['price'] / $prod['price_from']) * 100),0); ?>% de Desconto]</p>
								</div>
								<form method="POST" action="<?php echo BASE_URL; ?>cart/add">
									<input type="hidden" name="id_product" value="<?php echo $prod['id']; ?>">
									<input type="number" name="qt_product" class="item_quantity_cart" value="1"/>
									<input type="submit" class="item_add_cart items_cart" value="ADD">
								</form>
								<div class="clearfix"> </div>
							</div>	
						</div>
					</div>
				<?php endforeach; ?>
				<div class="clearfix"> </div>
				<div class="pagination_fild">
					<ul class="pagination">
						<?php for($q=1; $q<=$numberOfPages; $q++): ?>
					  <li class="page-item <?php echo ($currentPage == $q)?'active':''?>"><a class="page-link" href="<?php BASE_URL; ?>?<?php
					  $pag_array = $_GET;
					  $pag_array['p'] = $q;
					  echo http_build_query($pag_array);
					  ?>"><?php echo $q; ?></a></li>
						<?php endfor; ?>
					</ul>
				</div>
			</div>

			<?php $this->loadView('sidebar', array('categories'=>$categories, 'allProducts'=>$allProducts)); ?>
						 
	      </div>
		</div>
</div>
<br><br>
</body>