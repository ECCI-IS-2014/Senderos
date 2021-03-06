<?php if($this->Session->read("Auth.Client.role") != 'cust'){ ?>
<div class="actions">
	<ul>
		<li title = "Add a new client"><?php echo $this->Html->link(__('New Client', true), array('action' => 'add')); ?></li>
		<li title= "List of restrictions"><?php echo $this->Html->link(__('List Permissions', true), array('controller' => 'restrictions', 'action' => 'index')); ?> </li>
		<li title = "Add a new restriction"><?php echo $this->Html->link(__('New Permission', true), array('controller' => 'restrictions', 'action' => 'add')); ?> </li>
		<!-- <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
	</ul>
</div>
<?php } ?>

<div class="infohelp">
    <a href="#" class="tooltip">
        <?php
            echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:15px;height:15px;float:right;"));
        ?>
        <span>
            In addition to create new users you can also grant them permissions.<br><br>
            <strong>What is a permission?</strong><br>
            A permission over a given station or trail allows a restricted user to edit and delete them, but not to create new ones.
            Also, the user would be allowed to create, edit, and delete all the elements associated to the given trail or station.
            <br><br>Grant new permissions by clicking the "New Permission" button.
        </span>
    </a>
</div>

<div class="clients index">
	<h2><?php __('Clients');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!-- <th><?php echo $this->Paginator->sort('id');?></th> -->
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('lastname');?></th>
			<th><?php echo $this->Paginator->sort('role');?></th>
			<!-- <th><?php echo $this->Paginator->sort('password');?></th> -->
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($clients as $client):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<!-- <td><?php echo $client['Client']['id']; ?>&nbsp;</td> -->
		<td><?php echo $client['Client']['username']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['name']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['lastname']; ?>&nbsp;</td>
		<td><?php echo $client['Client']['role']; ?>&nbsp;</td>
		<!-- <td><?php echo $client['Client']['password']; ?>&nbsp;</td> -->
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $client['Client']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $client['Client']['id'])); ?>
            <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $client['Client']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $client['Client']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<!--p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p-->

	<!--div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>

		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div-->
</div>