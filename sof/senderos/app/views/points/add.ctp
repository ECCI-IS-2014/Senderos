<?php /*?>

<div class="points form">
<?php echo $this->Form->create('Point');?>
	<fieldset>
		<legend><?php __('Add Point'); ?></legend>
        <h1 title = "You MUST type a name for this new point"><?php echo $this->Form->input('name');?></h1>
        <h1 title = "You MUST type a number for this new point"><?php echo $this->Form->input('pnumber', array('label'=>'Number'));?></h1>
		<h1 title = "You MUST type a horizontal coordinate for this new point"><?php echo $this->Form->input('cordx', array('label'=>'Geographic coordinate X'));?></h1>
		<h1 title = "You MUST type a vertical coordinate for this new point"><?php echo $this->Form->input('cordy', array('label'=>'Geographic coordinate Y:'));?></h1>
        <h1 title = "You MUST type a horizontal coordiante in the screen for this new point"><?php echo $this->Form->input('px_x', array('label'=>'Pixel X in the image'));?></h1>
        <h1 title = "You MUST type a vertical coordinate in the screen for this new point"><?php echo $this->Form->input('px_y', array('label'=>'Pixel Y in the image'));?></h1>
		<h1 title = "You MUST type a description for this new point"><?php echo $this->Form->input('description', array('label'=>'Description'));?></h1>
		<h1 title = "You MUST choose a trail to be associated to this new point"><?php echo $this->Form->input('trail_id');?></h1>

	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li title = "Index for points"><?php echo $this->Html->link(__('List Points', true), array('action' => 'index'));?></li>
		<li title = "Index for trails"><?php echo $this->Html->link(__('List Trails', true), array('controller' => 'trails', 'action' => 'index')); ?> </li>
		<li title = "Create a new trail"><?php echo $this->Html->link(__('New Trail', true), array('controller' => 'trails', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */?>