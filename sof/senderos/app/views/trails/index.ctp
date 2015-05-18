<div class="trails index">
	<h2><?php __('Trails');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('station_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($trails as $trail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $trail['Trail']['name']; ?>&nbsp;</td>
		<td><?php echo $trail['Trail']['description']; ?>&nbsp;</td>
		<td><?php echo $trail['Trail']['image']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($trail['Station']['name'], array('controller' => 'stations', 'action' => 'view', $trail['Station']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $trail['Trail']['id'])); ?>
			<?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('Edit', true), array('action' => 'edit', $trail['Trail']['id']));} ?>
			<?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('Delete', true), array('action' => 'delete', $trail['Trail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trail['Trail']['id']));} ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<ul>
		<li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('New Trail', true), array('action' => 'add'));} ?></li>
		<li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add'));} ?></li>
	</ul>
</div>