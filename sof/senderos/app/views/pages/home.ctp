<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div id="welcome">
	<h2><?php if($this->Session->read('Auth.Client.id') == null) echo 'Welcome! Please register'; ?></h2>
        <?php
            if($this->Session->read('Auth.Client.id') == null){
                echo $session->flash('auth');
                echo $form->create('Visitor', array('controller'=>'pages', 'action' => 'home'));
                echo $form->input('role', array('options' => array('Student' => 'Student', 'Professor' => 'Professor', 'Investigator' => 'Researcher'), 'title'=>'role', 'label'=>'Visitor '));
                echo $form->end(__('Enter', true));
            }
        ?>
    </div>
</body>
</html>