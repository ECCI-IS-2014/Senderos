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
                        <?php echo $this->Html->link($this->Html->image('senderos2.png', array('alt' => "Inicio", 'title' => 'Inicio','style'=> "margin-left:20px;margin-top:15px;float:left;width:225px;height:95px;padding:30px;")),
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
                    <li><?php echo $this->Html->link(__($str_stations, true), array('controller'=>'stations', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_trails, true), array('controller'=>'trails', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_points, true), array('controller'=>'points', 'action'=>'index')); ?></li>
                 	<li><?php echo $this->Html->link(__($str_documents, true), array('controller'=>'documents', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_clients, true), array('controller'=>'clients', 'action'=>'index')); ?></li>
                    <li><?php echo $this->Html->link(__($str_languages, true), array('controller'=>'languages', 'action'=>'index')); ?></li>
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
        <?php
        }
        ?>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
    	<div id="footer">
            <div id="credits">
            <?php if($this->Session->read('Auth.Client.id') == null)
            {
                if(isset($_SESSION['language']))
                {
                    $lanv = $this->requestAction('/languages/getlanname');
                    echo 'Your language is: '.$lanv['Language']['name']."<br>";
                }
                if(isset($_SESSION['role']))
                {
                echo 'You\'re a: '.$_SESSION['role'].'';
                }
            }
            ?>
            </div>
            <br>
    	    <div id="languages">
                <?php if($title_for_layout!='Home')
                {
                ?>
                <ul>
                    <li><a id="lan2" onclick="lan2(this, 'es')">Español</a></li>
                    <li><a id="lan2" onclick="lan2(this, 'en')">English</a></li>
                </ul>
                <?php
                }
                ?>
                <?php echo $this->Html->link($this->Html->image('oet.png', array('alt' => "Inicio", 'title' => 'Inicio','style'=> "margin-right:0px;margin-top:1.7em;float:right;width:125px;height:40px;padding:10px;")),
                                                  					       'http://www.ots.ac.cr/',
                                                                           array('target' => '_blank', 'escape' => false));
                ?>
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
    	    </div>
		</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>