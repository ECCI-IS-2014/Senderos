<!DOCTYPE html>
<html>
<?php foreach ($categories as $category): ?>
<tr>
    <div id="info">
        <h1><?php echo $category;?></h1>
    </div>
</tr>
<?php endforeach; ?>
<?php unset($categories); ?>
</html>