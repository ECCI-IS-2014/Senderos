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
            width:70%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #product
        {
            width:100%;
            height:100%;
            margin:10px;
            margin-left:10px;
            background-color: #fff;
            border:solid 0px #dcdcdc;
            padding:10px;
        }

        #simple
        {
            float:left;
            width:250px;
            height:350px;
            background-color:#fff;
            border:solid 1px #dcdcdc;
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

<div id="contenedor">
    <div id="product">
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
                        <?php echo $this->Html->link('Editar',array('action' => 'edit', $product['Product']['id']));?>
                    </td>
                    <td id="small">
                        <?php echo $this->Form->postLink('Eliminar',array('action' => 'delete', $product['Product']['id']),array('confirm' => '¿Está seguro?'));?>
                    </td>
                    <div>&nbsp;</div>
                 </div>
            </tr>
            </div>
        <?php endforeach; ?>
        <?php unset($product); ?>
    </div>
</div>

</body>
</html>