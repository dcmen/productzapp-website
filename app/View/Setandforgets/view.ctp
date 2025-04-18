<div class="setandforgets view">
<h2><?php echo __('Setandforget'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($setandforget['Setandforget']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Search Params'); ?></dt>
		<dd>
			<?php echo h($setandforget['Setandforget']['search_params']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($setandforget['Setandforget']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($setandforget['Setandforget']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($setandforget['Setandforget']['updated_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vin Number'); ?></dt>
		<dd>
			<?php echo h($setandforget['Setandforget']['vin_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Id'); ?></dt>
		<dd>
			<?php echo h($setandforget['Setandforget']['customer_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Setandforget'), array('action' => 'edit', $setandforget['Setandforget']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Setandforget'), array('action' => 'delete', $setandforget['Setandforget']['id']), array(), __('Are you sure you want to delete # %s?', $setandforget['Setandforget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Setandforgets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setandforget'), array('action' => 'add')); ?> </li>
	</ul>
</div>
