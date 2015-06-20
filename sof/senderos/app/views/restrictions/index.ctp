<div class="actions">
<ul>
    <li><?php echo $this->Html->link(__('New Permission', true), array('action' => 'add')); ?></li>
    <li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
    <!-- <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
</ul>
</div>
<div class="restrictions index">
<?php echo $this->Form->create('Restriction');?>
	<fieldset>
		<legend><?php __('View Permissions'); ?></legend>
        <table>
            <tr>
                <th>Client</th>
                <th>Station</th>
                <th>All trails</th>
                <th>Trail id</th>
                <th class="actions"><?php __('Actions');?></th>
            </tr>

            <?php foreach ($restrictions as $restriction): ?>
            <tr>
                <td><?php echo $restriction['Client']['username']; ?></td>
                <td><?php echo $restriction['Station']['name']; ?></td>
                <td><?php if ($restriction['Restriction']['allt'] ==1 ){echo 'TRUE';} else {echo 'FALSE';} ?></td>
                <td><?php if( $restriction['Restriction']['allt'] == 0 ) {echo $restriction['Trail']['name']; }else { echo 'NA'; } ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $restriction['Restriction']['id'])); ?>
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $restriction['Restriction']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $restriction['Restriction']['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
	</fieldset>
</div>