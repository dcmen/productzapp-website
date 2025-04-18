<div class="optionPaypals form">
<?php echo $this->Form->create('OptionPaypal'); ?>
	<fieldset>
		<legend><?php echo __('Add Option Paypal'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('number_month');
		echo $this->Form->input('price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Option Paypals'), array('action' => 'index')); ?></li>
	</ul>
</div>
