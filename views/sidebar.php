
<aside>
	<h1><?php $this->lang->get('FILTER'); ?></h1>
	<div class="filterarea">

		<form method="GET">

			<input type="hidden" name="s" value="<?php echo (!empty($viewData['searchTerm']))?$viewData['searchTerm']:''; ?>">
			<input type="hidden" name="category" value="<?php echo (!empty($viewData['category']))?$viewData['category']:''; ?>">

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('BRANDS'); ?></div>
				<div class="filtercontent">
					<?php foreach($viewData['filters']['brands'] as $bitem): ?>
						<div class="filteritem">
  						<input <?php echo (isset($viewData['filters_selected']['brand']) && in_array($bitem['id'], $viewData['filters_selected']['brand']))?'checked="checked"':''; ?> type="checkbox" name="filter[brand][]" value="<?php echo $bitem['id']; ?>" id="filter_brand<?php echo $bitem['id']; ?>">
  						<label for="filter_brand<?php echo $bitem['id']; ?>"><?php echo $bitem['name']; ?></label>
  						<span class="count_brands">(<?php echo $bitem['count']; ?>)</span>
  					</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('PRICE'); ?></div>
				<div class="filtercontent">
					<input type="hidden" id="slider0" name="filter[slider0]" value="<?php echo $viewData['filters']['slider0']; ?>">
					<input type="hidden" id="slider1" name="filter[slider1]" value="<?php echo $viewData['filters']['slider1']; ?>">
				<input type="text" id="amount" readonly style="border:0;">
				<div id="slider-range"></div>
				</div>
			</div>
			
			<!-- FILTER STARS RATING
			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('RATING'); ?></div>
				<div class="filtercontent">

					<div class="filteritem">
						<input <?php echo (isset($viewData['filters_selected']['star']) && in_array('0', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> type="checkbox" name="filter[star][]" value="0" id="filter_star0">
						<label for="filter_star0">
							(<?php $this->lang->get('NOSTARS'); ?>)
						</label>
						<span class="count_brands">(<?php echo $viewData['filters']['stars'][0]; ?>)</span>
					</div>

					<div class="filteritem">
						<input <?php echo (isset($viewData['filters_selected']['star']) && in_array('1', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> type="checkbox" name="filter[star][]" value="1" id="filter_star1">
						<label for="filter_star1">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
						</label>
						<span class="count_brands">(<?php echo $viewData['filters']['stars'][1]; ?>)</span>
					</div>

					<div class="filteritem">
						<input <?php echo (isset($viewData['filters_selected']['star']) && in_array('2', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> type="checkbox" name="filter[star][]" value="2" id="filter_star2">
						<label for="filter_star2">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
						</label>
						<span class="count_brands">(<?php echo $viewData['filters']['stars'][2]; ?>)</span>
					</div>

					<div class="filteritem">
						<input <?php echo (isset($viewData['filters_selected']['star']) && in_array('3', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> type="checkbox" name="filter[star][]" value="3" id="filter_star3">
						<label for="filter_star3">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
						</label>
						<span class="count_brands">(<?php echo $viewData['filters']['stars'][3]; ?>)</span>
					</div>

					<div class="filteritem">
						<input <?php echo (isset($viewData['filters_selected']['star']) && in_array('4', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> type="checkbox" name="filter[star][]" value="4" id="filter_star4">
						<label for="filter_star4">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
						</label>
						<span class="count_brands">(<?php echo $viewData['filters']['stars'][4]; ?>)</span>
					</div>

					<div class="filteritem">
						<input <?php echo (isset($viewData['filters_selected']['star']) && in_array('5', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> type="checkbox" name="filter[star][]" value="5" id="filter_star5">
						<label for="filter_star5">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" height="15" border="0">
						</label>
						<span class="count_brands">(<?php echo $viewData['filters']['stars'][5]; ?>)</span>
					</div>

				</div>
			</div>
			-->

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('SALE'); ?></div>
				<div class="filtercontent">
					<div class="filteritem">
						<input <?php echo (isset($viewData['filters_selected']['sale']) && $viewData['filters_selected']['sale'] == '1')?'checked="checked"':''; ?> value="1" type="checkbox" name="filter[sale]" id="filter_sale">
						<label for="filter_sale"><?php $this->lang->get('SALE'); ?></label>
						<span class="count_brands">(<?php echo $viewData['filters']['sale']; ?>)</span>
					</div>
				</div>
			</div>

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('OPTIONS'); ?></div>
				<div class="filtercontent">
					<?php foreach($viewData['filters']['options'] as $option): ?>
						<strong><?php echo $option['name']; ?></strong><br>
						<?php foreach($option['options'] as $op): ?>
							<div class="filteritem">
	  						<input <?php echo (isset($viewData['filters_selected']['options']) && in_array($op['value'], $viewData['filters_selected']['options']))?'checked="checked"':''; ?> type="checkbox" name="filter[options][]" value="<?php echo $op['value']; ?>" id="filter_options<?php echo $op['id']; ?>">
	  						<label for="filter_options<?php echo $op['id']; ?>"><?php echo $op['value']; ?></label>
	  						<span class="count_brands">(<?php echo $op['count']; ?>)</span>
	  					</div>
						<?php endforeach; ?>
						<br>
					<?php endforeach; ?>
				</div>
			</div>

		</form>

	</div>
	<!--
	<div class="widget">
		<h1><?php $this->lang->get('FEATUREDPRODUCTS'); ?></h1>
		<div class="widget_body">
			
			<?php $this->loadView('widget_item', array('list'=>$viewData['widget_featured1'])); ?>

		</div>
	</div>
	-->
</aside>