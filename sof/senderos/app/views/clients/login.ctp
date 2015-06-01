<div class="clients index">
<h2><?php __('Login');?></h2>
<?php
    echo $session->flash('auth');
    echo $form->create('Client', array('controller'=>'clients','action' => 'login'));
    echo $form->input('username');
    echo $form->input('password');
    echo $form->end('Login');

?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Register', true), array('controller' => 'clients','action' => 'add')); ?></li>
	</ul>
</div>