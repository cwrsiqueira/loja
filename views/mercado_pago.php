<div class="container">

	<h1>CheckOut Mercado Pago</h1>

	<?php if(!empty($error)): ?>
		<div class="alert alert-danger">
			<span><?php echo $this->lang->get($error); ?></span>
		</div>
	<?php endif; ?>

	<form method="POST">

		<h3><?php $this->lang->get('PERSONALDATA'); ?></h3>

		<div class="form-group">

			<label for="name"><?php $this->lang->get('NAME'); ?>:</label>
			<input type="text" class="form-control" id="name" name="name" value="">

			<label for="cpf"><?php $this->lang->get('SOCIALSECURITY'); ?>:</label>
			<input type="text" class="form-control" id="cpf" name="cpf" value="">

			<label for="email"><?php $this->lang->get('E-MAIL'); ?>:</label>
			<input type="email" class="form-control" id="email" name="email" value="">

			<label for="password"><?php $this->lang->get('PASSWORD'); ?>:</label>
			<input type="password" class="form-control" id="password" name="password" value="">

		</div>

		<h3><?php $this->lang->get('ADDRESSDATA'); ?></h3>

		<div class="form-group">

			<label for="phone"><?php $this->lang->get('PHONE'); ?>:</label>
			<input type="text" class="form-control" id="phone" name="phone" value="">

			<label for="areacode"><?php $this->lang->get('AREACODE'); ?>:</label>
			<input type="text" class="form-control" id="areacode" name="areacode" value="">

			<label for="street"><?php $this->lang->get('STREET'); ?>:</label>
			<input type="text" class="form-control" id="street" name="street" value="">

			<label for="number"><?php $this->lang->get('NUMBER'); ?>:</label>
			<input type="text" class="form-control" id="number" name="number" value="">

			<label for="complement"><?php $this->lang->get('COMPLEMENT'); ?>:</label>
			<input type="text" class="form-control" id="complement" name="complement" value="">

			<label for="neighborhood"><?php $this->lang->get('NEIGHBORHOOD'); ?>:</label>
			<input type="text" class="form-control" id="neighborhood" name="neighborhood" value="">

			<label for="city"><?php $this->lang->get('CITY'); ?>:</label>
			<input type="text" class="form-control" id="city" name="city" value="">

			<label for="state"><?php $this->lang->get('STATE'); ?>:</label>
			<input type="text" class="form-control" id="state" name="state" value="">

		</div>

		<input type="submit" value="<?php $this->lang->get('PAYOUT'); ?>" class="button efetuarCompra">

	</form>

</div>
