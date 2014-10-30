<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de la tienda</title>
    <style>

        #container
        {
            width:100%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #product
        {
            width:70%;
            display:inline;
            float: left;
            margin:5px;
            background-color: #fff;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #categories
        {
            width:25%;
            display:inline;
            float: right;
            margin:5px;
            background-color: #fff;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #simple
        {
            float:left;
            width:250px;
            height:350px;
            background-color:#fff;
            border:solid 0px #dcdcdc;
            padding:10px;
            margin:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
        }

        #info
        {
            width:100%;
            text-align: center;

        }

        #info h3
        {
            font-family: Helvetica, Geneva;
            color: #56BBAC;
        }

        #info p
        {
            padding-bottom:10px
        }

    </style>
</head>

<body>

<?php include("header.ctp");?>

<div id="container">

    <div id="product">
		<h3><?php echo "¿Quiénes somos?"."<br><br>";?></h3>
        <object width="300" height="42">
            <param name="src" value="http://localhost/cakephp/app/webroot/files/audio.mp3">
            <param name="autoplay" value="false">
            <param name="controller" value="true">
            <param name="bgcolor" value="#FFFFFF">
            <embed src="http://localhost/cakephp/app/webroot/files/audio.mp3" autostart="false" loop="false" width="300" height="42" controller="true" bgcolor="#FFFFFF">
        </object>
        <h3><?php echo "<br><br>";?></h3>
		
        <h3><?php echo "Catálogo de nuestra tienda";?></h3>
        <?php foreach ($products as $product): ?>
        <div id="simple">
            <tr>
                 <div id="info">
                    <?php echo $this->Html->image($product['Product']['image'], array('title' => $product['Product']['name'],'style'=> "height:60%;width:60%;"));?>
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <p><?php echo 'Precio: $'.$product['Product']['price']; ?></p>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                    </td>
                    <td id="small">
                        <?php echo $this->Form->postLink('Añadir al carrito',array('action' => 'agregarCarrito',$product['Product']['id']));?>
                    </td>
          		    <td id="small">
                        <?php
                            if($role == 'admin'){
                                echo $this->Html->link('Editar',array('action' => 'edit', $product['Product']['id']));
                            }
                        ?>
                    </td>
                    <td id="small">
                        <?php
                            if($role == 'admin'){
                                echo $this->Form->postLink('Eliminar',array('action' => 'delete', $product['Product']['id']),array('confirm' => '¿Está seguro?'));
                            }
                         ?>
                    </td>
                    <div>&nbsp;</div>
                 </div>
            </tr>
        </div>
        <?php endforeach; ?>
        <?php unset($product); ?>
    </div>

    <div id="categories">
        <?php
                echo $this->Html->link(
                'Agregar plataforma',
                array(
                'controller' => 'platform',
                'action' => 'add',
                'full_base' => true
                )
                )."<br>";
                echo $this->Html->link(
                'Agregar categoría',
                array(
                'controller' => 'category',
                'action' => 'add',
                'full_base' => true
                )
                )."<br>";
                echo $this->Html->link(
                'Asociar producto con categoría',
                array(
                'controller' => 'categoryproduct',
                'action' => 'add',
                'full_base' => true
                )
                )."<br><br>";
                echo $this->Html->link(
                'Ver plataformas',
                array(
                'controller' => 'platform',
                'action' => 'index',
                'full_base' => true
                )
                )."<br>";
                echo $this->Html->link(
                'Ver categorías',
                array(
                'controller' => 'category',
                'action' => 'index',
                'full_base' => true
                )
                );
        ?>
    </div>

</div>

</body>
</html>