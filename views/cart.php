<h1><?php $this->lang->get('CART'); ?></h1>

<table class="table table-hover cart_table" style="font-weight: normal;">
	<thead>
		<tr>
			<th><?php $this->lang->get('IMAGE'); ?></th>
			<th><?php $this->lang->get('NAME'); ?></th>
			<th style="text-align: right;"><?php $this->lang->get('QUANTITY'); ?></th>
			<th style="text-align: right;"><?php $this->lang->get('PRICE'); ?></th>
			<th style="text-align: right;"><?php $this->lang->get('TOTAL'); ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $subtotal = 0; ?>
		<?php foreach($list as $l): ?>
			<?php $subtotal += (floatval($l['price']) * intval($l['qt'])); ?>
			<tr>
				
				<td><img src="<?php echo BASE_URL; ?>/media/products/<?php echo $l['image']; ?>" width="50"></td>

				<td><?php echo $l['name']; ?></td>

				<td style="text-align: right;"><input class="cart_input_qt" name="cart_input_qt" data-id="<?php echo $l['id']; ?>" style="max-width: 60px; text-align: right; border: 1px solid #DDDDDD;" type="number" value="<?php echo $l['qt']; ?>" min="1"></td>

				<td style="text-align: right;"><?php echo number_format($l['price'], 2, ',', '.'); ?></td>

				<td class="cart_subtotal" style="text-align: right;"><?php echo number_format((floatval($l['price']) * intval($l['qt'])), 2, ',', '.'); ?></td>

				<td><a href="<?php echo BASE_URL; ?>cart/del/<?php echo $l['id']; ?>"><img src="<?php echo BASE_URL; ?>assets/images/trash-bin.png" width="20"></a></td>

			</tr>
		<?php endforeach; ?>
		<tr style="font-weight: bold;">
			<td colspan="4" align="right"><?php $this->lang->get('SUBTOTAL'); ?></td>
			<td align="right"><?php echo number_format($subtotal, 2, ',', '.'); ?></td>
		</tr>
		<tr style="font-weight: bold;">
			<td colspan="4" align="right"><?php $this->lang->get('SHIPPING'); ?></td>
			<td align="right"><?php echo $shipping; ?></td>
		</tr>
		<tr style="font-weight: bold;">
			<td colspan="4" align="right"><?php $this->lang->get('TOTAL'); ?></td>
			<?php 
			$shipp = 0;
			if (isset($shipping['price'])) {
				$shipp = str_replace('.', '', $shipping['price']);
				$shipp = floatval(str_replace(',', '.', $shipping['price']));
			}
			?>
			<?php if($shipping == 'Frete Grátis'): ?>
			<td align="right"><?php echo (!empty($shipping['price']))?number_format($subtotal + $shipp, 2, ',', '.'):number_format($subtotal, 2, ',', '.'); ?></td>
			<?php else: ?>
				<td align="right"><?php echo $shipping; ?></td>
			<?php endif; ?>
		</tr>
	</tbody>
</table>

<hr>

<!-- CALCULO FRETE POR CEP
<?php $this->lang->get('TYPECEP'); ?>:
<form method="POST">
	<input type="text" name="cep">
	<input type="submit" value="<?php $this->lang->get('SHIPPCALC'); ?>" class="button">
</form>
-->

<div class="FRETE">
	<!-- CALCULO FRETE POR LOCALIDADE -->
	<form method="POST">
		<select name="cep" onchange="this.form.submit()">
			<option>Selecione o local de entrega:</option>
			<option value="macapa" <?php echo ($cep == 'macapa')?'selected="selected"':''; ?>>Macapá - AP</option>
			<option value="santana" <?php echo ($cep == 'santana')?'selected="selected"':''; ?>>Santana - AP</option>
			<option value="outro" <?php echo ($cep == 'outro')?'selected="selected"':''; ?>>Outro local</option>
		</select>
	</form>
	<hr>
	<?php if($cep == 'macapa' || $cep == 'santana'): ?>
	<form method="POST" action="<?php echo BASE_URL; ?>cart/payment_redirect" style="text-align: right;">
		<select name="payment_type">
			<option value="0"><?php $this->lang->get('SELECTPAYTYPE'); ?></option>
			<option value="checkoutTransparent">PagSeguro</option>
			<option value="mp">Mercado Pago</option>
			<option value="paypal">PayPal</option>
			<option value="boleto">Boleto Bancário</option>
		</select>
		<input type="submit" value="<?php $this->lang->get('CHECKOUT'); ?>" class="button">
	</form>
	<?php elseif($cep == 'outro'): ?>
		<a href="https://wa.me/+5596991480058" target="blank">Clique aqui para consultar o frete para outras localidades</a>
	<?php else: ?>
	<?php endif; ?>
</div>