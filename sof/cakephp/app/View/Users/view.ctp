<?php include("header.ctp");?>

<h2><?php echo "Información del usuario" ?></h2>
<h1><?php echo "Nombre de usuario: ".h($users['User']['username'])." "; ?></h1>
<h1><?php echo "Nombre: ".h($users['User']['name'])." ".h($users['User']['lastname'])." "; ?></h1>
<h1><?php echo "País: ".h($users['User']['email'])." "; ?></h1>
<h1><?php echo "País: ".h($users['User']['country'])." "; ?></h1>
<h1><?php echo "Rol: ".h($users['User']['role'])." "; ?></h1>