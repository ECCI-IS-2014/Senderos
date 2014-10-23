<!DOCTYPE html>
<html>

<head>
    <title>Busqueda</title>
    <style>

        body
        {
            background: #151515;
        }

        #container
        {
            margin-left: auto;
            margin-right: auto;
            background-color: #FFFFFF;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        #cabecera
        {
            margin-left: auto;
            margin-right: auto;
            background-color: #FFFFFF;
        }

        #nav
        {
            margin:10px;
            margin-left: auto;
            margin-right: auto;
            height:50px;
            padding:10px;
            background-color: #FFFFFF;
        }

        #nav ul
        {
            float:left;
            margin:0px;
            width:1000px;
        }

        #nav li
        {
            display: inline;
        }

        #nav li a
        {
            font-family: Helvetica, Geneva, sans-serif;
            font-size:15px;
            text-decoration: none;
            width:120px;
            float:left;
            padding: 10px;
            background-color: #56BBAC;
            color: #fff;
        }

        #nav li a:hover
        {
            background-color: #4C9E90;
        }

        #rightside
        {
            float:right;
            padding:10px;
            height:17px;
            color: #151515;
        }

    </style>
</head>

<body>
<div id="container">

    <div id="cabecera">
        <div id="imagen">
            <?php echo $this->Html->image('tiendaweb.png', array('style'=> "width:240px;height:128px;padding:10px;"));?>
        </div>
    </div>

    <div id="nav">
        <ul>
            <li align=center><?php echo $this->Form->postLink('Inicio',array('action' => 'index'));?></li>
            <li align=center><?php echo $this->Form->postLink('Clientes',array('controller'=>'users','action' => 'index'));?></li>
            <li align=center><a>F.A.Q</a></li>
            <li align=center><a>Ayuda</a></li>
            <li align=center><a>Contáctenos</a></li>
			<li align=center><?php echo $this->Form->postLink('Buscar',array('action' => 'search'));?></li>
        </ul>

        <div id="rightside">
            <?php   if($this->Session->read('Auth.User.username')==null)
                    {
                        echo '<p>'.$this->Html->link('Ingresar',array('controller' =>'users','action'=>'login'))."&nbsp&nbsp&nbsp".$this->Html->link('Crear cuenta',array('controller' => 'users', 'action' => 'add')).'</p>';
                    }
                    else
                    {
                        echo '<p>Conectado como: <b>'.$this->Session->read('Auth.User.username').'</b>'."&nbsp&nbsp(".$this->Html->link('Salir',array('controller' =>'users','action'=>'logout')).")".'</p>';
                    }
            ?>
        </div>
    </div>

</div>
</body>
</html>