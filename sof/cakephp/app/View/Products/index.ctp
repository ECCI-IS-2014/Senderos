<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de la tienda</title>
    <style>

        body
        {
            background: #151515;
        }

        #contenedor
        {
            margin-left: auto;
            margin-right: auto;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #simple
        {
            float:left;
            width:700px;
            background-color:#fff;
            border:solid 1px #dcdcdc;
            padding-top:10px;
            padding-left:10px;
            padding-right:10px;
            padding-bottom:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
        }

        #info
        {
            float: right;
            display: inline;
            width:420px;
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
<div id="contenedor">

    <?php include("header.ctp");?>

    <?php
        if($this->Session->read('Auth.User.username')!=null && $this->Session->read('Auth.User.role')=='admin'){
            echo $this->Html->link('Añadir producto al catálogo',array('action' => 'add'));
        }
    ?>
    <br><br>

    <div id="simple">
        <?php foreach ($products as $product): ?>
            <tr>
                 <!-- <img width="200" height="200" src= "<?php //echo $linkImagen = $product['Product']['image'] ?>" /> -->
				 <?php echo $this->Html->image($product['Product']['image'], array('style'=> "width:200px;height:200px;"));?>
                 <div id="info">
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <p><?php echo $product['Product']['genre']; ?></p>
                    <p><?php echo '$'.$product['Product']['price']; ?></p>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                    </td>
                    <td id="small">Añadir al carrito</td>
                    <?php
                    if($this->Session->read('Auth.User.username')!=null && $this->Session->read('Auth.User.role')=='admin'){
          		        echo '<td id="small">';
                        echo $this->Html->link('Editar',array('action' => 'edit', $product['Product']['id']));
                        echo ' </td>';
                        echo '<td id="small">';
                        echo $this->Form->postLink('Eliminar',array('action' => 'delete', $product['Product']['id']),array('confirm' => '¿Está seguro?'));
                        echo '</td>';
                    }
                    ?>
                    <div>&nbsp;</div>
                 </div>
            </tr>
        <?php endforeach; ?>
        <?php unset($product); ?>
    </div>

</div>
</body>
</html>