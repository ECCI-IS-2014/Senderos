<?php /*?>

<div class="points form">
<?php echo $this->Form->create('Point');?>
	<fieldset>
		<legend><?php __('Edit Point'); ?></legend>
           <h1 title = "You MAY change the name for this point"><?php echo $this->Form->input('name');?></h1>
           <h1 title = "You MAY change the number to show for this point"><?php echo $this->Form->input('pnumber', array('label'=>'Number'));?></h1>
           <h1 title = "You MAY change this coordinate for this point"><?php echo $this->Form->input('cordx', array('label'=>'Geographic coordinate X'));?></h1>
           <h1 title = "You MAY change this coordinate for this point"><?php echo $this->Form->input('cordy', array('label'=>'Geographic coordinate Y:'));?></h1>
           <h1 title = "You MAY change this coordinate for this point"><?php echo $this->Form->input('px_x', array('label'=>'Pixel X in the image'));?></h1>
           <h1 title = "You MAY change this coordinate for this point"><?php echo $this->Form->input('px_y', array('label'=>'Pixel Y in the image'));?></h1>
           <h1 title = "You MAY change the description for this point"><?php echo $this->Form->input('description', array('label'=>'Description'));?></h1>
           <h1 title = "You MAY change the trail that is associated to this point"><?php echo $this->Form->input('trail_id');?></h1>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li title = "Delete this point"><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Point.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Point.id'))); ?></li>
		<li title = "Index for points"><?php echo $this->Html->link(__('List Points', true), array('action' => 'index'));?></li>
		<li title = "Index for trails"><?php echo $this->Html->link(__('List Trails', true), array('controller' => 'trails', 'action' => 'index')); ?> </li>
		<li title = "Create a new trail"><?php echo $this->Html->link(__('New Trail', true), array('controller' => 'trails', 'action' => 'add')); ?> </li>
	</ul>
</div>
        <?php */?>