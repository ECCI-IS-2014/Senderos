<div class="points form">
<?php echo $this->Form->create('Point');?>
	<fieldset>
		<legend><?php __('Add Point'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('cordx');
		echo $this->Form->input('cordy');
		echo $this->Form->input('description');
		echo $this->Form->input('trail_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Points', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Trails', true), array('controller' => 'trails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trail', true), array('controller' => 'trails', 'action' => 'add')); ?> </li>
	</ul>
</div>