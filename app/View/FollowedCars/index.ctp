<div class="followedCars index">
	<h2><?php echo __('Followed Cars'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('car_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created_at'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($followedCars as $followedCar): ?>
	<tr>
		<td><?php echo h($followedCar['FollowedCar']['id']); ?>&nbsp;</td>
		<td><?php echo h($followedCar['FollowedCar']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($followedCar['FollowedCar']['car_id']); ?>&nbsp;</td>
		<td><?php echo h($followedCar['FollowedCar']['created_at']); ?>&nbsp;</td>
		<td><?php echo h($followedCar['FollowedCar']['updated_at']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $followedCar['FollowedCar']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $followedCar['FollowedCar']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $followedCar['FollowedCar']['id']), array(), __('Are you sure you want to delete # %s?', $followedCar['FollowedCar']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Followed Car'), array('action' => 'add')); ?></li>
	</ul>
</div>
