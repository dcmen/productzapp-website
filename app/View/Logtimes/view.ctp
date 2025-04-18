<div class="logtimes view">
<h2><?php echo __('Logtime'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($logtime['Logtime']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($logtime['User']['name'], array('controller' => 'users', 'action' => 'view', $logtime['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logtime'); ?></dt>
		<dd>
			<?php echo h($logtime['Logtime']['logtime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Os'); ?></dt>
		<dd>
			<?php echo h($logtime['Logtime']['os']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Logtime'), array('action' => 'edit', $logtime['Logtime']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Logtime'), array('action' => 'delete', $logtime['Logtime']['id']), array(), __('Are you sure you want to delete # %s?', $logtime['Logtime']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Logtimes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logtime'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
