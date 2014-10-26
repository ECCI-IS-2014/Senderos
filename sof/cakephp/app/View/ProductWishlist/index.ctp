<!DOCTYPE html>
<html>
<?php foreach ($ProductWishlistList as $pw): ?>
<tr>
    <div id="info">
        <h3><?php echo 'Id de la wishlist: '.$pw['ProductWishlist']['wishlist_id']; ?></h3>
		<h3><?php echo 'Id de producto: '.$pw['ProductWishlist']['product_id']; ?></h3>
        <div>&nbsp;</div>
    </div>
</tr>
<?php endforeach; ?>
<?php unset($ProductWishlistList); ?>
</html>
