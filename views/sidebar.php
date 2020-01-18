<div class="rsidebar span_1_of_left">
 <section  class="sky-form">
	 <div class="product_right">
		 <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categorias</h4>
		 
		 <?php foreach($categories as $cat): ?>
			 <div class="tab<?php echo $cat['id']; ?>" id="tab">
				 <ul class="place" onclick="$('.tab<?php echo $cat['id']; ?> .single-bottom').slideToggle(300);">								
					 <li class="sort"><?php echo $cat['name']; ?></li>
					 <li class="by"><img src="<?php echo BASE_URL; ?>images/do.png" alt=""></li>
						<div class="clearfix"> </div>
				  </ul>
				 <div class="single-bottom">	
				 	<?php foreach($allProducts as $prod): ?>
				 		<?php if($prod['id_category'] == $cat['id']): ?>
							<a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><p><?php echo $prod['name']; ?></p></a>
						<?php endif; ?>
					<?php endforeach; ?>
			     </div>
		      </div>
		  <?php endforeach; ?>
		  
		  <!--script-->
		<script>
			$(document).ready(function(){
				$("#tab .single-bottom").hide();
			});
		</script>
		<!-- script -->					 
 </section>			   
</div>	