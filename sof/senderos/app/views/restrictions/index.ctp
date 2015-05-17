<div class="points form">
<?php echo $this->Form->create('Restriction');?>
	<fieldset>
		<legend><?php __('View Restrictions'); ?></legend>
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
                <td>
                    <?php echo $this->Html->link(__('Edit', true), array('controller' => 'restrictions', 'action' => 'edit', $restriction['Restriction']['id'])); ?>
                </td>
                <td>
                    <?php echo $this->Html->link(__('Delete', true), array('controller' => 'restrictions', 'action' => 'delete', $restriction['Restriction']['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
	</fieldset>
</div>