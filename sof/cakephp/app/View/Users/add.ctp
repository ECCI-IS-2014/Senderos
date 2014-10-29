<!DOCTYPE html>
<html>
<body>

    <?php include("header.ctp");?>

    <div class="users form">
        <?php echo $this->Form->create('User'); ?>
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
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Sign in')); ?>
    </div>

</body>
</html>