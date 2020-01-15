<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Amapá Telhas | Loja</title>
<link href="<?php echo BASE_URL; ?>css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<!--theme style-->
<link href="<?php echo BASE_URL; ?>css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="<?php echo BASE_URL; ?>js/jquery.min.js"></script>

<!--//theme style-->
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="telhas, telha, tijolos, tijolo, construção, construcao, material de construcao, ceramica, ceramicos" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- start menu -->
<script src="<?php echo BASE_URL; ?>js/simpleCart.min.js"> </script>
<!-- start menu -->
<link href="<?php echo BASE_URL; ?>css/memenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo BASE_URL; ?>js/memenu.js"></script>
<script>$(document).ready(function(){$(".memenu").memenu();});</script>	
<!-- /start menu -->
<link href="<?php echo BASE_URL; ?>css/form.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/flexslider.css" type="text/css" media="screen" />
<!-- the jScrollPane script -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
		</script>
<!-- //the jScrollPane script -->
</head>
<body> 
<!--header-->	
<script src="<?php echo BASE_URL; ?>js/responsiveslides.min.js"></script>
<script src="<?php echo BASE_URL; ?>js/bootstrap.js"> </script>
<script>  
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: false,
      });
    });
  </script>
  
<div class="header-top">
	 <div class="header-bottom">			
				<div class="logo">
					<h1><a href="<?php echo BASE_URL; ?>home"><img style="height: 97px; width: auto;" src="<?php echo BASE_URL; ?>images/logo.png" /></a></h1>
				</div>
			 <!---->
			 
			 <div class="top-nav">
				<ul class="memenu skyblue"><li class="active"><a href="<?php echo BASE_URL; ?>home">Home</a></li>
					<li class="grid"><a href="<?php echo BASE_URL; ?>product">Produtos</a>
						<div class="mepanel">
							<div class="row">
								<?php foreach($viewData['categories'] as $cat): ?>
									<div class="col1 me-one">
										<h4><?php echo $cat['name']; ?></h4>
										<ul>
											<?php foreach($viewData['allProducts'] as $prod): ?>
												<?php if($prod['category_name'] == $cat['name']): ?>
													<li><a href="<?php echo BASE_URL; ?>product/open/<?php echo $prod['id']; ?>"><?php echo $prod['name']; ?></a></li>
												<?php endif; ?>

											<?php endforeach; ?>
										</ul>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</li>
					
					<li class="grid"><a href="contact.html">Contato</a></li>					

				</ul>				
			 </div>
			 <!---->
			 <div class="cart box_1">
				 <a href="checkout.html">
					<div class="total">
					<span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>)</div>
					<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
				</a>
				<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
			 	<div class="clearfix"> </div>
			 </div>
			 <div class="clearfix"> </div>
			 <!---->			 
			 </div>
			<div class="clearfix"> </div>
</div>

<?php $this->loadViewInTemplate($viewName, $viewData); ?>

<!---->
<div class="subscribe">
	 <div class="container">
		 <h3>Promoções e Novidades</h3>
		 <form>
			 <input type="text" class="text" value="Digite seu Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Digite seu Email';}">
			 <input type="submit" value="Receber">
		 </form>
	 </div>
</div>
<!---->
<div class="footer">
	 <div class="container">
		 <div class="footer-grids">
			 <div class="col-md-3 about-us">
				 <h3>Sobre nós</h3>
				 <p>Maecenas nec auctor sem. Vivamus porttitor tincidunt elementum nisi a, euismod rhoncus urna. Curabitur scelerisque vulputate arcu eu pulvinar. Fusce vel neque diam</p>
			 </div>
			 <div class="col-md-3 ftr-grid">
					<h3>Mais Informações</h3>
					<ul class="nav-bottom">
						<li><a href="https://wa.me/+5596991480048" target="_blank"><img src="<?php  echo BASE_URL; ?>images/whatsapp.png"><br>Fale conosco no<br>Whatsapp</a></li>
					</ul>					
			 </div>
			 <div class="col-md-3 ftr-grid">
					<h3>Categorias</h3>
					<ul class="nav-bottom">
						<?php foreach($viewData['categories'] as $cat): ?>
							<li><a href="<?php echo BASE_URL; ?>categories/enter/<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></a></li>
						<?php endforeach; ?>
					</ul>					
			 </div>
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>
<div class="copywrite">
	 <div class="container">
		 <div class="copy">
			 <p>© <?php echo date('Y'); ?> Amapá Telhas. Todos os direitos reservados | Design by  <a href="http://www.cwrsdevelopment.com/" target="_blank">CWRS Development</a> </p>
		 </div>
		 <div class="social">							
				<a href="#"><i class="facebook"></i></a>
				<a href="#"><i class="twitter"></i></a>
				<a href="#"><i class="dribble"></i></a>	
				<a href="#"><i class="google"></i></a>	
				<a href="#"><i class="youtube"></i></a>	
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
</body>
</html>
