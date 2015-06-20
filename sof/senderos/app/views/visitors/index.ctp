<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Visitor', true), array('action' => 'add')); ?></li>
	</ul>
</div>
<div class="visitors index">
	<h2><?php __('Visitors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('role');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($visitors as $visitor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $visitor['Visitor']['role']; ?>&nbsp;</td>
        <td><?php echo $visitor['Visitor']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $visitor['Visitor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $visitor['Visitor']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $visitor['Visitor']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $visitor['Visitor']['role'])); ?>
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