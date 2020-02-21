<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo BASE_URL; ?>cart">Carrinho de Compras</a></li>
		<li class="active">Pagamento na Obra</li>
	</ol>
</div>
<div class="container">

	<?php if(!empty($error)): ?>
		<div class="alert alert-danger">
			<span><?php echo $this->lang->get($error); ?></span>
		</div>
	<?php endif; ?>

	<form method="POST">

		<h3><?php $this->lang->get('PERSONALDATA'); ?></h3>

		<div class="form-group">

			<label for="name"><?php $this->lang->get('NAME'); ?>:</label>
			<input type="text" class="form-control" id="name" name="name" value="" required>

			<label for="cpf"><?php $this->lang->get('SOCIALSECURITY'); ?>:</label>
			<input type="text" class="form-control" id="cpf" name="cpf" value="" required>

			<label for="email"><?php $this->lang->get('E-MAIL'); ?>:</label>
			<input type="email" class="form-control" id="email" name="email" value="" required>

		</div>

		<h3><?php $this->lang->get('ADDRESSDATA'); ?></h3>

		<div class="form-group">

			<label for="phone"><?php $this->lang->get('PHONE'); ?>:</label>
			<input type="text" class="form-control" id="phone" name="phone" value="" required>

			<label for="areacode"><?php $this->lang->get('AREACODE'); ?>:</label>
			<input type="text" class="form-control" id="areacode" name="areacode" value="" required>

			<label for="street"><?php $this->lang->get('STREET'); ?>:</label>
			<input type="text" class="form-control" id="street" name="street" value="" required>

			<label for="number"><?php $this->lang->get('NUMBER'); ?>:</label>
			<input type="number" class="form-control" id="number" name="number" value="" required>

			<label for="complement"><?php $this->lang->get('COMPLEMENT'); ?>:</label>
			<input type="text" class="form-control" id="complement" name="complement" value="" required>

			<label for="neighborhood"><?php $this->lang->get('NEIGHBORHOOD'); ?>:</label>
			<input type="text" class="form-control" id="neighborhood" name="neighborhood" value="" required>

			<label for="city"><?php $this->lang->get('CITY'); ?>:</label>
			<input type="text" class="form-control" id="city" name="city" value="" required>

			<label for="state"><?php $this->lang->get('STATE'); ?>:</label>
			<SELECT class="form-control" id="state" name="state" required>
				<?php foreach($ceps as $key => $value):  ?>
					<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
				<?php endforeach; ?>
			</SELECT>

		</div>

		<input type="submit" value="<?php $this->lang->get('PAYOUT'); ?>" class="btn btn-primary button efetuarCompra">
		<br><br>

	</form>

</div>
