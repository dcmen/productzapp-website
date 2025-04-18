<div class="redeemCodes view">
<h2><?php echo __('Redeem Code'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($redeemCode['RedeemCode']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($redeemCode['RedeemCode']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($redeemCode['User']['name'], array('controller' => 'users', 'action' => 'view', $redeemCode['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Redeem Code'), array('action' => 'edit', $redeemCode['RedeemCode']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Redeem Code'), array('action' => 'delete', $redeemCode['RedeemCode']['id']), array(), __('Are you sure you want to delete # %s?', $redeemCode['RedeemCode']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Redeem Codes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Redeem Code'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
