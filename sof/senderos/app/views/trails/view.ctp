<?php echo $html->script("draggable"); ?>
<?php echo $html->script("points"); ?>

<div class="trails view">
<h2><?php  __('Trail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trail['Trail']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trail['Trail']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trail['Trail']['image']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Station'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($trail['Station']['name'], array('controller' => 'stations', 'action' => 'view', $trail['Station']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Station'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
        <!--<?php echo $this->Html->image($trail['Trail']['image'], array('style'=> "width:700px;height:500px;padding:10px;"));?>-->


	<div id="borderBox" style="position:relative;border:1px solid black;width:700px;height:700px;overflow:hidden;">

		<?php echo $this->Html->image($trail['Trail']['image'], array('id'=>"draggableElement", 'style'=> "width:1024px;height:1024px;top:0px;left:0px;position:absolute;cursor: default; overflow:auto;"));?>

		<!--<p id="text" style="z-index:100; position:absolute; left:150px; top:350px; " >Hello World!</p>-->
		<!--<div id="leyenda" style="z-index:100; position:absolute; display: none; background: red;"></div>-->

    	</div>

	<div id="leyenda" style="z-index:100; position:absolute; display: none; background: rgb(10, 20, 60);background: rgba(10, 20, 60, .6);color:white;border-radius:5px; margin: 5px;padding:5px;cursor:pointer;"></div>

	<script type="text/javascript">
		var myImg = document.getElementById("draggableElement");
		//myImg.onmousedown = GetCoordinates;
		myImg.onmousedown = getPoint;
		myImg.onmouseup= function () {moused = 0; myImg.style.cursor = 'default';};
		myImg.onmousemove= SetPointer;
	</script>
	<script type="text/javascript">
	       var el = document.getElementById('draggableElement');
	       var leftEdge = el.parentNode.clientWidth - el.clientWidth;
	       var topEdge = el.parentNode.clientHeight - el.clientHeight;
	       var dragObj = new dragObject(el, null, new Position(leftEdge, topEdge), new Position(0, 0));
	</script>
	 <!--<p>X:<span id="x"></span></p>
	 <p>Y:<span id="y"></span></p>

	 <p>X:<span id="ax"></span></p>
	 <p>Y:<span id="ay"></span></p>-->




        &nbsp;
        </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Trail', true), array('action' => 'edit', $trail['Trail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Trail', true), array('action' => 'delete', $trail['Trail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trail['Trail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Trails', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li>
	</ul>
</div>
