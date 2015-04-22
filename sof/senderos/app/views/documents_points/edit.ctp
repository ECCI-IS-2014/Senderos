<div class="documentsPoints form">
<?php echo $this->Form->create('DocumentsPoint');?>
	<fieldset>
		<legend><?php __('Edit Documents Point'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('document_id');
		echo $this->Form->input('point_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DocumentsPoint.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DocumentsPoint.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Documents Points', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Points', true), array('controller' => 'points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Point', true), array('controller' => 'points', 'action' => 'add')); ?> </li>
	</ul>
</div>