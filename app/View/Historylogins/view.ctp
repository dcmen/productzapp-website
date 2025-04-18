<div class="historylogins view">
<h2><?php echo __('Historylogin'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historylogin['Historylogin']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($historylogin['Historylogin']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Login'); ?></dt>
		<dd>
			<?php echo h($historylogin['Historylogin']['time_login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Logout'); ?></dt>
		<dd>
			<?php echo h($historylogin['Historylogin']['time_logout']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Count View'); ?></dt>
		<dd>
			<?php echo h($historylogin['Historylogin']['count_view']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historylogin'), array('action' => 'edit', $historylogin['Historylogin']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historylogin'), array('action' => 'delete', $historylogin['Historylogin']['id']), array(), __('Are you sure you want to delete # %s?', $historylogin['Historylogin']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historylogins'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historylogin'), array('action' => 'add')); ?> </li>
	</ul>
</div>
