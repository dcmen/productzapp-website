<div class="setandforgets form">
<?php echo $this->Form->create('Setandforget'); ?>
	<fieldset>
		<legend><?php echo __('Edit Setandforget'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Setandforget.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Setandforget.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Setandforgets'), array('action' => 'index')); ?></li>
	</ul>
</div>
