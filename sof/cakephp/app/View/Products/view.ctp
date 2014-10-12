<h1><?php echo "Nombre del videojuego: ". $product['Product']['name']; ?></h1>

<p><?php echo "Género: ". $product['Product']['genre']; ?></p>

<p><?php echo "Consola: ". $product['Product']['console']; ?></p>

<p><?php echo "Año de lanzamiento: ". $product['Product']['release_year']; ?></p>

<p><?php echo "Precio: $". $product['Product']['price']; ?></p>

<p><?php echo "Descripción: ". $product['Product']['description']; ?></p>

<p><?php echo "Unidades disponibles: ". $product['Product']['amount']; ?></p>

<p> <?php echo "Imagen:";
		  $linkImagen = $product['Product']['image']; 
	?>
</p>
<img width="420" height="320" src= "<?php echo $linkImagen; ?>" />

<p> <?php echo "Video:";
		  $linkVideo = $product['Product']['video'];
	?>
</p>
<iframe width="420" height="320" src="<?php echo $linkVideo; ?>" frameborder="0" allowfullscreen></iframe>
