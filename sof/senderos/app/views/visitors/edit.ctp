<div class="actions">
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Visitor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Visitor.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Visitors', true), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="visitors form">
<?php echo $this->Form->create('Visitor');?>
	<fieldset>
		<legend><?php __('Edit visitor'); ?></legend>
	<?php
            echo $this->Form->input('id');
            echo $this->Form->input('role');
            echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>