<!DOCTYPE html>
<html>
<body>

    <?php include("header.ctp");?>

    <h5>Editar producto</h5>

    <?php
    echo $this->Form->create('Product', array('type' => 'file'));
            echo $this->Form->input('id', array('type' => 'hidden'));
            echo $this->Form->input('name', array('label' => 'Nombre del videojuego:'));
            echo $this->Form->input('platform_id', array('type' => 'select', 'options' => $platforms, 'empty' => 'no seleccionada', 'label' => 'Plataforma:'));
            echo $this->Form->input('release_year', array(
            'type' => 'date',
            'dateFormat' => 'Y',
            'minYear' => 2000,
            'maxYear' => date('Y'),
            'name' => 'data[Products][release_year]',
            'label' => 'Año de lanzamiento:',
            'empty' => 'no seleccionado'));
            echo $this->Form->input('price', array('label'=>'Price in dollars', 'default' => '0'));
            echo $this->Form->input('description', array('rows' => '3', 'label'=>'Descripción del videojuego:'));
            //amount es para insertar en stock
            //echo $this->Form->input('amount', array('label'=>'Cantidad de producto (unidades):', 'type' => 'number', 'default' => '0'));
            //echo $this->Form->input('presentation', array('type' => 'select', 'options' => array('Físico', 'Digital'), 'label' => 'Formato de entrega:', 'empty' => 'no seleccionado'));
            echo $this->Form->input('requirement', array('rows' => '3', 'label'=>'Requerimientos específicos:'));
            echo $this->Form->input('rated', array('type' => 'select', 'label'=>'Público:', 'options' => array('Menores de 15', 'Mayores de 15', 'Menores de 18', 'Mayores de 18'), 'empty' => 'no seleccionado'));
            //desplegar lista de categorías -- puede no tener, se pueden seleccionar varias
            //echo $this->Form->input('category', array('type' => 'select', 'multiple' => true, 'options' => $categories, 'empty' => 'ninguna seleccionada', 'label' => 'Categorías:'));
            echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Seleccione un archivo de imagen:'));
            echo $this->Form->input('video', array('rows' => '1', 'label'=>'Link de un vídeo:'));
            echo $this->Form->end('Guardar cambios');
    ?>

</body>
</html>