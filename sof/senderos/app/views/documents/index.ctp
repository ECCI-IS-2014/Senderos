

<!--<?php debug($dopos); ?>-->


<?php


$point_id = 'none';

?>
<div class="actions">
</div>

<div class="infohelp">
    <a href="#" class="tooltip">
        <?php
            echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:15px;height:15px;float:right;"));
        ?>
        <span>
            To create a new document, you have to do it from the trail you want the point be associated to.
        </span>
    </a>
</div>

<div class="documents index">
	<h2><?php __('Documents');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<!--<th><?php echo $this->Paginator->sort('point');?></th>-->
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($documents as $document):
		//$class = null;
		//if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		//}
            $canDelete = 0;
            if( $_SESSION['role'] === 'restricted'){
				foreach($restrictions as $restriction):
					foreach($dopos as $dopo):
						if(  // caso 1: tiene permisos especificos sobre el sendero
							$dopo['Document']['id'] == $document['Document']['id'] &&
							$dopo['Point']['trail_id'] == $restriction['Trail']['id']
					    ){ $canDelete = 1; break; }
						foreach($stations as $station):
							foreach($trails as $trail):
								if( // caso 2: tiene permisos sobre todos los senderos de la estacion a la que pertenece el documento
								   $dopo['Document']['id'] == $document['Document']['id'] &&
								   $trail['Trail']['id'] ==  $dopo['Point']['trail_id'] &&
								   $station['Station']['id'] ==  $trail['Station']['id'] &&
								   $station['Station']['id'] ==  $restriction['Restriction']['station_id'] &&
								   $restriction['Restriction']['allt'] == 1
								 ){
									$canDelete = 1;
								}
							endforeach;
						endforeach;
					endforeach;
				endforeach;
            }
	?>



<?php

$current_point = 'none';
$current_point_name = 'none';

$current_trail = 'none';
$current_trail_name = 'none';

foreach($dopos as $dopo):
	if($dopo['Document']['id'] == $document['Document']['id'])
	{
		$current_point = $dopo['Point']['id'];
		$current_point_name = $dopo['Point']['name'];

		foreach($trails as $trail):
			if($trail['Trail']['id'] == $dopo['Point']['trail_id'])
			{
				$current_trail = $trail['Trail']['id'];
				$current_trail_name = $trail['Trail']['name'];
				break;
			}
		endforeach;

		break;
	}

endforeach;


if($current_point !== $point_id)
{

		if($i > 0)
		{
			echo "<tr><td colspan=4 style='background-color: white; border-bottom: 1px solid #FFF;'></td></tr>";
			echo "<tr><td colspan=4 style='background-color: white; border-bottom: 1px solid #FFF;'></td></tr>";
			echo "<tr><td colspan=4 style='background-color: white; border-bottom: 1px solid #FFF;'></td></tr>";
		}

		echo "<tr><td colspan=4 style='background-color: white;'>";
		echo "Point: ".$this->Html->link($current_point_name, array('controller' => 'trails', 'action' => 'edit', $current_trail));
		echo "&nbsp;&nbsp;".$this->Html->link('('.$current_trail_name.')', array('controller' => 'trails', 'action' => 'edit', $current_trail));
		echo '</td>';
                $point_id = $current_point;

		$i++;

		echo '</tr>';
}
?>


	<tr class="altrow">

		<td><?php echo $document['Document']['name']; ?>&nbsp;</td>
		<td><?php echo $document['Document']['description']; ?>&nbsp;</td>
		<td><?php echo $document['Document']['type']; ?>&nbsp;</td>
		<!--<td><?php echo $current_point_name; ?>&nbsp;</td>-->
		<td class="actions">
			<!--<?php echo $this->Html->link(__('View', true), array('action' => 'view', $document['Document']['id'])); ?>
			--><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('Edit', true), array('action' => 'edit', $document['Document']['id']));} ?>
			<?php if($this->Session->read('Auth.Client.role') == 'admin' || $canDelete==1){echo $this->Html->link(__('Delete', true), array('action' => 'delete', $document['Document']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $document['Document']['name']));} ?>
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
