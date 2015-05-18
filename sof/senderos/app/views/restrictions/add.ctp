<div class="clients form">
<?php echo $this->Form->create('Restriction');?>
    <fieldset>
    <legend><?php __('Restrictions'); ?></legend>
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

        <?php foreach ($restrictions as $restriction): ?>
        <tr>
            <td><?php echo $restriction['Restriction']['id']; ?></td>
            <td><?php echo $restriction['Restriction']['client_id']; ?></td>
            <td><?php echo $restriction['Restriction']['model']; ?></td>
            <td><?php echo $restriction['Restriction']['recordid']; ?></td>
            <td><?php echo $restriction['Restriction']['creating']; ?></td>
            <td><?php echo $restriction['Restriction']['reading']; ?></td>
            <td><?php echo $restriction['Restriction']['updating']; ?></td>
            <td><?php echo $restriction['Restriction']['deleting']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    </fieldset>

    <fieldset>
        <legend><?php __('Add Restriction'); ?></legend>
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

            <tr>
                <td> </td>
                <td><?php echo $this->Form->input('client_id', array('label' => false, 'options' => $clients));?></td>
                <td><?php echo $this->Form->input('model', array('label' => false));?></td>
                <td><?php echo $form->text('recordid', array('type' => 'number', 'min' => -1, 'default' => -1 ) );?></td>
                <td><?php echo $this->Form->input('creating', array('label' => false, 'options' => array('false','true')));?></td>
                <td><?php echo $this->Form->input('reading', array('label' => false, 'options' => array('false','true')));?></td>
                <td><?php echo $this->Form->input('updating', array('label' => false, 'options' => array('false','true')));?></td>
                <td><?php echo $this->Form->input('deleting', array('label' => false, 'options' => array('false','true')));?></td>
            </tr>
        </table>
    </fieldset>

<?php echo $this->Form->end(__('Done', true));?>
</div>

<div class="actions" >
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Restrictions', true), array('action' => 'index'));?></li>
        <!-- <li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
	</ul>
</div>



