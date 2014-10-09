<h1>Edit Game</h1>
<?php
    echo $this->Form->create('Product');
    echo $this->Form->input('name');
    echo $this->Form->input('genre');
    echo $this->Form->input('console');
    echo $this->Form->input('release_year');
    echo $this->Form->input('price');
    echo $this->Form->input('description', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');
?>