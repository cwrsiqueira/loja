<div class="container">

<h1>CheckOut PagSeguro</h1>

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

<h3><?php $this->lang->get('PAYMENTDATA'); ?></h3>

<div class="form-group">

	<label for="cardholder"><?php $this->lang->get('CARDHOLDER'); ?></label>
	<input type="text" class="form-control" id="cardholder" name="cardholder" value="">

	<label for="cardholder_cpf"><?php $this->lang->get('CARDHOLDERSOCIALSECURITY'); ?></label>
	<input type="text" class="form-control" id="cardholder_cpf" name="cardholder_cpf" value="">

	<label for="card_number"><?php $this->lang->get('CARDNUMBER'); ?></label>
	<input type="text" class="form-control" id="card_number" name="card_number">

	<label for="cvv"><?php $this->lang->get('SECURITYCODE'); ?></label>
	<input type="text" class="form-control" id="cvv" name="cvv">

	<label><?php $this->lang->get('EXPIRATION'); ?></label>
	<select name="exp_month" class="form-control">
		<?php for($q=1;$q<=12;$q++): ?>
			<option><?php echo ($q<10)?'0'.$q:$q; ?></option>
		<?php endfor; ?>
	</select>
	<select name="exp_year" class="form-control">
		<?php $year = intval(date('Y')); ?>
		<?php for($q=$year;$q<=$year+20;$q++): ?>
			<option><?php echo $q; ?></option>
		<?php endfor; ?>
	</select>

	<label for="inst"><?php $this->lang->get('INSTALLMENTS'); ?></label>
	<select name="inst" class="form-control"></select>

</div>

<input type="hidden" name="total" value="<?php echo $total; ?>">

<button class="button payout"><?php $this->lang->get('PAYOUT'); ?></button>

</div>



<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/checkoutTransparent.js"></script>
<script type="text/javascript">PagSeguroDirectPayment.setSessionId("<?php echo $sessionCode; ?>");</script>