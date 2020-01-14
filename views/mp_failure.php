<h1><?php $this->lang->get('MPPENDINGFAILURE'); ?></h1>
<hr>
<?php if(!empty($error)): ?>
	<h3 style="background-color: red; color: white;"><?php echo $error; ?></h3>
<?php endif; ?>
<hr>
<h4><a href="<?php echo BASE_URL; ?>"><?php $this->lang->get('CLICKTOHOME'); ?></a></h4>