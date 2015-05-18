<div class="clients form">
<?php
echo $this->Session->flash('auth');
echo $this->Form->create('Client');
?>
	<fieldset>
		<legend><?php __('Add Client'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('name');
		echo $this->Form->input('lastname');
		echo $this->Form->input('role', array('options' => array('admin' => 'Administrator', 'cust' => 'Client'), 'title'=>'Rol', 'label'=>'Rol '));;
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirm', array('label' => 'Confirm Password ', 'title' => 'Confirm Password', 'type'=>'password'));
		echo $this->Form->input('country_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Done', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
		<!-- <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
	</ul>
</div>