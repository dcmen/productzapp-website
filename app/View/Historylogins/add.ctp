<div class="historylogins form">
<?php echo $this->Form->create('Historylogin'); ?>
	<fieldset>
		<legend><?php echo __('Add Historylogin'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('time_login');
		echo $this->Form->input('time_logout');
		echo $this->Form->input('count_view');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Historylogins'), array('action' => 'index')); ?></li>
	</ul>
</div>
