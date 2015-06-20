<?php /* ?>
<div class="documents form">
<?php echo $this->Form->create('Document', array('type' => 'file'));?>
	<fieldset>
	   	<legend><?php __('Edit Document'); ?></legend>
        <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
		<h1 title= "You MAY change the name for this file"><?php echo $this->Form->input('name');?></h1>
		<h1 title= "You MAY change the description for this file"><?php echo $this->Form->input('description');?></h1>
        <h1 title= "You MAY change the type for this file"><?php $types = array('sound'=>'Sound', 'video'=>'Video', 'text'=>'Text', 'images'=>'Image');
        echo $this->Form->input('type', array('options'=>$types, 'default'=>'Sound'));?></h1>
        <h1 title= "You MAY change the language associated to this file"><?php echo $this->Form->input('language_id', array('options' => $languages));?></h1>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<ul>
        <li title = "Index for Files"><?php echo $this->Html->link(__('List Documents', true), array('action' => 'index'));?></li>
	</ul>
</div>
<?php */ ?>