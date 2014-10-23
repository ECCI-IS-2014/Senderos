<!DOCTYPE html>
<html>
<body>

    <?php include("header.ctp");?>

    <div class="users form">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Agregar un usuario'); ?></legend>
            <?php   echo $this->Form->input('username');
                    echo $this->Form->input('password');
		            echo $this->Form->input('name');
		            echo $this->Form->input('lastname');
		            echo $this->Form->input('country');
                    echo $this->Form->input('role', array('options' => array('admin' => 'Administrador', 'cust' => 'Cliente')));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Enviar')); ?>
    </div>

</body>
</html>