<div class="visitors form">
<?php echo $this->Form->create('Visitor');?>
	<fieldset>
		<legend><?php __('Associate a goal visitor to a multimedia file'); ?></legend>
	<?php
		//echo $this->Form->input('role', array('type'=select));
        $options = array('Student' => 'Students','Professor' => 'Professors','Scientist'=>'Scientists', 'Natural' => 'Naturals');
        echo $this->Form->input('role', array('type'=>'select','options' => $options));
		echo $this->Form->input('document_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Visitors', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
	</ul>
</div>