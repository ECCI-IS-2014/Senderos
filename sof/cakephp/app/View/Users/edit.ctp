<?php include("header.ctp");?>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Editar usuario'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
		echo $this->Form->input('name');
		echo $this->Form->input('lastname');
		echo $this->Form->input('email');
		echo $this->Form->input('country');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Administrator', 'cust' => 'Customer')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar cambios')); ?>
</div>