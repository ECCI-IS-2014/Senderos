<!DOCTYPE html>
<html>
<body>
    <br><br>
    <h1>Lista de Categorías</h1>
    <table>
        <tr>
            <th>Categoría</th>
		    <th>Acciones</th>
        </tr>
        <?php foreach ($data as $categories): ?>
        <tr>
            <td><?php echo $this->Html->link($categories['Category']['name'], array('controller' => 'category', 'action' => 'view', $categories['Category']['id'])); ?></td>
		    <td><?php
		        if($this->Session->read('Auth.User.role')=='admin')
		        {
		            echo $this->Html->link('Editar', array('action' => 'edit', $categories['Category']['id']));
		            echo '  ';
                    echo $this->Form->postLink('Eliminar', array('action' => 'delete', $categories['Category']['id']), array('confirm' => '¿Está seguro?'));
                }
                else
                {

                }
            ?></td>
            <?php foreach ($categories['children'] as $categories): ?>
                    <tr>
                        <td><?php echo $this->Html->link($categories['Category']['name'], array('controller' => 'category', 'action' => 'view', $categories['Category']['id'])); ?></td>
            		    <td><?php
            		        if($this->Session->read('Auth.User.role')=='admin')
            		        {
            		            echo $this->Html->link('Editar', array('action' => 'edit', $categories['Category']['id']));
            		            echo '  ';
                                echo $this->Form->postLink('Eliminar', array('action' => 'delete', $categories['Category']['id']), array('confirm' => '¿Está seguro?'));
                            }
                            else
                            {

                            }
                        ?></td>
                    </tr>
                    <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
        <?php unset($category); ?>
    </table>
</body>
</html>