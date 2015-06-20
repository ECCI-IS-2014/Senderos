<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Visitors', true), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="visitors form">
<?php echo $this->Form->create('Visitor');?>
	<fieldset>
		<legend><?php __('Add visitor'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('role');
        echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>