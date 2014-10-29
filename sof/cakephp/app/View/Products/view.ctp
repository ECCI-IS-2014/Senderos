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
		#wl{
        	float: right;
        	border: 1px solid #CCC;
        	padding-left: 10px;
            padding-top: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            margin-left: auto;
            margin-right: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div id="container">

    <?php include("header.ctp");?>

    <div id="product">
	
		<div id="wl">
			<?php echo $this->Html->link("Añadir a WishList",array('controller'=>'productwishlist', 'action' =>'add',$product['Product']['id']))."<br>";?>
			<?php echo $this->Form->postLink('Añadir al carrito',array('action' => 'agregarCarrito',$product['Product']['id']));?>
        </div>

        <h3><?php echo "Nombre del videojuego: ". $product['Product']['name']; ?></h3>

        <p><b>Plataforma: </b><?php echo $product['Product']['platform_id']; ?></p>

        <p><b>Año de lanzamiento: </b><?php echo $product['Product']['release_year']; ?></p>

        <p><b>Precio: </b><?php echo $product['Product']['price']; ?></p>

        <p><b>Descripción: </b><?php echo $product['Product']['description']; ?></p>

        <p><b>Formato: </b>
                <?php
                     $p = $product['Product']['description'];
                     if($p != null){
                        if($p == 0)
                            echo 'Físico';
                        if($p == 1)
                            echo 'Digital';
                     }
                ?>
        </p>

        <p><b>Público: </b>
                <?php
                    $r = $product['Product']['rated'];
                    if($r != null){
                        if($r == 0)
                            echo 'early childhood';
                        if($r == 1)
                            echo 'everyone';
                        if($r == 2)
                            echo 'everyone 10+';
                        if($r == 3)
                            echo 'teen';
                        if($r == 4)
                            echo 'mature';
                        if($r == 5)
                            echo 'adults only';
                        if($r == 6)
                            echo 'rating pending';
                        if($r == 7)
                            echo 'kids to adults';
                    }else{
                        echo 'No asignado.';
                    }

                ?>
        </p>

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

<?php
                /*
                EL ARRAY DEL RATED FUNCIONA ASÍ:
                0- early childhood
                1- everyone
                2- everyone 10+
                3- teen
                4- mature
                5- adults only
                6- rating pending
                7- kids to adults
                EL ARRAY DEL FORMATO FUNCIONA ASÍ:
                0- físico
                1- digital
                */
        ?>
