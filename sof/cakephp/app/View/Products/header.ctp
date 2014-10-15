<!DOCTYPE html>
<html>

<head>
    <title>Busqueda</title>
    <style>

        body
        {
            background: #FFFFFF;
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
            float:left;
            padding:10px;
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
            width:100px;
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
        }

    </style>
</head>

<body>
<div id="container">

    <div id="cabecera">
        <div id="imagen">
            <?php echo $this->Html->image('tiendaweb.png', array('style'=> "width:228px;height:128px"));?>
        </div>
    </div>

    <div id="nav">
        <ul>
            <li><?php echo $this->Form->postLink('Inicio',array('action' => 'index'));?></li>
            <li><a href="../Users/index">Clientes</a></li>
            <li><a>F.A.Q</a></li>
            <li><a>Ayuda</a></li>
            <li><a>Contáctenos</a></li>
			<li><?php echo $this->Form->postLink('Buscar',array('action' => 'search'));?></li>
        </ul>
    </div>

    <div id="rightside">
        <?php   if($this->Session->read('Auth.User.username')==null)
                {
                    echo '<p>'.$this->Html->link('Ingresar',array('controller' =>'users','action'=>'login')).'</p><br>';
                    echo $this->Html->link('Crear cuenta',array('controller' => 'users', 'action' => 'add'));
                }
                else
                {
                    echo '<p>Conectado como: <b>'.$this->Session->read('Auth.User.username').'</b></p><br>';
                    echo $this->Html->link('Logout',array('controller' =>'users','action'=>'logout'));
                }
        ?>
    </div>

</div>
</body>
</html>