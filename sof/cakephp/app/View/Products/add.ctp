<!DOCTYPE html>
<html>
<body>

    <?php include("header.ctp");?>

    <?php
        if($this->Session->read('Auth.User.username')!=null && $this->Session->read('Auth.User.role')=='admin'){
        echo $this->Form->create('Product', array('type' => 'file'));
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('name', array('label' => 'Nombre del videojuego:'));
        echo $this->Form->input('genre', array('label' => 'Género:'));
        echo $this->Form->input('platform_id', array('type' => 'select', 'options' => $platforms, 'empty' => '(no seleccionada)', 'label' => 'Plataforma:'));
        echo $this->Form->input('release_year', array(
                                'type' => 'date',
                                'dateFormat' => 'Y',
                                'minYear' => 2000,
                                'maxYear' => date('Y'),
                                'name' => 'data[Products][release_year]',
                                'label' => 'Año de lanzamiento:'));
        echo $this->Form->input('price', array('label'=>'Price in dollars'));
        echo $this->Form->input('description', array('rows' => '3', 'label'=>'Descripción del videojuego:'));
        echo $this->Form->input('amount', array('label'=>'Cantidad de producto (unidades):'));
        echo $this->Form->input('presentation', array('type' => 'select', 'options' => array('Físico', 'Digital'), 'label' => 'Formato de entrega:'));
        echo $this->Form->input('requirement', array('rows' => '3', 'label'=>'Requerimientos específicos:'));
        echo $this->Form->input('rated', array('rows' => '1', 'label'=>'Público:'));
        //desplegar lista de categorías -- puede no tener, se pueden seleccionar varias y debe habilitar la opción de crear una nueva
        echo $this->Form->input('catego', array('type' => 'select', 'multiple' => true, 'options' => $categories, 'empty' => '(ninguna)', 'label' => 'Categorías:'));
        echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Seleccione un archivo de imagen:'));
        echo $this->Form->input('video', array('rows' => '1', 'label'=>'Link de un vídeo:'));
        echo $this->Form->end('Guardar');
        /*
            echo $this->Form->input('author_id',
            array(
            'options' => $authors,
            'class' => 'span5',
            'error' => array('attributes' => array('wrap' => 'span', 'class' => 'label custom-inline-error label-important help-inline'))
            ));
         */
        }else{
             echo '<br><br>Unauthorized Access<br><br><b>The Eye in the Skies watches everything</b>';
        }
    ?>

</body>
</html>