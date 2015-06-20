<div class="documentsVisitors form">
<?php echo $this->Form->create('DocumentsVisitor');?>
	<fieldset>
		<legend><?php __('Add association between multimedia file and goal visitor'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('document_id');
		echo $this->Form->input('visitor_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Associations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Visitors', true), array('controller' => 'visitors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visitor', true), array('controller' => 'visitors', 'action' => 'add')); ?> </li>
	</ul>
</div>