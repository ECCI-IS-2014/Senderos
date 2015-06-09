
<?php
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

<div class="trails form">
<?php echo $this->Form->create('Trail', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Add Trail'); ?></legend>
	<?php
	echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Choose a map image:'));
		echo $this->Form->input('station_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Trails', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li>
	</ul>
</div>

<?php 
}
?>
