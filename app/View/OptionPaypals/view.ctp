<div class="optionPaypals view">
<h2><?php echo __('Option Paypal'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($optionPaypal['OptionPaypal']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($optionPaypal['OptionPaypal']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number Month'); ?></dt>
		<dd>
			<?php echo h($optionPaypal['OptionPaypal']['number_month']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($optionPaypal['OptionPaypal']['price']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Option Paypal'), array('action' => 'edit', $optionPaypal['OptionPaypal']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Option Paypal'), array('action' => 'delete', $optionPaypal['OptionPaypal']['id']), array(), __('Are you sure you want to delete # %s?', $optionPaypal['OptionPaypal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Option Paypals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Option Paypal'), array('action' => 'add')); ?> </li>
	</ul>
</div>
