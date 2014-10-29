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
            width:60%;
            background-color:#fff;
            border:solid 1px #dcdcdc;
            padding:10px;
            margin:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
        }

        #product
        {
            width:40%;
            background-color: #fff;
            border:solid 1px #dcdcdc;
            padding:10px;
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
<div id="container">

    <?php include("header.ctp");?>

    <div id="simple">
        <?php foreach ($results as $product): ?>
            <div id="product">
            <tr>
                 <div id="info">
                    <?php echo $this->Html->image($product['Product']['image'], array('style'=> "height:60%;width:60%;"));?>
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
            </div>
            </tr>
        <?php endforeach; ?>
        <?php unset($product); ?>
    </div>

</div>
</body>
</html>