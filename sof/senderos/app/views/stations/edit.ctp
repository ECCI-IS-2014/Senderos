<?php
if($edit_stat==1){

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
		<li title = "Delete this station"><?php
		if($stationdelete === 'yes')
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Station.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Station.id')));
		?></li>
		<li title = "Index for stations"><?php echo $this->Html->link(__('List Stations', true), array('action' => 'stationindex'));?></li>
	</ul>
</div>

<div class="stations form">
<?php echo $this->Form->create('Station');?>
	<fieldset>
		<legend><?php __('Edit Station'); ?></legend>
    <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
	<h1 title = "You MAY change the name for this station"><?php echo $this->Form->input('name');?></h1>
	<h1 title = "You MAY change the location for this station"><?php echo $this->Form->input('location');?></h1>
	<h1 title = "You MAY change the description for this station"><?php echo $this->Form->input('description');?></h1>
	</fieldset>
<?php 

if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
	echo $this->Form->end(__('Submit', true));
    echo "<input type='button' id='hiddencancel' value='Cancel' onclick=\"window.location.href = window.history.back(1);\" style='color:white;background-color:#7BC143;font-size:small;margin-left:3px;border-radius:3px;border: 0px solid #2D6324;padding: 4px 8px;width:auto;display:inline;float:left;'/>";
?>

</div>

<?php
}
}
?>