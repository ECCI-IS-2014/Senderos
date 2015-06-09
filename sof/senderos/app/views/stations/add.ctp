
<?php 

if($_SESSION['role'] === 'administrator')
{

?>


<div class="stations form">
<?php echo $this->Form->create('Station');?>
	<fieldset>
		<legend><?php __('Add Station'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('name');
		echo $this->Form->input('location');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Stations', true), array('action' => 'stationindex'));?></li>
	</ul>
</div>

<?php 
}else{?>
    <h2>You are not authorized to access that location</h2>
<?php
}
?>
