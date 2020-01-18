<div class="container">
	<?php if(!empty($msgSuccess)): ?>
		<br>
		<div class="alert alert-success alert-dismissible">
			<strong>Successo!</strong><?php echo $msgSuccess; ?>
		</div>
	<?php elseif(!empty($msgFailure)): ?>
		<br>
		<div class="alert alert-danger alert-dismissible">
	 	<strong>Erro!</strong><?php echo $msgFailure; ?>
	 </div>
	<?php endif; ?>
</div>
<!---->	
<div class="slider">
	  <div class="callbacks_container">
	     <ul class="rslides" id="slider">
	         <li>
				 <div class="banner1">				  
					  <div class="banner-info">
					  <h3>AMAPÁ TELHAS</h3>
					  <p>Valorize sua obra com produtos cerâmicos</p>
					  </div>
				 </div>
	         </li>
	         <li>
				 <div class="banner2">
					 <div class="banner-info">
					 <h3>AMAPÁ TELHAS</h3>
					  <p>Valorize sua obra com produtos cerâmicos</p>
					 </div>
				 </div>
			 </li>
	         <li>
	             <div class="banner3">
	        	 <div class="banner-info">
	        	 <h3>AMAPÁ TELHAS</h3>
					  <p>Valorize sua obra com produtos cerâmicos</p>
				 </div>
				 </div>
	         </li>
	      </ul>
	  </div>
  </div>
<!---->

<div class="items">
	 <div class="container">
		 <div class="items-sec">
		 	<?php foreach($viewData['list'] as $prod): ?>
				<div class="col-md-3 feature-grid">
				 <a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><img src="<?php echo BASE_URL; ?>media/products/<?php echo (!empty($prod['images']))?$prod['images'][0]['url']:''; ?>" alt=""/>	
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
		 </div>

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
<!---->

<div class="offers">
	 <div class="container">
	 <h3>Destaques</h3>
	 <div class="offer-grids">
	 	<?php foreach($bestsellers as $bs): ?>
	 		<?php if($bs['bestseller'] == 1): ?>
				<div class="col-md-6 grid-left">
				 <a href="<?php echo BASE_URL; ?>product/open/<?php echo $bs['id']; ?>"><div class="offer-grid1">
					 <div class="ofr-pic">
						 <img src="<?php echo BASE_URL; ?>media/products/<?php echo (!empty($bs['image']))?$bs['image'][0]['url']:''; ?>" class="img-responsive" alt=""/>
					 </div>
					 <div class="ofr-pic-info">
						 <h4><?php echo $bs['name'] ?></h4>
						 <span>COM <?php echo number_format((($bs['price'] / $bs['price_from']) * 100),0); ?>% DE DESCONTO</span>
						 <p>COMPRE AGORA</p>
					 </div>
					 <div class="clearfix"></div>
				 </div></a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>

		 <div class="clearfix"></div>
	 </div>
	 </div>
</div>
