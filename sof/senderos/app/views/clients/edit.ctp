<div class="actions">
	<ul>

		<li title="Delete this account"><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Client.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Client.id'))); ?></li>
		<li title="Index for Clients"><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
        <li title ="Change the password for this user"><?php echo $this->Html->link(__('Change Password', true), array('action' => 'change', $this->Form->value('Client.id'))); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
	</ul>
</div>
<div class="clients form">
<?php
echo $this->Session->flash('auth');
echo $this->Form->create('Client');
?>
	<fieldset>
		<legend><?php __('Edit Client'); ?></legend>
        <h1 title= "You MAY change the username for the owner of the account"> <?php echo $this->Form->input('username');?></h1>
		<h1 title= "You MAY change the name of the owner of the account"> <?php echo $this->Form->input('name');?></h1>
		<h1 title= "You MAY change the first lastname of the owner of the account"> <?php echo $this->Form->input('lastname');?></h1>
		<!-- echo $this->Form->input('role', array('options' => array('admin' => 'Administrator', 'cust' => 'Client'), 'title'=>'Rol', 'label'=>'Rol '));-->
        <?php
                if($this->Session->read('Auth.Client.id') != null){
                if($this->Session->read('Auth.Client.role') == 'admin'){
                echo $this->Form->input('role', array('options' => array('admin' => 'Administrator', 'cust' => 'Restricted'), 'title'=>'You MAY change the role for this user', 'label'=>'Role '));
                }else{
                echo $this->Form->input('role', array('options' => array('cust' => 'Restricted'), 'title'=>'You MAY change the role for this user', 'label'=>'Role '));
                }
                }else{
                echo $this->Form->input('role', array('options' => array('cust' => 'Restricted'), 'title'=>'You MAY change the role for this user', 'label'=>'Role '));
                }
        ?>
		<!-- <h1 title= "You MUST type a password"> <?php echo $this->Form->input('password');?></h1>
		<?php echo $this->Form->input('password_confirm', array('label' => 'Confirm Password ', 'title' => 'You MUST retype the password', 'type'=>'password'));?> -->
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));
      echo "<input type='button' id='hiddencancel' value='Cancel' onclick=\"window.location.href = window.history.back(1);\" style='font-size:small;color:white;background-color:#7BC143;border-radius:3px;border: 0px solid #2D6324;margin-left:3px;padding: 4px 8px;width:auto;display:inline;float:left;'/>";
?>
</div>