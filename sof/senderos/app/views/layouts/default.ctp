<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
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
        $lan = $this->params['language'];
        include '/../layouts/'.$lan.'.php';
        if($lan==null)
        {
            include '/../layouts/en.php';
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
                    <li><?php echo $this->Html->link(__($str_stations, true), '../'.$this->params['language'].'/stations/index'); ?></li>
                    <li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_trails, true), '../'.$this->params['language'].'/trails/index');} ?></li>
                    <li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_points, true), '../'.$this->params['language'].'/points/index');} ?></li>
                 	<li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_documents, true), '../'.$this->params['language'].'/documents/index');} ?></li>
                    <li><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__($str_clients, true), '../'.$this->params['language'].'/clients/index');} ?></li>
            <div id="login">
                <?php
            	    if($this->Session->read('Auth.Client.id') != null){
            		    echo $this->Html->link(__($str_logout, true), '../'.$this->params['language'].'/clients/logout');
            		}else{
            		    echo $this->Html->link(__($str_login, true), '../'.$this->params['language'].'/clients/login');
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
    	    <div id="languages">
                <ul>
                    <li><?php if($title_for_layout!='Home'){echo $html->link('English', array('language'=>'en'));} ?></li>
                    <li><?php if($title_for_layout!='Home'){echo $html->link('Español', array('language'=>'es'));} ?></li>
                    <li><?php if($title_for_layout!='Home'){echo $html->link('Português', array('language'=>'pt'));} ?></li>
                    <li><?php if($title_for_layout!='Home'){echo $html->link('Română', array('language'=>'ro'));} ?></li>
                    <li><?php if($title_for_layout!='Home'){echo $html->link('中文', array('language'=>'zh'));} ?></li>
                    <div id="login">
                    <?php echo $this->Html->link(
                        $this->Html->image('ots.logo.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
                    	                   'http://www.ots.ac.cr/',
                    					   array('target' => '_blank', 'escape' => false));
                    ?>
                    </div>
                </ul>
    	    </div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>