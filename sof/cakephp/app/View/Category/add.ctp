<!DOCTYPE html>
<html>
<body>

<h5>Registrar una nueva categoría</h5>
<h1></h1>
    <?php
        echo $this->Form->create('Category');
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('name', array('label' => 'Nombre de la categoría:'));
        echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $categories, 'empty' => '(Sin categoría padre)', 'label' => 'Subcategoría de:'));
        echo $this->Form->end('Guardar');
    ?>
</body>
</html>