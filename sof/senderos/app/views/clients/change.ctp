<div class="clients form">
<?php echo $this->Form->create('Client');?>
	<fieldset>
		<legend><?php __('Change Password'); ?></legend>
	<?php
		echo $this->Form->input('new_password', array('label' => 'New Password', 'title' => 'New Password'));
		echo $this->Form->input('new_password_confirm', array('label' => 'Confirm Password', 'title' => 'Confirm Password', 'type'=>'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Done', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
	</ul>
</div>