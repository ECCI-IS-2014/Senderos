<div class="documentsLanguages form">
<?php echo $this->Form->create('DocumentsLanguage');?>
	<fieldset>
		<legend><?php __('Edit association between multimedia file and language'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('document_id');
		echo $this->Form->input('language_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DocumentsPoint.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DocumentsPoint.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Associations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Languages', true), array('controller' => 'languages', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Language', true), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>