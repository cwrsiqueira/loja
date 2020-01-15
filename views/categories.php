<body>
<div class="product-model">	 
	 <div class="container">
			<ol class="breadcrumb">
		  <li><a href="<?php echo BASE_URL; ?>product">Produtos</a></li>
		  <li class="active">Produtos Por Categoria</li>
		 </ol>
			<h2><?php echo $category_name; ?></h2>	
	</div>		
</div>
	<div class="col-md-8 product-model-sec">
	 	<?php foreach($viewData['list'] as $prod): ?>
			<div width="20%" class="col-md-4 feature-grid">
			 <a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><img src="<?php echo BASE_URL; ?>media/Products/<?php echo (!empty($prod['images']))?$prod['images'][0]['url']:''; ?>" alt=""/>	
				 <div class="arrival-info">
					 <h4><?php echo $prod['name']; ?></h4>
					 <p>R$ <?php echo number_format($prod['price'], 2, '.', ','); ?></p>
					 <span class="pric1"><del>R$ <?php echo number_format($prod['price_from'], 2, '.', ','); ?></del></span>
					 <span class="disc">[<?php echo number_format((($prod['price'] / $prod['price_from']) * 100),0); ?>% de Desconto]</span>
				 </div>
				 <div class="viw">
					<a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>View</a>
				 </div>
			  </a>
			</div>
		<?php endforeach; ?>

		<div class="clearfix"></div>

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

	<div class="container">
		<?php $this->loadView('sidebar', array('categories'=>$categories, 'allProducts'=>$allProducts)); ?>
	</div>
	<div class="clearfix"></div>
<!---->
</body>