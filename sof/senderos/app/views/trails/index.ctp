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

<div class="trails index">
	<h2><?php __($str_trails);?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort($str_name);?></th>
			<th><?php echo $this->Paginator->sort($str_description);?></th>
			<th><?php echo $this->Paginator->sort($str_images);?></th>
			<th><?php echo $this->Paginator->sort($str_stations);?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($trails as $trail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		$trailcreate = 'no';
		$trailread = 'yes';
		$trailupdate = 'no';
		$traildelete = 'no';
		
		if($_SESSION['role'] === 'restricted')
		{
			foreach ($restrictions as $restriction):
				if($restriction['Restriction']['model'] == 'Trail' && $restriction['Restriction']['recordid'] == $trail['Trail']['id'])
				{
					if($restriction['Restriction']['creating'] === '1')
						$trailcreate = 'yes';
					if($restriction['Restriction']['reading'] === '0')
						$trailread = 'no';
					if($restriction['Restriction']['updating'] === '1')
						$trailupdate = 'yes';
					if($restriction['Restriction']['deleting'] === '1')
						$traildelete = 'yes';
					
					$result .= "<br>Found a restriction on ".$trail['Trail']['id'].": C=".$trailcreate.", R=".$trailread.", U=".$trailupdate.", D=".$traildelete."";
				}
			endforeach;
		}
		else if($_SESSION['role'] === 'administrator')
		{
			$trailcreate = 'yes';
			$trailread = 'yes';
			$trailupdate = 'yes';
			$traildelete = 'yes';
		}
		else
		{
			$trailcreate = 'no';
			$trailread = 'yes';
			$trailupdate = 'no';
			$traildelete = 'no';
		}
		
		if($trailread == 'yes')
		{
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $trail['Trail']['id']; ?>&nbsp;</td>
		<td><?php echo $trail['Trail']['name']; ?>&nbsp;</td>
		<td><?php echo $trail['Trail']['description']; ?>&nbsp;</td>
		<td><?php echo $trail['Trail']['image']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($trail['Station']['name'], array('controller' => 'stations', 'action' => 'view', $trail['Station']['id'])); ?>
		</td>
		<td class="actions">
			<?php 
			if($trailread === 'yes')
				echo $this->Html->link(__('View', true), array('action' => 'view', $trail['Trail']['id'])); 
			/*else
				echo "---";*/
			?>
			<?php 
				if($trailupdate === 'yes')
					echo $this->Html->link(__('Edit', true), array('action' => 'edit', $trail['Trail']['id'])); 
				/*else
					echo "---";*/
				?>
			<?php 
				if($traildelete === 'yes')
					echo $this->Html->link(__('Delete', true), array('action' => 'delete', $trail['Trail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trail['Trail']['id'])); 
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

<div class="actions">
	<ul>
		<li><?php 
		
		if($_SESSION['role'] === 'administrator')
			$trailcreate = 'yes';
		else
			$trailcreate = 'no';
		
		if($trailcreate === 'yes')
			echo $this->Html->link(__('New Trail', true), array('action' => 'add')); 
		/*else
			echo "---";*/
		?></li>
		<!-- <li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li> -->
	</ul>
</div>
