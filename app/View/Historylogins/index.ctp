<div class="historylogins index">
	<h2><?php echo __('Historylogins'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('time_login'); ?></th>
			<th><?php echo $this->Paginator->sort('time_logout'); ?></th>
			<th><?php echo $this->Paginator->sort('count_view'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($historylogins as $historylogin): ?>
	<tr>
		<td><?php echo h($historylogin['Historylogin']['id']); ?>&nbsp;</td>
		<td><?php echo h($historylogin['Historylogin']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($historylogin['Historylogin']['time_login']); ?>&nbsp;</td>
		<td><?php echo h($historylogin['Historylogin']['time_logout']); ?>&nbsp;</td>
		<td><?php echo h($historylogin['Historylogin']['count_view']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $historylogin['Historylogin']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $historylogin['Historylogin']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $historylogin['Historylogin']['id']), array(), __('Are you sure you want to delete # %s?', $historylogin['Historylogin']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Historylogin'), array('action' => 'add')); ?></li>
	</ul>
</div>
