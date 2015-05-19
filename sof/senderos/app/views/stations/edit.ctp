
<?php 

$result = '';

$stationcreate = 'no';
$stationread = 'yes';
$stationupdate = 'no';
$stationdelete = 'no';

if($_SESSION['role'] === 'restricted')
{
	foreach ($restrictions as $restriction):
		if($restriction['Restriction']['model'] == 'stations' && $restriction['Restriction']['recordid'] == $station['Station']['id'])
		{
			if($restriction['Restriction']['creating'] === '1')
				$stationcreate = 'yes';
			if($restriction['Restriction']['reading'] === '0')
				$stationread = 'no';
			if($restriction['Restriction']['updating'] === '1')
				$stationupdate = 'yes';
			if($restriction['Restriction']['deleting'] === '1')
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


<div class="stations form">
<?php echo $this->Form->create('Station');?>
	<fieldset>
		<legend><?php __('Edit Station'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('location');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php 

if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
	echo $this->Form->end(__('Submit', true));

?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php 
		if($stationdelete === 'yes')
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Station.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Station.id'))); 
		/*else 
			echo "---";*/
		?></li>
		<li><?php echo $this->Html->link(__('List Stations', true), array('action' => 'index'));?></li>
	</ul>
</div>

<?php 

}

?>



<div >

	<?php
	
	echo $result;
	
	?>

</div>
