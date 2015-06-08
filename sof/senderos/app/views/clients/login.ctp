<div class="clients index">
<h2><?php __('Login');?></h2>
<?php
    echo $session->flash('auth');
    echo $form->create('Client', array('controller'=>'clients','action' => 'login'));
?>
    <h1 title = "You MUST type your username"> <?php echo $form->input('username'); ?> </h1>
    <h1 title = "You MUST type your password"> <?php echo $form->input('password'); ?> </h1>
<?php
    echo $form->end('Login');
?>
</div>