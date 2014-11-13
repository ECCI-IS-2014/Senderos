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

    <?php include("header.ctp");
		echo $this->Form->create('Check');
        echo '<br><div align="center"><H3>FACTURA #: '.$idCheck.'</H3></div>';
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('debitcard_id', array('title' => 'Pago', 'type' => 'select', 'options' => $debitcards, 'empty' => 'Seleccione su método de pago', 'label' => 'Método de pago: '));
        echo "<br><br>";
        echo $this->Form->input('amount', array('type' => 'hidden', 'default' => $total));
        echo $this->Form->input('general_discount', array('type' => 'hidden', 'default' => 0));
        echo $this->Form->input('sold_the', array('type' => 'hidden', 'default' => 0));
        echo $this->Form->end('Guardar');
	?>
    <div id="simple">
        
    </div>

</div>
</body>
</html>