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

<?php include("header.ctp");?>

<div id="container">

    <div class="usersform">
    <?php echo $this->Form->create('User'); ?>
        <fieldset id="registro">
            <legend><?php echo __('Editar usuario'); ?></legend>
            <?php
                echo $this->Form->input('username',array('title' => 'Nombre de usuario', 'label' => 'Nombre de usuario '));
                echo "<br><br>";
                echo $this->Form->input('password',array('title' => 'Contraseña', 'label' => 'Contraseña '));
                echo "<br><br>";
		        echo $this->Form->input('name',array('title' => 'Nombre', 'label' => 'Nombre '));
		        echo "<br><br>";
		        echo $this->Form->input('lastname',array('title' => 'Apellido', 'label' => 'Apellido '));
		        echo "<br><br>";
		        echo $this->Form->input('email',array('title' => 'Correo electrónico', 'label' => 'Correo electrónico '));
		        echo "<br><br>";
		        echo $this->Form->input('country',array('title' => 'País', 'label' => 'País '));
		        echo "<br><br>";
                echo $this->Form->input('role', array('options' => array('admin' => 'Administrator', 'cust' => 'Customer'), 'title'=>'Rol', 'label'=>'Rol '));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Guardar cambios')); ?>
    </div>
</div>

</body>
</html>