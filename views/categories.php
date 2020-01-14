Categoria

<?php echo $category_name; ?>

<div class="row">
<?php
$a = 0;
?>
<?php foreach($list as $product_item): ?>
	<div class="col-sm-4">
		<?php $this->loadView('product_item', $product_item); ?>
	</div>
	<?php
	if($a >= 2) {
		$a = 0;
		echo '</div><div class="row">';
	} else {
		$a++;
	}
	?>
<?php endforeach; ?>
</div>

<ul class="pagination">
	<?php for($q=1; $q<=$numberOfPages; $q++): ?>
  <li class="page-item <?php echo ($currentPage == $q)?'active':''?>"><a class="page-link" href="<?php echo BASE_URL; ?>categories/enter/<?php echo $id_category; ?>?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
	<?php endfor; ?>
</ul>