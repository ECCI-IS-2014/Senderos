<div class="documentsPoints index">
	<h2><?php __('Associations between multimedia files and points');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('document_id');?></th>
			<th><?php echo $this->Paginator->sort('point_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($documentsPoints as $documentsPoint):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($documentsPoint['Document']['name'], array('controller' => 'documents', 'action' => 'view', $documentsPoint['Document']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($documentsPoint['Point']['name'], array('controller' => 'points', 'action' => 'view', $documentsPoint['Point']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $documentsPoint['DocumentsPoint']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $documentsPoint['DocumentsPoint']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $documentsPoint['DocumentsPoint']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentsPoint['DocumentsPoint']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<!--p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p-->

	<!--div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>

		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div-->
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Association', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Points', true), array('controller' => 'points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Point', true), array('controller' => 'points', 'action' => 'add')); ?> </li>
	</ul>
</div>