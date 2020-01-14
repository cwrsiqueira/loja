<h1><?php $this->lang->get('SEARCHFOR'); ?>: <?php echo !empty($searchTerm)?"$searchTerm - ":''; ?><?php $this->lang->get('CATEGORY'); ?>: <?php echo !empty($category_name)?$category_name:$this->lang->get('ALLCATEGORIES'); ?></h1>

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
  <li class="page-item <?php echo ($currentPage == $q)?'active':''?>"><a class="page-link" href="<?php BASE_URL; ?>?<?php
  $pag_array = $_GET;
  $pag_array['p'] = $q;
  echo http_build_query($pag_array);
  ?>"><?php echo $q; ?></a></li>
    <?php endfor; ?>
</ul>