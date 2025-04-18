<div class="followedCars view">
<h2><?php echo __('Followed Car'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($followedCar['FollowedCar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($followedCar['FollowedCar']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Car Id'); ?></dt>
		<dd>
			<?php echo h($followedCar['FollowedCar']['car_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($followedCar['FollowedCar']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($followedCar['FollowedCar']['updated_at']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Followed Car'), array('action' => 'edit', $followedCar['FollowedCar']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Followed Car'), array('action' => 'delete', $followedCar['FollowedCar']['id']), array(), __('Are you sure you want to delete # %s?', $followedCar['FollowedCar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Followed Cars'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Followed Car'), array('action' => 'add')); ?> </li>
	</ul>
</div>
