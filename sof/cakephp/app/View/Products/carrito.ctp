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
            width:60%;
            background-color:#fff;
            border:solid 1px #dcdcdc;
            padding:10px;
            margin:10px;
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
    <?php echo '<br>'.$this->Html->link("Vaciar carrito",array('controller'=>'products','action'=>'vaciar')).'<br>' ;?>
    <div id="simple">
        <?php $number=0;
        foreach ($cart as $key => $product ):
            $cantidad=$this->Session->read('CartQty.'.$number);
            $number++;
        ?>
            <tr>
				 <?php echo $this->Html->image($product['Product']['image'], array('style'=> "width:200px;height:200px;")); ?>
                 <div id="info">
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <p><?php echo $product['Product']['genre']; ?></p>
                    <p><?php echo '$'.$product['Product']['price']; ?></p>
                    <div>&nbsp;</div>
                    <td id="small">
                        <?php echo $this->Html->link("Detalles",array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                    </td>
                    <td>
                         <?php
                             //remove product from a cart
                             echo $this->Html->link('Eliminar del carrito', array('action' => 'eliminarCarrito',$key));
                         ?>
                    </td>
                    <div>&nbsp;</div>
                        <?php
                        echo 'Cantidad: '.$cantidad.'<br>Precio total: '.$cantidad*$product['Product']['price'].'$'; ?>
                 </div>
            </tr>
        <?php endforeach; ?>
        <?php unset($product); ?>
    </div>

</div>
</body>
</html>