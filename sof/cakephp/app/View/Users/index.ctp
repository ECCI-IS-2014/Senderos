<?php
if($this->Session->read('Auth.User.username')==null){
    echo $this->Html->link('Add New User',array('controller' => 'users', 'action' => 'add'));
    echo ('<br>');
    echo $this->Html->link('Login',array('controller' =>'users','action'=>'login'));
}else{
    echo 'Logged in as: '.$this->Session->read('Auth.User.username').'<br>';
    echo $this->Html->link('Logout',array('controller' =>'users','action'=>'logout'));
}
?>
<br><br>
<a href="../../Products/index">Inicio</a>
<br><br>
<h1>Current Users</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
		<th>Actions</th>
    </tr>
    <?php foreach ($users as $users): ?>
    <tr>
        <td><?php echo $users['User']['id']; ?></td>
		<td><?php echo $this->Html->link($users['User']['username'],
		array('controller' => 'users', 'action' => 'view', $users['User']['id'])); ?></td>
		<td><?php
		if($this->Session->read('Auth.User.role')=='admin'){
		    echo $this->Html->link('Edit', array('action' => 'edit', $users['User']['id']));
		    echo '  ';
            echo $this->Form->postLink('Delete', array('action' => 'delete', $users['User']['id']), array('confirm' => 'Are you sure?'));
        }else{
            if($this->Session->read('Auth.User.id')==$users['User']['id']){
                echo $this->Html->link('Edit', array('action' => 'edit', $users['User']['id']));
            }else{
                echo 'None';
            }
        }
        ?></td>
   </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>