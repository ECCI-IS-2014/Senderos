<!DOCTYPE html>
<html>
<?php foreach ($stock as $amount): ?>
<tr>
    <div id="info">
        <h3><?php echo $amount['Stock']['product_id']; ?></h3>
        <h1><?php if($amount['Stock']['amount']!=null){
                    echo 'ID de producto: '.$amount['Stock']['product_id'];
					echo 'Cant de producto: '.$amount['Stock']['amount'];
                  }
             ?>
        </h1>
        <div>&nbsp;</div>
    </div>
</tr>
<?php endforeach; ?>
<?php unset($stock); ?>
</html>
