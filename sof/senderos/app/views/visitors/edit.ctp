<div class="visitors form">
<?php echo $this->Form->create('Visitor');?>
	<fieldset>
		<legend><?php __('Edit association between multimedia file and goal visitor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('role');
        echo $this->Form->input('role', array('type'=>'select','options'=>array('Tourist','Student','Scientific')));
		echo $this->Form->input('document_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Visitor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Visitor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Associations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
	</ul>
</div>