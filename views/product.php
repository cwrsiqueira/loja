<div class="row">

	<div class="col-sm-5">

		<div class="mainphoto">
			<img src="<?php echo BASE_URL; ?>media/products/<?php echo $product_images[0]['url']; ?>">
		</div>

		<div class="gallery">
			<?php foreach($product_images as $img): ?>
				<div class="photo_item">
					<img src="<?php echo BASE_URL; ?>media/products/<?php echo $img['url']; ?>">
				</div>
			<?php endforeach; ?>
		</div>

	</div>

	<div class="col-sm-7">

		<h2><?php echo $product_info['name']; ?></h2>
		<small><?php echo $product_info['brand_name']; ?></small><br>
		<?php if($product_info['rating'] != '0'): ?>
			<?php for($q=0;$q<intval($product_info['rating']);$q++): ?>
				<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="15">
			<?php endfor; ?>
		<?php endif; ?>
		<hr>

		Descrição:
		<p><?php echo $product_info['description']; ?></p>
		<hr>
		<span class="price_from"><?php $this->lang->get('FROM'); ?> R$ <?php echo number_format($product_info['price_from'], 2, ',', '.'); ?></span><br>
		<span class="original_price"><?php $this->lang->get('FOR'); ?> R$ <?php echo number_format($product_info['price'], 2, ',', '.'); ?></span>
		<hr>

		<form method="POST" class="addtocart" action="<?php echo BASE_URL; ?>cart/add">
			<input type="hidden" name="id_product" value="<?php echo $product_info['id']; ?>">
			<label for="qt">Quant.:</label>
			<input type="number" name="qt_product" value="1" min="1" class="addtocart_qt">
			<input class="addtocart_submit" type="submit" value="<?php $this->lang->get('ADDTOCART'); ?>">
		</form>

	</div>
</div>
<hr>
<div style="font-weight: normal;" class="row">
	
	<div class="col-sm-6">
		<h3><?php $this->lang->get('PRODUCTESPECIFICATION'); ?></h3>
		<?php if($product_options != ''): ?>
			<?php foreach($product_options as $po): ?>
				<strong><?php echo $po['name']; ?></strong>: <?php echo $po['value']; ?><br>
			<?php endforeach; ?>
		<?php else: ?>
			Produto cadastrado sem especificações
		<?php endif; ?>
	</div>

	<div class="col-sm-6">
		<h3><?php $this->lang->get('REVIEWS'); ?></h3>
		<?php foreach($product_rates as $rate): ?>
			<strong><?php echo $rate['user_name']; ?></strong><br>
			
			<?php echo date('d/m/Y', strtotime($rate['date_rated'])); ?>

			<?php if($rate['points'] != '0'): ?>
				<?php for($q=0;$q<intval($rate['points']);$q++): ?>
					<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="10">
				<?php endfor; ?>
			<?php endif; ?>
			<br>
			<?php echo $rate['comment']; ?>
			<hr>
		<?php endforeach; ?>
	</div>

</div>