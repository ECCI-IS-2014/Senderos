<!DOCTYPE html>
<html>
<body>

<h5>Registrar una nueva entrada de wishlist.</h5>
<h1></h1>
    <?php
        echo $this->Form->create('ProductWishlist');
		echo $this->Form->input('wishlist_id', array('label'=>'Id de wishlist:', 'type' => 'select', 'options' => $wishlists));
        echo $this->Form->input('product_id', array('label'=>'Id de producto:', 'type' => 'select', 'options' => $products));
        echo $this->Form->end('Guardar');
    ?>
</body>
</html>
