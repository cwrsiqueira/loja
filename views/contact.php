
<body>
<div class="contact">
	  <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.html">Home</a></li>
		  <li class="active">Contato</li>
		 </ol>
		 <?php if(!empty($msgSuccess)): ?>
		 <div class="alert alert-success alert-dismissible">
		 	<strong>Successo!</strong><?php echo $msgSuccess; ?>
		 </div>
		 <?php elseif(!empty($msgFailure)): ?>
		 	<div class="alert alert-danger alert-dismissible">
			 	<strong>Erro!</strong><?php echo $msgFailure; ?>
			 </div>
		 <?php endif; ?>
			<!--start contact-->
			<h3>Fale Conosco por e-mail</h3>
		  <div class="section group">				
				<div class="col-md-6 span_1_of_3">
					<div class="contact_info">
			    	 	<h4>Nos encontre aqui</h4>
			    	 		<div class="map">
					   			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15959.270073922982!2d-51.127181099999994!3d-0.036325449999999995!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x929e1c439c3522bd%3A0xbaf4576248db6a29!2zMMKwMDInMjYuMSJTIDUxwrAwNycyNy44Ilc!5e0!3m2!1sen!2sbr!4v1579116115794!5m2!1sen!2sbr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
					   		</div>
      				</div>
      			<div class="company_address">
				     	<h4>Informações da Empresa :</h4>
						    	<p><?php echo $company['address']; ?></p>
						   		<p>BRASIL</p>
				   		<p>Telefone:<?php echo $company['phone']; ?></p>
				 	 	<p>Email: <a href="mailto:<?php echo $company['email']; ?>"><?php echo $company['email']; ?></a></p>
				   		<p>Siga-nos: <a href="https://www.facebook.com/amapatelhas/" target="_blank">Facebook</a></p>
				   </div>
				</div>				
				<div class="col-md-6 span_2_of_3">
				  <div class="contact-form">
					    <form method="POST" action="<?php echo BASE_URL; ?>contact/receive">
					    	<div>
						    	<span><label>NOME</label></span>
						    	<span><input name="userName" type="text" class="textbox" required></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input name="userEmail" type="text" class="textbox" required></span>
						    </div>
						    <div>
						     	<span><label>TELEFONE</label></span>
						    	<span><input name="userPhone" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>ASSUNTO</label></span>
						    	<span><textarea name="userMsg" required> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" class="mybutton" value="Submit"></span>
						  </div>
					    </form>

				    </div>
  				</div>		
  				<h3>Ou por WhatsApp</h3><br>
  				<div style="text-align: center;">
	  				<a href="https://wa.me/+5596991480048" target="_blank">
	  					<img src="<?php echo BASE_URL; ?>images/whatsapp.png">	
	  				</a>
  				</div><br>
		  </div>
	  </div>
 </div>
<!---->
</body>
</html>