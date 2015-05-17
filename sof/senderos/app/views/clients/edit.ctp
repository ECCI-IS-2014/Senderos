<div class="clients form">
<?php echo $this->Form->create('Client');?>
	<fieldset>
		<legend><?php __('Edit Client'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('name');
		echo $this->Form->input('lastname');
		echo $this->Form->input('role', array('options' => array('admin' => 'Administrator', 'cust' => 'Client'), 'title'=>'Rol', 'label'=>'Rol '));
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirm', array('label' => 'Confirm Password ', 'title' => 'Confirm Password', 'type'=>'password'));
		echo $this->Form->input('country_id');
	?>
	</fieldset>
    <fieldset>
        <legend><?php __('Edit Restrictions'); ?></legend>
        <table>
            <tr>
                <th>Id</th>
                <th>Client</th>
                <th>Model</th>
                <th>Record</th>
                <th>Creating</th>
                <th>Reading</th>
                <th>Updating</th>
                <th>Deleting</th>
            </tr>

            <?php $var =  0; ?>
            <?php foreach ($restrictions as $restriction): ?>
            <tr>
                <td> <?php echo $this->Form->input('id'.$var, array('type' => 'hidden', 'default' => $restriction['Restriction']['id'], 'readonly' => 'readonly'));?></td>
                <td> </td>
                <td><?php echo $this->Form->input('model'.$var, array('label' => false, 'default' => $restriction['Restriction']['model'], 'readonly' => 'readonly'));?></td>
                <td><?php echo $form->text('recordid'.$var, array('default' => $restriction['Restriction']['recordid'], 'type' => 'number', 'min' => -1 ) );?></td>
                <td><?php echo $this->Form->input('creating'.$var, array('label' => false, 'options' => array('false','true'), 'default' => $restriction['Restriction']['creating']));?></td>
                <td><?php echo $this->Form->input('reading'.$var, array('label' => false, 'options' => array('false','true'), 'default' => $restriction['Restriction']['reading']));?></td>
                <td><?php echo $this->Form->input('updating'.$var, array('label' => false, 'options' => array('false','true'), 'default' => $restriction['Restriction']['updating']));?></td>
                <td><?php echo $this->Form->input('deleting'.$var, array('label' => false, 'options' => array('false','true'), 'default' => $restriction['Restriction']['deleting']));?></td>
            </tr>
            <?php $var++; ?>
            <?php endforeach; ?>

        </table>
    </fieldset>
<?php echo $this->Form->end(__('Done', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Client.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Client.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Change Password', true), array('action' => 'change', $this->Form->value('Client.id'))); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
	</ul>
</div>