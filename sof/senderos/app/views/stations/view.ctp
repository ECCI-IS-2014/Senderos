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

<?php 

$result = '';

$stationcreate = 'no';
$stationread = 'yes';
$stationupdate = 'no';
$stationdelete = 'no';

if($_SESSION['role'] === 'restricted')
{
	foreach ($restrictions as $restriction):
        if($restriction['Restriction']['station_id'] == $station['Station']['id'] && $restriction['Restriction']['allt'] == 1)
        {
            $stationcreate = 'no';
            $stationread = 'yes';
            $stationupdate = 'yes';
            $stationdelete = 'yes';

            $result .= "<br>Found a restriction on ".$station['Station']['id'].": C=".$stationcreate.", R=".$stationread.", U=".$stationupdate.", D=".$stationdelete."";
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
	$stationread = 'yes';
	$stationupdate = 'no';
	$stationdelete = 'no';
}

if($stationread == 'yes')
{

?>

<div class="actions">
	<ul>
		<li title = "Edit the information for this station"><?php
		if($stationupdate === 'yes')
			echo $this->Html->link(__('Edit Station', true), array('action' => 'edit', $station['Station']['id']));
		/*else
			echo "---";*/
		?> </li>
		<li title = "Delete this station"><?php
		if($stationdelete === 'yes')
			echo $this->Html->link(__('Delete Station', true), array('action' => 'delete', $station['Station']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $station['Station']['id']));
		/*else
			echo "---";*/
		?> </li>
		<li title = "Index for stations"><?php echo $this->Html->link(__('List Stations', true), array('action' => 'stationindex')); ?> </li>
		<li title = "Create a new station"><?php
		if($stationcreate === 'yes')
			echo $this->Html->link(__('New Station', true), array('action' => 'add'));
		/*else
			echo "---";*/
		?> </li>
	</ul>
</div>

<div class="stations view">
<h2><?php  __($str_stations);?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __($str_name); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $station['Station']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __($str_location); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $station['Station']['location']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __($str_description); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $station['Station']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>





<?php 

}

?>



<div >

	<?php
	
	//echo $result;
	
	?>

</div>




