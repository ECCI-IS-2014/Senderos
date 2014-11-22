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
		        echo $this->Form->input('country', array('title' => 'País', 'type' => 'select', 'options' => $countries, 'empty' => 'Seleccione su país', 'label' => 'País '));
		        echo "<br><br><br>";
		                        if($dcnull == 1 && $ccnull == 1)
                {
                    echo "Tarjetas registradas: No tiene tarjetas registradas hasta el momento";
                    echo "<br><br>";
                    echo $this->Html->link('Registrar nueva tarjeta de débito',array('controller' =>'debitcard','action'=>'register'));
                    echo "<br><br>";
                    echo $this->Html->link('Registrar nueva tarjeta de crédito',array('controller' =>'creditcard','action'=>'register'));
                    echo "<br><br>";
                }
                else
                {
                echo "Tarjetas registradas:";
                    if($dcnull == 0)
                    {
                        echo $this->Form->input('card', array('title' => 'Pago1', 'type' => 'select', 'options' => $dcard_num, 'empty' => 'Sus tarjetas de débito', 'label' => ''));
                        echo "<br><br>";
                        echo $this->Html->link('Eliminar tarjeta de débito',array('controller' =>'carduser','action'=>'delete_debit'));
                        echo "<br><br>";
                    }
                    if($ccnull == 0)
                    {
                        echo $this->Form->input('card', array('title' => 'Pago2', 'type' => 'select', 'options' => $ccard_num, 'empty' => 'Sus tarjetas de crédito', 'label' => ''));
                        echo "<br><br>";
                        echo $this->Html->link('Eliminar tarjeta de crédito',array('controller' =>'carduser','action'=>'delete_credit'));
                        echo "<br><br>";
                    }
                    echo "<br>";
                    echo $this->Html->link('Registrar nueva tarjeta de débito',array('controller' =>'debitcard','action'=>'register'));
                    echo "<br>";
                    echo $this->Html->link('Registrar nueva tarjeta de crédito',array('controller' =>'creditcard','action'=>'register'));
                    echo "<br><br>";
                }
		        if($this->Session->read('Auth.User.role')== 'admin')
		        {
                    echo $this->Form->input('role', array('options' => array('admin' => 'Administrator', 'cust' => 'Customer'), 'title'=>'Rol', 'label'=>'Rol '));
                }
				echo "<br><br>";
				 if($this->Session->read('Auth.User.role')== 'admin')
		        {
                    echo $this->Form->input('type', array('title' => 'Tipo de Cliente', 'type' => 'select', 'options' => array('Estandar', 'VIP','Adulto Mayor ',' Adulto Mayor VIP') , 'empty' => 'Seleccione tipo', 'label' => 'Tipo de Usuario: '));
                }
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Guardar cambios')); ?>
    </div>
</div>

</body>
</html>