<!DOCTYPE html>
<html>
<body>

    <br><br>
    <h1>Listado de Categorías</h1>
    <table>
        <tr>
            <th>Nombre de la Categoría</th>
		    <th>Acciones</th>
        </tr>
        <?php foreach ($categorylist as $key => $value): ?>
        <tr>
            <td><?php echo $this->Html->link($value, array('controller' => 'Category', 'action' => 'view', $key)); ?></td>
		    <td><?php
		        if($this->Session->read('Auth.User.role')=='admin')
		        {
		            echo $this->Html->link('Editar', array('action' => 'edit', $key));
		            echo '  ';
                    echo $this->Form->postLink('Eliminar', array('action' => 'delete', $key), array('confirm' => 'Seguro?'));
                    echo '  ';
                    echo $this->Html->link('Subir', array('action' => 'moveup', $key));
                    echo '  ';
                    echo $this->Html->link('Bajar', array('action' => 'movedown', $key));
                }
            ?></td>
        </tr>
        <?php endforeach; ?>
        <?php unset($categorylist); ?>
    </table>

</body>
</html>