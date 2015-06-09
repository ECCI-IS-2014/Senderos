<?php /*?>

<div class="points form">
<?php echo $this->Form->create('Point');?>
	<fieldset>
		<legend><?php __('Edit Point'); ?></legend>
	<?php
            echo $this->Form->input('name');
            echo $this->Form->input('pnumber', array('label'=>'Number'));
            echo $this->Form->input('cordx', array('label'=>'Geographic coordinate X'));
            echo $this->Form->input('cordy', array('label'=>'Geographic coordinate Y:'));
            echo $this->Form->input('px_x', array('label'=>'Pixel X in the image'));
            echo $this->Form->input('px_y', array('label'=>'Pixel Y in the image'));
            echo $this->Form->input('description', array('label'=>'Description'));
            echo $this->Form->input('trail_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Point.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Point.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Points', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Trails', true), array('controller' => 'trails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trail', true), array('controller' => 'trails', 'action' => 'add')); ?> </li>
	</ul>
</div>
        <?php */?>