<h5>Add a new product</h5>
<?php
/*$this->Form->create() generates:
<form id="PostAddForm" method="post" action="/posts/add">
If create() is called with no parameters supplied, it assumes 
you are building a form that submits via POST to the current controller’s add() 
action (or edit() action when id is included in the form data).*/
echo $this->Form->create('Product');
/*The $this->Form->input() method is used to create form elements of the same name. 
The first parameter tells CakePHP which field they correspond to, and the second parameter 
allows you to specify a wide array of options - in this case, the number of rows for the textarea. 
There’s a bit of introspection and automagic here: input() will output different form elements based on the model field specified.*/
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('name');
echo $this->Form->input('genre');
echo $this->Form->input('console');
echo $this->Form->input('release_year', array(
						 'type' => 'date', 
						 'dateFormat' => 'Y', 
						 'minYear' => 2000, 
						 'maxYear' => date('Y'), 
						 'name' => 'data[Products][release_year]', )); 
echo $this->Form->input('price', array('label'=>'Price in dollars'));
echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->input('image', array('rows' => '1', 'label'=>'Image link'));
echo $this->Form->input('video', array('rows' => '1', 'label'=>'Video link'));
/*The $this->Form->end() call generates a submit button and ends the form. If a string is supplied as the first parameter to end(), the 
FormHelper outputs a submit button named accordingly along with the closing form tag. Again, refer to Helpers for more on helpers.*/
echo $this->Form->end('Save Post');
?>