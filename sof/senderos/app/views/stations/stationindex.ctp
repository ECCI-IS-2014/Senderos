<?php
	if(!isset($_SESSION['lanview']))
	{
		include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/en.php';
	}
	else
	{
		$language = $_SESSION['lanview'];
		include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/'.$language.'.php';
	}
?>

<?php $result = ''; ?>

<div class="actions">
	<ul>
		<li><?php

		if($_SESSION['role'] === 'administrator')
			$stationcreate = 'yes';
		else
			$stationcreate = 'no';

		if($stationcreate === 'yes')
			echo $this->Html->link(__('New station', true), array('action' => 'add'));
		/*else
			echo "---";*/
		?></li>
		<!-- <li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li> -->
	</ul>
</div>

<div class="Station index">
	<h2><?php __($str_stations);?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort($str_name);?></th>
			<th><?php echo $this->Paginator->sort($str_location);?></th>
			<th><?php echo $this->Paginator->sort($str_description);?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($stations as $station):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		$stationcreate = 'no';
		$stationread = 'no';
		$stationupdate = 'no';
		$stationdelete = 'no';
		
		if($_SESSION['role'] === 'restricted')
		{
			foreach ($restrictions as $restriction):
				if($restriction['Restriction']['allt'] == 1 && $restriction['Restriction']['station_id'] == $station['Station']['id'])
				{
					$stationread = 'yes';
					$stationupdate = 'yes';
					$stationdelete = 'yes';
					
					$result .= "<br>Found a restriction on ".$station['Station']['id'].": C=".$stationcreate.", R=".$stationread.", U=".$stationupdate.", D=".$stationdelete."";
				}else if($restriction['Restriction']['allt'] == 0 && $restriction['Restriction']['station_id'] == $station['Station']['id'] && $restriction['Restriction']['allt'] != null){
				    $stationread = 'yes';
				}
			endforeach;
		}
		else if($_SESSION['role'] === 'administrator')
		{
			$stationcreate = 'yes';
			$stationread = 'yes';
			$stationupdate = 'yes';
			$stationdelete = 'yes';
		}
		else
		{
			$stationcreate = 'no';
			$stationread = 'no';
			$stationupdate = 'no';
			$stationdelete = 'no';
		}
		
		if($stationread == 'yes')
		{
	?>
	<tr<?php echo $class;?>>
		<td>
        <?php echo $this->Html->link($station['Station']['name'], array('controller' => 'stations', 'action' => 'view', $station['Station']['id'])); ?>
        </td>
        <td><?php echo $station['Station']['location']; ?>&nbsp;</td>
		<td><?php echo $station['Station']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php 
			if($stationread === 'yes')
				echo $this->Html->link(__('View', true), array('action' => 'view', $station['Station']['id'])); 
			/*else
				echo "---";*/
			?>
			<?php 
				if($stationupdate === 'yes')
					echo $this->Html->link(__('Edit', true), array('action' => 'edit', $station['Station']['id'])); 
				/*else
					echo "---";*/
				?>
			<?php 
				if($stationdelete === 'yes')
					echo $this->Html->link(__('Delete', true), array('action' => 'delete', $station['Station']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $station['Station']['name'])); 
				/*else 
					echo "---";*/
			?>
		</td>
	</tr>
<?php } endforeach; ?>
	</table>
	<!--p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p-->

	<!--div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __($str_previous, true), array(), null, array('class'=>'disabled'));?>
	  	<?php echo $this->Paginator->numbers();?>
 
		<?php echo $this->Paginator->next(__($str_next, true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div-->
</div>
