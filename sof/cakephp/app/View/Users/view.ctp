<!DOCTYPE html>
<html>

<head>
    <style>

        #container
        {
            width:100%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        .usersform
        {
            width:50%;
            margin:0 auto;
            margin-top:2%;
            background-color: #fff;
            color: black;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #registro input
        {
            float:right;
        }
    </style>
</head>

<body>

<?php if($this->Session->read("Auth.User.role") == 'admin')
      {
        include("headeradmin.ctp");
      }
      else
      {
        include("header.ctp");
      }
?>

<div id="container">
    <div class="usersform">
        <h2><?php echo "Información del usuario" ?></h2>
        <h3><?php echo "Nombre de usuario: ".h($users['User']['username'])." "; ?></h3>
        <h3><?php echo "Nombre: ".h($users['User']['name'])." ".h($users['User']['lastname'])." "; ?></h3>
        <h3><?php echo "Correo electrónico: ".h($users['User']['email'])." "; ?></h3>
        <h3><?php echo "País: ".$country." "; ?></h3>
        <h3><?php if($this->Session->read('Auth.User.role')== 'admin')
        {
            echo "Rol: ".h($users['User']['role'])." ";
        } ?></h3>
		<h3><?php echo $this->Form->input('debcard', array('title' => 'Pago', 'type' => 'select', 'options' => $debitcards, 'empty' => 'ID por el momento', 'label' => 'Tarjetas registradas')); ?></h3>
        <br><br>
        <h3><?php echo $this->Html->link('Editar mi perfil',array('controller' =>'users','action'=>'edit',$this->Session->read('Auth.User.id'))); ?>
    </div>
</div>

</body>
</html>