<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de la tienda</title>
    <style>
    @import url(http://fonts.googleapis.com/css?family=Raleway);

	#header
	{
		text-align: center;
		font-family: 'Raleway';
		padding: 0 0 0 0;
		height: 10em;
	}

	#header h1
	{
	    padding: 0 0 2.75sem 0;
		margin: 0;
	}

	#header h1 a
	{
	    font-family: Helvetica, sans-serif;
	    font-size: 3.5em;
		letter-spacing: -0.025em;
		border: 0;
	}

	#nav
	{
	    height: 9em;
		cursor: default;
		background-color: #7BC143;
		padding: 0;
	}

	#nav > ul
	{
	    margin: 10;
	    margin-top:3em;
	    margin-left:4em;
	    float:left;
	}

	#nav > ul > li
	{
	    position: relative;
		display: inline-block;
		margin-left: 2em;
	}

	#nav > ul > li a
	{
	    color: #fff;
        text-decoration: none;
        font-size: 1.2em;
        border: 0;
        display: block;
        padding: 1.5em 0.5em 1.35em 0.5em;
	}

    #nav > ul > li:hover a
    {
	    color: #81F7D8;
	}

	#search_bar
    {
        height:50px;
        text-align: center;
        background-color: #151515;
        padding: 0 0 0 0;
    }

    #s_field
    {
        display:inline;
        font-family: Helvetica, sans-serif;
        font-size:12px;
        color:#000000;
        width:50%;
        float:left;
        text-align:left;
        padding:0.8em;
    }

    #right_side
    {
        float:right;
        font-family: 'Raleway';
        margin-right:0.4em;
        margin-top:0.4em;
        padding:10px;
        color: #fff;
    }

    #right_side a
    {
        color: #fff;
    }

    #right_side a:hover
    {
        color: #BCBCBC;
    }

    </style>
</head>

<body>

    <div id="header">
		    <nav id="nav">
		        <?php echo $this->Html->link(
            					$this->Html->image('oet.png', array('alt' => "Inicio", 'title' => 'Inicio','style'=> "margin-left:15px;margin-top:15px;float:left;width:250px;height:75px;padding:10px;")),
            					array('controller' => 'products', 'action' => 'index'),
            					array('target' => '_self', 'escape' => false)
            				);
            	?>
		        <ul>
                   <li align=center><a>F.A.Q</a></li>
                   <li align=center><a>Contáctenos</a></li>
                </ul>
			</nav>
	</div>
</body>
</html>