<div class="actions">
<ul>
    <li><?php echo $this->Html->link(__('New Permission', true), array('action' => 'add')); ?></li>
    <li><?php echo $this->Html->link(__('List Clients', true), array('controller' => 'clients', 'action' => 'index')); ?> </li>
    <!-- <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
</ul>
</div>

<div class="infohelp">
    <a href="#" class="tooltip">
        <?php
            echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:right;"));
        ?>
        <span>
            You can grant permissions to a client over a station or a given trail.
        </span>
    </a>
</div>

<div class="restrictions index">
<?php echo $this->Form->create('Restriction');?>
	<fieldset>
		<legend><?php __('View Permissions'); ?></legend>
        <table>
            <tr>
                <th>Client</th>
                <th>Station</th>
                <th>Permission in all trails?</th>
                <th>Trail Name</th>
                <th class="actions"><?php __('Actions');?></th>
            </tr>

            <?php foreach ($restrictions as $restriction): ?>
            <tr>
                <td><?php echo $restriction['Client']['username']; ?></td>
                <td><?php echo $restriction['Station']['name']; ?></td>
                <td><?php if ($restriction['Restriction']['allt'] ==1 ){echo 'TRUE';} else {echo 'FALSE';} ?></td>
                <td><?php echo $restriction['Trail']['name']; ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $restriction['Restriction']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $restriction['Restriction']['id'])); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
	</fieldset>
</div>