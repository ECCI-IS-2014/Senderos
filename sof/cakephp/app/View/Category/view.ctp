<h2><?php echo "Información de la Categoría" ?></h2>
<h1><?php echo "Nombre: ".h($category['Category']['name'])." "; ?></h1>
<h1><?php
if($category['Category']['parent_id'] != '')
{
    echo "Categoría Padre: ".h($category['Category']['parent_id'])." ";
}
?></h1>
<h1><?php echo "Subcategorías: " ?></h1>
<?php foreach ($child as $children): ?>
<td><?php echo $children; ?></td>
<br>
<?php endforeach; ?>
<?php unset($child); ?>