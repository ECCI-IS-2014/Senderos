<div class="documentsLanguages index">
	<h2><?php __('Associations between multimedia files and languages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('document_id');?></th>
			<th><?php echo $this->Paginator->sort('language_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($documentsLanguages as $documentsLanguage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($documentsLanguage['Document']['name'], array('controller' => 'documents', 'action' => 'view', $documentsLanguage['Document']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($documentsLanguage['Language']['name'], array('controller' => 'languages', 'action' => 'view', $documentsLanguage['Language']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $documentsLanguage['DocumentsLanguage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $documentsLanguage['DocumentsLanguage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $documentsLanguage['DocumentsLanguage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentsLanguage['DocumentsLanguage']['id'])); ?>
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
        <li><?php echo $this->Html->link(__('List Languages', true), array('controller' => 'languages', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Language', true), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>