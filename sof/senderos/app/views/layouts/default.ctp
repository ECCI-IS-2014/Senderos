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
		echo $this->Html->script('ckeditor/ckeditor');
	?>
    <?php
        if(!isset($_SESSION['lanview']))
        {
            include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/en.php';
        }
        else
        {
            $language = $_SESSION['lanview'];
            include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/'.$language.'.php';
        }
    ?>
</head>
<body>
	<div id="container">
				<div id="header">
        		    <nav id="nav">
        		        <?php echo $this->Html->link($this->Html->image('oet.png', array('alt' => "Inicio", 'class'=>'oetlogo','title' => 'www.ots.ac.cr','style'=> "float:left;width:10.2em;height:2.5em;padding:0.5em;")),
                                                                        'http://www.ots.ac.cr/',
                                                                        array('target' => '_blank', 'escape' => false));
                        ?>
                        <?php echo $this->Html->link($this->Html->image('senderos2.png', array('alt' => "Inicio", 'title' => 'Home','style'=> "float:right;width:10em;height:4em;padding:0.9em;")),
                                                    					array('controller'=>'pages','action' => 'home'),
                                                     					array('target' => '_self', 'escape' => false));
                        ?>
                    </nav>
               </div>
        <?php if($this->Session->read('Auth.Client.id') != null)
        {
        ?>
        <div id="navegador">
            <ul>
                    <li><?php echo $this->Html->link(__($str_stations, true), array('controller'=>'stations', 'action'=>'stationindex')); ?></li>
                    <li><?php echo $this->Html->link(__($str_trails, true), array('controller'=>'trails', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_points, true), array('controller'=>'points', 'action'=>'index')); ?></li>
                 	<li><?php echo $this->Html->link(__($str_documents, true), array('controller'=>'documents', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_clients, true), array('controller'=>'clients', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_visitors, true), array('controller'=>'visitors', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_languages, true), array('controller'=>'languages', 'action'=>'index')); ?></li>
            <div id="login">
                <?php
            	    if($this->Session->read('Auth.Client.id') != null){
						echo $this->Session->read('Auth.Client.username').': ';
            		    echo $this->Html->link(__($str_logout, true), array('controller'=>'clients', 'action'=>'logout'));
            		}
                ?>
            </div>
            </ul>
        </div>
        <?php
        }
        ?>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
	    <script>
        function lan2(elmnt,clr)
        {
            //var x = document.getElementById("lan2");
            //alert(clr);
            var x = clr;
            if(window.XMLHttpRequest)
                ajax = new XMLHttpRequest()
            else
                ajax = new ActiveXObject("Microsoft.XMLHTTP");

            ajax.open("GET","/senderos/languages/setlanguage?lan="+x+"",true);

            ajax.onreadystatechange=function()
            {
                if(ajax.readyState==4)
                {
                    var respuesta=ajax.responseText;
                    location.reload();
                }
            }
            ajax.send(null);
        }
        </script>
	<?php echo $this->element('sql_dump'); ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <!-- scripts_for_layout -->
    <?php echo $scripts_for_layout; ?>
    <!-- Js writeBuffer -->
    <?php
    if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
    // Writes cached scripts
    ?>
</body>
</html>