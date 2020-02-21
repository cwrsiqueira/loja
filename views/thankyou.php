<div style="min-height: 500px; border-top:50px;" class="container">
	<h1>Compra efetuada com sucesso!</h1>
	<hr>

	<p>Aguarde nosso contato!</p>
	<p>Você receberá também um e-mail de confirmação do seu pedido. Caso não receba em até 24 horas, verificar nas caixas de Spam e Lixo Eltrônico.</p>
	<p>Obrigado por escolher a Amapá Telhas</p>

	<?php if(!empty($link)): ?>
	<h4><a href="<?php echo $link ?>" target="blank"><?php $this->lang->get('CLICKTOBILLET'); ?></a></h4>
	<?php endif; ?>

	<hr>
	<h4><a href="<?php echo BASE_URL; ?>">Clique para voltar para HOME</a></h4>
</div>