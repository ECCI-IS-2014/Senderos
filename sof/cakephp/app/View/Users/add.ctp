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
<<<<<<< HEAD
        <fieldset id="registro">
            <legend><?php echo __('Registro de usuarios'); ?></legend>
            <?php   echo $this->Form->input('username', array('title' => 'Nombre de usuario', 'label' => 'Nombre de usuario '));
                    echo "<br>";
                    echo "<br>";
                    echo $this->Form->input('password', array('title' => 'Contraseña', 'label' => 'Contraseña '));
                    echo "<br>";
                    echo "<br>";
                    echo $this->Form->input('password_confirm', array('label' => 'Confirmar contraseña ', 'title' => 'Confirmar contraseña', 'type'=>'password'));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('name', array('title' => 'Nombre', 'label' => 'Nombre '));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('lastname', array('title' => 'Apellido', 'label' => 'Apellido '));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('email', array('title' => 'Correo electrónico', 'label' => 'Correo electrónico '));
		            echo "<br>";
		            echo "<br>";
		            echo $this->Form->input('country', array('title' => 'País', 'type' => 'select', 'options' => $countries, 'empty' => 'Seleccione su país', 'label' => 'País '));
                    echo "<br>";
                    echo "<br>";
                    echo $this->Form->input('role', array('options' => array('admin' => 'Administrador', 'cust' => 'Cliente'), 'title'=>'Rol', 'label'=>'Rol '));
=======
        <fieldset>
            <legend><?php echo __('User Registration'); ?></legend>
            <?php   echo $this->Form->input('username')."<br><br>";
                    echo $this->Form->input('password')."<br><br>";
                    echo $this->Form->input('password_confirm', array('title' => 'Confirm password', 'type'=>'password'))."<br><br>";
		            echo $this->Form->input('name')."<br><br>";
		            echo $this->Form->input('lastname')."<br><br>";
		            echo $this->Form->input('email')."<br><br>";
		            echo $this->Form->input('country', array('type' => 'select', 'options' => $countries, 'empty' => 'Select One', 'label' => 'Country:'))."<br><br>";
                    echo $this->Form->input('role', array('options' => array('admin' => 'Administrador', 'cust' => 'Cliente')))."<br><br>";
>>>>>>> 2dc2a4f3c950cf9d28b909db6e05a10e981676cc
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Registrar')); ?>
    </div>

</div>
</body>
</html>