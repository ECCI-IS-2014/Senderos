<html>
<body>
<div id="formulario" >
<div class="documents form">
    <h3> Add Multimedia File </h3>
<?php echo $this->Form->create('Document',array('type' => 'file'));?>
	<fieldset id="formulario_interno">
	<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
	<?php echo $this->Form->input('name');?>
	<?php echo $this->Form->input('description');?>
	 <?php  $types = array('sound'=>'Sound', 'video'=>'Video', 'text'=>'Text', 'images'=>'Image');
     echo $this->Form->input('type', array('options'=>$types, 'default'=>'Sound')); ?>

    <?php echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Select a file:'));?>
    <?php echo $this->Form->input('language_id', array('options' => $languages));?>
    <?php echo $this->Form->input('targets', array('type' => 'select','multiple' => 'checkbox','options' => array('Student' => 'Students','Professor' => 'Professors','Scientist'=>'Scientists')));
    ?>

	</fieldset>
<div id="submit_button"> <?php echo $this->Form->end(__('Submit', true));?> </div>
</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Documents', true), array('action' => 'index'));?></li>
	</ul>
</div>
</html>