<?php /* ?>
<html>
<body>
<div id="formulario" >
<div class="documents form">
    <h3> Add Multimedia File </h3>
<?php echo $this->Form->create('Document',array('type' => 'file'));?>
	<fieldset id="formulario_interno">
    <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
	<h1 title= "You MUST type a name for the new file"><?php echo $this->Form->input('name');?></h1>
	<h1 title= "You MUST type a description for the new file"><?php echo $this->Form->input('description');?></h1>
	<h1 title= "You MUST choose a type for the new file"><?php  $types = array('sound'=>'Sound', 'video'=>'Video', 'text'=>'Text', 'images'=>'Image');
    echo $this->Form->input('type', array('options'=>$types, 'default'=>'Sound')); ?></h1>

    <h1 title= "Upload the new file"> <?php echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Select a file:'));?></h1>
    <h1 title= "You MUST choose a language for the new file"><?php echo $this->Form->input('language_id', array('options' => $languages));?></h1>
    <?php //echo $this->Form->input('targets', array('type' => 'select','multiple' => 'checkbox','options' => array('Student' => 'Students','Professor' => 'Professors','Scientist'=>'Scientists', 'Natural' => 'Naturals')));
    ?>

	</fieldset>
<div id="submit_button"> <?php echo $this->Form->end(__('Submit', true));?> </div>
</div>
</div>
<div class="actions">
	<ul>
		<li title = "Index for Files"><?php echo $this->Html->link(__('List Documents', true), array('action' => 'index'));?></li>
	</ul>
</div>
</html>
<?php */ ?>