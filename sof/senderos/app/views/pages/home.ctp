<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div id="welcome">
    <h2>Welcome! Please register</h2>
        <?php
            echo $session->flash('auth');
            echo $form->create('Visitor', array('controller'=>'pages', 'action' => 'home'));
            echo $form->input('role', array('options' => array('Student' => 'Student', 'Professor' => 'Professor', 'Investigator' => 'Researcher'), 'title'=>'role', 'label'=>'Visitor '));
		    echo $this->Form->input('role', array('options' => array('es' => 'Español', 'en' => 'English', 'pt' => 'Português', 'ro' => 'Româna', 'zh' => '??'), 'title'=>'Rol', 'label'=>'Language '));
            echo $form->end(__('Enter', true));
        ?>
    </div>
</body>
</html>