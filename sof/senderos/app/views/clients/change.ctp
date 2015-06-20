<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="clients form">
<?php
echo $this->Session->flash('auth');
echo $this->Form->create('Client');
?>
	<fieldset>
		<legend><?php __('Change Password'); ?></legend>
	<?php
		echo $this->Form->input('password', array('label' => 'New Password', 'title' => 'Type a new password'));
		echo $this->Form->input('password_confirm', array('label' => 'Confirm Password', 'title' => 'Retype the new password', 'type'=>'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Done', true));?>
</div>