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

  #simple
  {
    float:left;
    width:700px;
    background:#fff;
    border:solid 1px #dcdcdc;
    padding-top:10px;
    padding-left:10px;
    padding-bottom:10px;
  }

  #nav
  {
    padding:40px;
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

    <div id="simple">
       <?php foreach ($products as $product): ?>
          <tr>
             <img width="200" height="200" src= "<?php echo $linkImagen = $product['Product']['image'] ?>" />
             <td>
                <?php echo $this->Html->link($product['Product']['name'],array('controller' => 'products', 'action' => 'view', $product['Product']['id'])); ?>
                  </td>
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
                  <div class="cl">&nbsp;</div>
                     <a href="#" class="small">Detalles</a> <a href="#" class="small">Añadir al carrito</a>
                  <div class="cl">&nbsp;</div>
          </tr>
       <?php endforeach; ?>
       <?php unset($product); ?>
    </div>
</body>
</html>