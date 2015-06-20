<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Languages', true), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="languages form">
<?php echo $this->Form->create('Language');?>
	<fieldset>
		<legend><?php __('Add Language'); ?></legend>
	    <?php
		    echo $this->Form->input('id', array('type' => 'hidden'));
		    echo $this->Form->input('code');
		    echo $this->Form->input('name');
	    ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>