
<?php
	if($rest==1){
        $add = 0;

        if($_SESSION['role'] === 'restricted'){
        foreach ($restrictions as $restriction):
        if(/* $restriction['Station']['id'] == $trail['Station']['id'] && */ $restriction['Restriction']['allt'] == 1){
        $add = 1;
        }
        endforeach;
        }

if($_SESSION['role'] === 'restricted' || $_SESSION['role'] === 'administrator')
{

?>

<div class="actions">
	<ul>

		<li title = "Index for trails"><?php echo $this->Html->link(__('List Trails', true), array('action' => 'index'));?></li>
		<li title = "Index for stations"><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li title = "Create a new station"><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="trails form">
<?php echo $this->Form->create('Trail', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add Trail'); ?></legend>
	<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
	<h1 title = "You MUST type a name for the new trail"><?php echo $this->Form->input('name');?></h1>
	<h1 title = "You MUST type a description for the new trail"><?php echo $this->Form->input('description');?></h1>
	<h1 title = "Upload the map for the new trail"><?php echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Choose a map image:'));?></h1>
	<h1 title = "You MUST choose a station for the new trail"><?php echo $this->Form->input('station_id');?></h1>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));
      echo "<input type='button' id='hiddencancel' value='Cancel' onclick=\"window.location.href = window.history.back(1);\" style='font-size:small;color:white;background-color:#7BC143;border-radius:3px;border: 0px solid #2D6324;margin-left:3px;padding: 4px 8px;width:auto;display:inline;float:left;'/>";
?>
</div>

<?php 
}
}else{
?>

<h2>You're not authorized to view this page</h2>

<?php
}
?>