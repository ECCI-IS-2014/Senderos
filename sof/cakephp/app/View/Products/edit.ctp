<!DOCTYPE html>
<html>
<body>

    <?php include("header.ctp");?>

    <h5>Editar producto</h5>

    <?php
		echo $this->Form->create('Product', array('type' => 'file'));
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo "<br><br>".$this->Form->input('name', array('label' => 'Nombre del videojuego:'))."<br><br>";
        echo $this->Form->input('platform_id', array('type' => 'select', 'options' => $platforms, 'empty' => 'no seleccionada', 'label' => 'Plataforma:'))."<br><br>";
        echo $this->Form->input('Product.release_year', array(
            'type' => 'date',
            'dateFormat' => 'Y',
            'minYear' => date('Y') - 15,
            'maxYear' => date('Y'),
            'label' => 'Año de lanzamiento:',
            'empty' => 'no seleccionado',
			'name'=>"data[Product][release_year]"
        ))."<br><br>";
        echo $this->Form->input('price', array('label'=>'Price in dollars', 'default' => '0'))."<br><br>";
        echo $this->Form->input('description', array('rows' => '3', 'label'=>'Descripción del videojuego:'))."<br><br>";
        //amount es para insertar en stock
        echo $this->Form->input('amount', array('label'=>'Cantidad de producto (unidades):', 'type' => 'number', 'default' => '0'))."<br><br>";
        echo $this->Form->input('presentation', array('type' => 'select', 'options' => array('Físico', 'Digital'), 'label' => 'Formato de entrega:', 'empty' => 'no seleccionado'))."<br><br>";
        echo $this->Form->input('requirement', array('rows' => '3', 'label'=>'Requerimientos específicos:'))."<br><br>";
        echo $this->Form->input('rated', array('type' => 'select', 'label'=>'Público:', 'options' => array('early childhood', 'everyone', 'everyone 10+','teen','mature','adults only','rating pending','kids to adults'), 'empty' => 'no seleccionado'))."<br><br>";
        //desplegar lista de categorías -- puede no tener, se pueden seleccionar varias
        //echo $this->Form->input('category', array('type' => 'select', 'multiple' => true, 'options' => $categories, 'empty' => 'ninguna seleccionada', 'label' => 'Categorías:'));
        echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Seleccione un archivo de imagen:'))."<br><br>";
        echo $this->Form->input('video', array('rows' => '1', 'label'=>'Link de un vídeo:'))."<br><br>";
        echo $this->Form->end('Guardar cambios');
    ?>

</body>
</html>