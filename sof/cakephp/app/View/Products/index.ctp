<!DOCTYPE html>
<html>

<head>
  <title>Catálogo de la tienda</title>
  <style type="text/css">
  body
  {
    font-family: Helvetica, Geneva, Arial,SunSans-Regular, sans-serif;
    color: gray;
    background-color: #FFFFFF
  }
  table
  {
    padding: 10px;
    font-family: Helvetica, Geneva, Arial,SunSans-Regular, sans-serif;
    color: #1C1C1C;
  }

  #nav
  {
    padding: 0;
  }
  #nav li
  {
    display: inline;
  }
  #nav li a
  {
    font-family: Arial;
    font-size:15px;
    text-decoration: none;
    float:left;
    padding: 10px;
    background-color: #04B486;
    color: #fff;
  }
  #nav li a:hover
  {
    background-color: #01DFA5;
    margin-top:-2px;
    padding-bottom:12px;
  }
  form {
      width:200px;
      margin:50px auto;
  }

  </style>
</head>

<body>
    <div id="nav">
        <?php echo $this->Html->image('tiendaweb.png', array('style'=> "width:228px;height:128px"));?>
        <div class="inner">
          <ul>
            <li><a href=”#”>Inicio</a></li>
            <li><a href=”#”>Clientes</a></li>
            <li><a href=”#”>F.A.Q</a></li>
            <li><a href=”#”>Ayuda</a></li>
            <li><a href=”#”>Contáctenos</a></li>
          </ul>
        </div>
    </div>
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
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $product['Product']['id'])
                );
            ?>
        </td>
        <td>
        <?php
            echo $this->Form->postLink('Delete',array('action' => 'delete', $product['Product']['id']),array('confirm' => '¿Está seguro?'));
        ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($product); ?>
    </table>
</body>
</html>