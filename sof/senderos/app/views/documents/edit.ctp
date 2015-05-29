<div class="documents form">
<?php echo $this->Form->create('Document', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Edit Document'); ?></legend>
	<?php
        echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
        $types = array('sound'=>'Sound', 'video'=>'Video', 'text'=>'Text', 'images'=>'Image');
        echo $this->Form->input('type', array('options'=>$types, 'default'=>'Sound'));
        //echo $this->Form->input('archivo', array('type' => 'file','label'=>'Select a file:'));
		echo $this->Form->input('language_id', array('options' => $languages));
		//echo $this->Form->input('targets', array('type' => 'select','multiple'=>'checkbox','options' => array('Student' => 'Students','Professor' => 'Professors','Scientist'=>'Scientists')));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('List Documents', true), array('action' => 'index'));?></li>
	</ul>
</div>