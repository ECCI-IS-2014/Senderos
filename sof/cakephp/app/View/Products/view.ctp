<!DOCTYPE html>
<html>

<head>
    <title>Vista detalles</title>
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

        #product
        {
            float:left;
            width:1000px;
            margin-left: auto;
            margin-right: auto;
            border:solid 1px #dcdcdc;
            padding-top:10px;
            padding-left:10px;
            padding-right:10px;
            padding-bottom:10px;
            font-family: Helvetica, Geneva, sans-serif;
            color: black;
        }
    </style>
</head>

<body>

<div id="container">

    <?php include("header.ctp");?>

    <div id="product">

        <h3><?php echo "Nombre del videojuego: ". $product['Product']['name']; ?></h3>

        <p><b>Género: </b><?php echo $product['Product']['genre']; ?></p>

        <p><b>Consola: </b><?php echo $product['Product']['console']; ?></p>

        <p><b>Año de lanzamiento: </b><?php echo $product['Product']['release_year']; ?></p>

        <p><b>Precio: </b><?php echo $product['Product']['price']; ?></p>

        <p><b>Descripción: </b><?php echo $product['Product']['description']; ?></p>

        <p><b>Unidades disponibles: </b><?php echo $product['Product']['amount']; ?></p>

        <!--
        <p> <?php //$linkImagen = $product['Product']['image']; ?></p>
        <img width="420" height="320" src= "<?php //echo $linkImagen; ?>" />
		-->
		
		<?php echo $this->Html->image($product['Product']['image'], array('style'=> "width:240px;height:128px;padding:10px;"));?>

        <p> <?php $linkVideo = $product['Product']['video']; ?></p>
        <iframe width="420" height="320" src="<?php echo $linkVideo; ?>" frameborder="0" allowfullscreen></iframe>

    </div>

</div>

</body>
</html>