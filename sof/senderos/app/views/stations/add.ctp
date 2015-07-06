<?php

if($_SESSION['role'] === 'administrator')
{

?>

<div class="actions">
	<ul>
		<li title = "Index for stations"><?php echo $this->Html->link(__('List Stations', true), array('action' => 'stationindex'));?></li>
	</ul>
</div>

<div class="stations form">
<?php echo $this->Form->create('Station');?>
	<fieldset>
	<legend><?php __('Add Station'); ?></legend>
    <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
	<h1 title = "You MUST type a name for the new station"><?php echo $this->Form->input('name');?></h1>
	<h1 title = "You MUST type a location for the new station"><?php echo $this->Form->input('location');?></h1>
	<h1 title = "You MUST type a description for the new station"><?php echo $this->Form->input('description');?></h1>
    </fieldset>
<?php echo $this->Form->end(__('Submit', true));
      echo "<input type='button' id='hiddencancel' value='Cancel' onclick=\"window.location.href = window.history.back(1);\" style='font-size:small;color:white;background-color:#7BC143;border-radius:3px;border: 0px solid #2D6324;margin-left:3px;padding: 4px 8px;width:auto;display:inline;float:left;'/>";
?>
</div>

<?php 
}else{?>
    <h2>You are not authorized to access that location</h2>
<?php
}
?>
