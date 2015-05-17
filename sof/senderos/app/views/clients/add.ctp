<div class="clients form">
<?php echo $this->Form->create('Client');?>
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
    <fieldset>
    <legend><?php __('Add Restrictions'); ?></legend>
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
        <?php foreach ($models as $model): ?>
            <tr>
                <td> </td>
                <td> </td>
                <td><?php echo $this->Form->input('model'.$var, array('label' => false, 'default' => $model, 'readonly' => 'readonly'));?></td>
                <td><?php echo $form->text('recordid'.$var, array('type' => 'number', 'min' => -1, 'default' => -1 ) );?></td>
                <td><?php echo $this->Form->input('creating'.$var, array('label' => false, 'options' => array('false','true')));?></td>
                <td><?php echo $this->Form->input('reading'.$var, array('label' => false, 'options' => array('false','true')));?></td>
                <td><?php echo $this->Form->input('updating'.$var, array('label' => false, 'options' => array('false','true')));?></td>
                <td><?php echo $this->Form->input('deleting'.$var, array('label' => false, 'options' => array('false','true')));?></td>
            </tr>
        <?php $var++; ?>
        <?php endforeach; ?>
    </table>
        <td>
            <?php //echo $this->Form->button(__('Add restrictions for this client', true), array('type' => 'button', 'controller' => 'clients', 'action' => 'addRestriction')); ?>
        </td>
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



