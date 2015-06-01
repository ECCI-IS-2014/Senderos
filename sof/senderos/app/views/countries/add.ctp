<div class="countries form">
<?php echo $this->Form->create('Country');?>
	<fieldset>
		<legend><?php __('Add Country'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('code');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Countries', true), array('action' => 'index'));?></li>
	</ul>
</div>