<div class="followedCars form">
<?php echo $this->Form->create('FollowedCar'); ?>
	<fieldset>
		<legend><?php echo __('Add Followed Car'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('car_id');
		echo $this->Form->input('created_at');
		echo $this->Form->input('updated_at');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Followed Cars'), array('action' => 'index')); ?></li>
	</ul>
</div>
