<h1><?php $this->lang->get('THANKYOUFORBY'); ?></h1>
<hr>

<?php if(!empty($link)): ?>
<h4><a href="<?php echo $link ?>" target="blank"><?php $this->lang->get('CLICKTOBILLET'); ?></a></h4>
<?php endif; ?>

<hr>
<h4><a href="<?php echo BASE_URL; ?>"><?php $this->lang->get('CLICKTOHOME'); ?></a></h4>