<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Language.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Language.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Languages', true), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="languages form">
<?php echo $this->Form->create('Language');?>
	<fieldset>
		<legend><?php __('Edit Language'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>