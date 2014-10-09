<h1>Catalogo</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Género</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($products as $product): ?>
    <tr>
        <td>
            <?php echo $this->Html->link($product['Product']['id'],
            array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
        </td>
        <td><?php echo $product['Product']['name']; ?></td>
        <td><?php echo $product['Product']['genre']; ?></td>
        <td><?php echo $product['Product']['price']; ?></td>
        <td>
        <?php
            echo $this->Form->postLink('Delete',array('action' => 'delete', $product['Product']['id']),array('confirm' => 'Are you sure?'));
        ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($product); ?>
</table>