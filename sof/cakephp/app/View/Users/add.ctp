<!DOCTYPE html>
<html>
<body>

    <?php include("header.ctp");?>

    <div class="users form">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('User Registration'); ?></legend>
            <?php   echo $this->Form->input('username');
                    echo $this->Form->input('password');
                    echo $this->Form->input('password_confirm', array('title' => 'Confirm password', 'type'=>'password'));
		            echo $this->Form->input('name');
		            echo $this->Form->input('lastname');
		            echo $this->Form->input('email');
		            echo $this->Form->input('country', array('type' => 'select', 'options' => $countries, 'empty' => 'Select One', 'label' => 'Country:'));
                    echo $this->Form->input('role', array('options' => array('admin' => 'Administrador', 'cust' => 'Cliente')));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Sign in')); ?>
    </div>

</body>
</html>