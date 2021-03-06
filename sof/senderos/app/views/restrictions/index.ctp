<?php
$trail_id = 'none';
$client_id = 'none';
?>

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
            You can grant permissions to a restricted user over a given station or trail. The user would be allowed to edit and delete them, but not
            to create new ones. Also, the user could create, edit, and delete all the elements associated to the given trail or station.
            <br><br>Grant new permissions by clicking on the "New Permission" button, and remove them by clicking on the "Delete" option.
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
			
			<?php
            if($restriction['Station']['id'] !== $station_id)
            {

            		if($i > 0)
            		{
            			echo "<tr><td colspan=3 style='background-color: white; border-bottom: 1px solid #FFF;'></td></tr>";
            		}

            		echo "<tr><td colspan=3 style='background-color: white;'>";
            		echo "<b>Station: </b>".$this->Html->link($restriction['Station']['name'], array('controller' => 'stations', 'action' => 'view', $restriction['Station']['id']));
            		echo '</td>';
                    $station_id = $restriction['Station']['id'];

            		$i++;

            		echo '</tr>';
            }
            ?>

            <?php
                        if($restriction['Client']['id'] !== $client_id)
                        {

                        		if($i > 0)
                        		{
                        			echo "<tr><td colspan=3 style='background-color: white; border-bottom: 1px solid #FFF;'></td></tr>";
                        		}

                        		echo "<tr><td colspan=3 style='background-color: white;'>";
                        		echo "<b>Client: </b>".$this->Html->link($restriction['Client']['name'], array('controller' => 'Client', 'action' => 'view', $restriction['Client']['id']));
                        		echo '</td>';
                                $client_id = $restriction['Client']['id'];

                        		$i++;

                        		echo '</tr>';
                        }
            ?>
			
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