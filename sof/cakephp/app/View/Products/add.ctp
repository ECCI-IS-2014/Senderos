<!DOCTYPE html>
<html>
<body>

    <?php include("header.ctp");?>

    <?php
        if($this->Session->read('Auth.User.username')!=null && $this->Session->read('Auth.User.role')=='admin'){
        echo '<h5>Añadir nuevo producto</h5>';
        echo $this->Form->create('Product', array('type' => 'file'));
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
        echo $this->Form->input('amount', array('label'=>'Amount of product (units):'));
        //echo $this->Form->input('image', array('rows' => '1', 'label'=>'Image link'));
		echo $this->Form->input('archivo', array('type' => 'file'));
        echo $this->Form->input('video', array('rows' => '1', 'label'=>'Video link'));
        echo $this->Form->end('Guardar');
        }else{
             echo '<br><br>Unauthorized Access<br><br><b>The Eye in the Skies watches everything</b>';
        }
    ?>

</body>
</html>