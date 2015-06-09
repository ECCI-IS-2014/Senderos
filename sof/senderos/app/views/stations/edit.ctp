
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
	<ul>
		<li><?php 
		if($stationdelete === 'yes')
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Station.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Station.id'))); 
		/*else 
			echo "---";*/
		?></li>
		<li><?php echo $this->Html->link(__('List Stations', true), array('action' => 'stationindex'));?></li>
	</ul>
</div>

<?php 

}

?>



<div >

	<?php
	
	//echo $result;
	
	?>

</div>
