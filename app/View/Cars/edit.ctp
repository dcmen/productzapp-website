<div class="cars form">
<?php echo $this->Form->create('Car'); ?>
	<fieldset>
		<legend><?php echo __('Edit Car'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('client_no');
		echo $this->Form->input('stock_no');
		echo $this->Form->input('dealer_code');
		echo $this->Form->input('manu_year');
		echo $this->Form->input('make');
		echo $this->Form->input('model');
		echo $this->Form->input('series');
		echo $this->Form->input('badge');
		echo $this->Form->input('body');
		echo $this->Form->input('doors');
		echo $this->Form->input('seats');
		echo $this->Form->input('body_colour');
		echo $this->Form->input('trim_colour');
		echo $this->Form->input('gears');
		echo $this->Form->input('fuel_type');
		echo $this->Form->input('retail');
		echo $this->Form->input('price');
		echo $this->Form->input('rego');
		echo $this->Form->input('odometer');
		echo $this->Form->input('cylinders');
		echo $this->Form->input('engine_capacity');
		echo $this->Form->input('vin_number');
		echo $this->Form->input('manu_month');
		echo $this->Form->input('options');
		echo $this->Form->input('comments');
		echo $this->Form->input('nvic');
		echo $this->Form->input('redbookcode');
		echo $this->Form->input('location');
		echo $this->Form->input('created_at');
		echo $this->Form->input('updated_at');
		echo $this->Form->input('gearbox');
		echo $this->Form->input('engine_number');
		echo $this->Form->input('status');
		echo $this->Form->input('image');
		echo $this->Form->input('sync');
		echo $this->Form->input('inventory');
		echo $this->Form->input('egc');
		echo $this->Form->input('drive_away_amount');
		echo $this->Form->input('is_drive_away');
		echo $this->Form->input('drive_type');
		echo $this->Form->input('active');
		echo $this->Form->input('transactor_id');
		echo $this->Form->input('action_transactor_id');
		echo $this->Form->input('notes');
		echo $this->Form->input('number_view');
		echo $this->Form->input('registration_date');
		echo $this->Form->input('transaction_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Car.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Car.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cars'), array('action' => 'index')); ?></li>
	</ul>
</div>
