<!DOCTYPE html>
<html>

<head>
    <title>Busqueda</title>
    <style>

        body
        {
            background: #151515;
        }

        #container
        {
            margin-left: auto;
            margin-right: auto;
            background-color: #FFFFFF;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #searchbar
        {
            float:left;
            width:700px;
            background-color: #FFFFFF;
        }

        #simple
        {
            float:left;
            width:700px;
            margin-left: auto;
            margin-right: auto;
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
<div id="container">

    <?php include("header.ctp");?>

    <div id="searchbar">
        <?php  echo $this->Form->create("Products",array('action' => 'search')); ?>
        <?php  echo $this->Form->input("q", array('label' => 'Búsqueda')); ?>
        <?php  echo $this->Form->end("Buscar"); ?>
    </div>

    <br><br><br>
    <?php echo $this->Html->link('Añadir producto al catálogo',array('action' => 'add'));?>

    <div id="simple">
        <?php foreach ($results as $product): ?>
            <tr>
                 <img width="200" height="200" src= "<?php echo $linkImagen = $product['Product']['image'] ?>" />
                 <div id="info">
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <p><?php echo $product['Product']['genre']; ?></p>
                    <p><?php echo '$'.$product['Product']['price']; ?></p>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                    </td>
                    <td id="small">Añadir al carrito</td>
          		    <td id="small">
                        <?php echo $this->Html->link('Editar',array('action' => 'edit', $product['Product']['id']));?>
                    </td>
                    <td id="small">
                        <?php echo $this->Form->postLink('Eliminar',array('action' => 'delete', $product['Product']['id']),array('confirm' => '¿Está seguro?'));?>
                    </td>
                    <div>&nbsp;</div>
                 </div>
            </tr>
        <?php endforeach; ?>
        <?php unset($product); ?>
    </div>

</div>
</body>
</html>