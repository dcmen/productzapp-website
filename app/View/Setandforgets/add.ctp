<div class="setandforgets form">
<?php echo $this->Form->create('Setandforget'); ?>
	<fieldset>
		<legend><?php echo __('Add Setandforget'); ?></legend>
	<?php
		echo $this->Form->input('search_params');
		echo $this->Form->input('user_id');
		echo $this->Form->input('created_at');
		echo $this->Form->input('updated_at');
		echo $this->Form->input('vin_number');
		echo $this->Form->input('customer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Setandforgets'), array('action' => 'index')); ?></li>
	</ul>
</div>
