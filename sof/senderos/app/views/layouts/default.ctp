<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo "Senderos - ".$title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('favicon.ico','img/favicon.ico',array('type' => 'icon'));
		echo $this->Html->css('cake.generic');
        echo $this->Html->script('jquery'); // Include jQuery library
		echo $scripts_for_layout;
	?>
    <?php
        if($title_for_layout == 'Home')
        {
            if(!isset($_SESSION['language']))
            {
                if(!isset($_POST['languages']))
                {
                    if(!isset($_POST['languages']))
                    include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/en.php';
                }
                else
                {
                    $_SESSION['language'] = $_POST['languages'];
                    $language = $_SESSION['language'];
                    include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/'.$language.'.php';
                }
            }
            else
            {
                $language = $_SESSION['language'];
                include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/'.$language.'.php';
            }
        }
        else
        {
            $language = $_SESSION['language'];
            include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/'.$language.'.php';
        }
    ?>
</head>
<body>
	<div id="container">
				<div id="header">
        		    <nav id="nav">
                        <?php echo $this->Html->link(
                            	$this->Html->image('oet.png', array('alt' => "Inicio", 'title' => 'Inicio','style'=> "margin-right:15px;margin-top:05px;float:right;width:250px;height:75px;padding:30px;")),
                            					array('controller'=>'pages','action' => 'home'),
                             					array('target' => '_self', 'escape' => false));
                        ?>
                    </nav>
               </div>
        <div id="navegador">
            <ul>
                    <li><?php echo $this->Html->link(__($str_stations, true), array('controller'=>'stations', 'action'=>'index')); ?></li>
                    <li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_trails, true), array('controller'=>'trails', 'action'=>'index'));} ?></li>
                    <li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_points, true), array('controller'=>'points', 'action'=>'index'));} ?></li>
                 	<li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_documents, true), array('controller'=>'documents', 'action'=>'index'));} ?></li>
                    <li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_clients, true), array('controller'=>'clients', 'action'=>'index'));} ?></li>
            <div id="login">
                <?php
            	    if($this->Session->read('Auth.Client.id') != null){
						echo $this->Session->read('Auth.Client.role').': ';
            		    echo $this->Html->link(__($str_logout, true), array('controller'=>'clients', 'action'=>'logout'));
            		}
                ?>
            </div>
            </ul>
        </div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
    	<div id="footer">
    	    <?php if($title_for_layout == 'Home')
    	    {
    	    ?>
    	    <div id="languages">
                <form action="" method="post">
                    <select name="languages">
                        <option value="es">Español</option>
                        <option value="en">English</option>
                        <option value="pt">Português</option>
                    </select>
                <input type="submit" value=<?php echo $str_change_lan ?> >
                </form>
    	    </div>
    	    <?php
    	    }
    	    ?>
		</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
