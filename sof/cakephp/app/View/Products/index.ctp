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
            width:1000px;
            background-color: #151515;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #cabecera
        {
            margin-left: auto;
            margin-right: auto;
            background-color: #FFFFFF;
        }

        #derecha
        {
            float:right;
            padding:10px;
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

        #nav
        {
            float:left;
            padding:10px;
        }

        #nav li
        {
            display: inline;
        }

        #nav li a
        {
            font-family: Helvetica, Geneva, sans-serif;
            font-size:15px;
            text-decoration: none;
            width:100px;
            float:left;
            padding: 10px;
            background-color: #56BBAC;
            color: #fff;
        }

        #nav li a:hover
        {
            background-color: #4C9E90;
        }
    </style>
</head>

<body>
<div id="contenedor">

    <div id="cabecera">
        <div id="imagen">
            <?php echo $this->Html->image('tiendaweb.png', array('style'=> "width:228px;height:128px"));?>
        </div>
    </div>

    <div id="nav">
        <ul>
            <li><a>Inicio</a></li>
            <li><a>Clientes</a></li>
            <li><a>F.A.Q</a></li>
            <li><a>Ayuda</a></li>
            <li><a>Contáctenos</a></li>
        </ul>
    </div>

    <div id="derecha">
        <p>Texto derecha</p>
    </div>

    <div id="simple">
        <?php foreach ($products as $product): ?>
            <tr>
                 <img width="200" height="200" src= "<?php echo $linkImagen = $product['Product']['image'] ?>" />
                 <div id="info">
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <p><?php echo $product['Product']['genre']; ?></p>
                    <p><?php echo $product['Product']['price']; ?></p>
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