<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Visitors', true), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="visitors form">
<?php echo $this->Form->create('Visitor');?>
	<fieldset>
		<legend><?php __('Add visitor'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('role');
        echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));
      echo "<input type='button' id='hiddencancel' value='Cancel' onclick=\"window.location.href = window.history.back(1);\" style='font-size:small;color:white;background-color:#7BC143;border-radius:3px;border: 0px solid #2D6324;margin-left:3px;padding: 4px 8px;width:auto;display:inline;float:left;'/>";
?>
</div>