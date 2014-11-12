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
    <br><div align="center"><H3>Ítemes a comprar: </H3></div>
    <div id="simple">
        <?php $number=0;
        $total=0;
        $totalConDesc=0;
        foreach ($cart as $key => $product ):
            $cantidad=$this->Session->read('CartQty.'.$number);
            $number++;
        ?>
            <tr>
				 <?php echo $this->Html->image($product['Product']['image'], array('style'=> "width:200px;height:200px;")); ?>
                 <div id="info">
                    <h3><?php echo $product['Product']['name']; ?></h3>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <p><?php echo 'Precio: '.$product['Product']['price'].'$'; ?></p>
                        <?php
                        $subtotal=$cantidad*$product['Product']['price'];
                        $total=$total+$subtotal;
                        echo 'Cantidad: '.$cantidad.'<br>Precio subtotal: '.$subtotal.'$';
                        if($product['Product']['discount']!=0){
                            $subtotal=$subtotal*(100-$product['Product']['discount'])/100;
                            echo '<br>Descuento: '.$product['Product']['discount'].'%<br>Precio con Descuento: '.$subtotal.'$<br>';
                        }
                        $totalConDesc = $totalConDesc+$subtotal;  ?>
                        <br>
                 </div>
            </tr>
        <?php endforeach; ?>
        <?php unset($product); ?>
        <?php
            echo '<p><div align="right"><b>Precio total de la compra: </b>'.$total.'$<br><b>Precio total con descuentos: </b>'.$totalConDesc.'$<br><br>';
            echo $this->Form->create();
            echo $this->Form->input('country', array('title' => 'Pago', 'type' => 'select', 'options' => $debitcards, 'empty' => 'Seleccione su método de pago', 'label' => 'Método de pago: '));
            echo $this->Form->end("COMPRAR");
            echo '</div></p>';
        ?>
    </div>

</div>
</body>
</html>