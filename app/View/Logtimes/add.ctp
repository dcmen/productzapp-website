<div class="logtimes form">
<?php echo $this->Form->create('Logtime'); ?>
	<fieldset>
		<legend><?php echo __('Add Logtime'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('logtime');
		echo $this->Form->input('os');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Logtimes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
