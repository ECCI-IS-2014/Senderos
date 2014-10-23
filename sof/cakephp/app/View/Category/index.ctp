<!DOCTYPE html>
<html>
<?php foreach ($categories as $category): ?>
<tr>
    <div id="info">
        <h3><?php echo $category['Category']['name']; ?></h3>
        <h1><?php if($category['Category']['parent_id']!=null){
                    echo 'Super categoría: '.$category['Category']['parent_id'];
                    // lo que necesito traerme es la consulta del nombre a la tabla padre
                  }
             ?>
        </h1>
        <div>&nbsp;</div>
    </div>
</tr>
<?php endforeach; ?>
<?php unset($categories); ?>
</html>
