<div class="loginform">
<?php
    echo $session->flash('auth');
    echo $form->create('Client', array('controller'=>'clients','action' => 'login'));
?>
    <p title = "Type your username"> <?php echo $form->input('username'); ?> </p>
    <p title = "Type your password"> <?php echo $form->input('password'); ?> </p>
<?php
    echo $form->end('Login');
?>
</div>