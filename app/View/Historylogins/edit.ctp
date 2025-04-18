<div class="historylogins form">
<?php echo $this->Form->create('Historylogin'); ?>
	<fieldset>
		<legend><?php echo __('Edit Historylogin'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Historylogin.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Historylogin.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Historylogins'), array('action' => 'index')); ?></li>
	</ul>
</div>
