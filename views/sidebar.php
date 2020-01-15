<div class="rsidebar span_1_of_left">
 <section  class="sky-form">
	 <div class="product_right">
		 <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categorias</h4>
		 
		 <?php foreach($categories as $cat): ?>
			 <div class="tab<?php echo $cat['id']; ?>" id="tab">
				 <ul class="place" onclick="$('.tab<?php echo $cat['id']; ?> .single-bottom').slideToggle(300);">								
					 <li class="sort"><?php echo $cat['name']; ?></li>
					 <li class="by"><img src="images/do.png" alt=""></li>
						<div class="clearfix"> </div>
				  </ul>
				 <div class="single-bottom">	
				 	<?php foreach($allProducts as $prod): ?>
				 		<?php if($prod['id_category'] == $cat['id']): ?>
							<a href="<?php BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><p><?php echo $prod['name']; ?></p></a>
						<?php endif; ?>
					<?php endforeach; ?>
			     </div>
		      </div>
		  <?php endforeach; ?>
		  
		  <!--script-->
		<script>
			$(document).ready(function(){
				$("#tab .single-bottom").hide();
				
				$(".tab1 ul").click(function(){
					$(".tab1 .single-bottom").slideToggle(300);
					$(".tab2 .single-bottom").hide();
					$(".tab3 .single-bottom").hide();
					$(".tab4 .single-bottom").hide();
					$(".tab5 .single-bottom").hide();
				})
				$(".tab2 ul").click(function(){
					$(".tab2 .single-bottom").slideToggle(300);
					$(".tab1 .single-bottom").hide();
					$(".tab3 .single-bottom").hide();
					$(".tab4 .single-bottom").hide();
					$(".tab5 .single-bottom").hide();
				})
				$(".tab3 ul").click(function(){
					$(".tab3 .single-bottom").slideToggle(300);
					$(".tab4 .single-bottom").hide();
					$(".tab5 .single-bottom").hide();
					$(".tab2 .single-bottom").hide();
					$(".tab1 .single-bottom").hide();
				})
				$(".tab4 ul").click(function(){
					$(".tab4 .single-bottom").slideToggle(300);
					$(".tab5 .single-bottom").hide();
					$(".tab3 .single-bottom").hide();
					$(".tab2 .single-bottom").hide();
					$(".tab1 .single-bottom").hide();
				})	
				$(".tab5 ul").click(function(){
					$(".tab5 .single-bottom").slideToggle(300);
					$(".tab4 .single-bottom").hide();
					$(".tab3 .single-bottom").hide();
					$(".tab2 .single-bottom").hide();
					$(".tab1 .single-bottom").hide();
				})	
			});
		</script>
		<!-- script -->					 
 </section>			   
</div>	