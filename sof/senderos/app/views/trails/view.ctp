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
<?php echo $html->css('pointscss'); ?>
<?php echo $html->css('stations'); ?>
<?php echo $html->css('menu7'); ?>
<?php echo $html->css('documentscss'); ?>
<?php echo $html->script("draggable"); ?>
<?php echo $html->script("points"); ?>
<?php echo $html->script("slider"); ?>
<?php
$result = '';
$trailcreate = 'no';
$trailread = 'yes';
$trailupdate = 'no';
$traildelete = 'no';

if($_SESSION['role'] === 'restricted')
{
	foreach ($restrictions as $restriction):
	if($restriction['Restriction']['model'] == 'Trail' && $restriction['Restriction']['recordid'] == $trail['Trail']['id'])
	{
		if($restriction['Restriction']['creating'] === '1')
			$trailcreate = 'yes';
		if($restriction['Restriction']['reading'] === '0')
			$trailread = 'no';
		if($restriction['Restriction']['updating'] === '1')
			$trailupdate = 'yes';
		if($restriction['Restriction']['deleting'] === '1')
			$traildelete = 'yes';
			
		$result .= "<br>Found a restriction on ".$trail['Trail']['id'].": C=".$trailcreate.", R=".$trailread.", U=".$trailupdate.", D=".$traildelete."";
	}
	endforeach;
}
else if($_SESSION['role'] === 'administrator')
{
	$trailcreate = 'yes';
	$trailread = 'yes';
	$trailupdate = 'yes';
	$traildelete = 'yes';
}
else
{
	$trailcreate = 'no';
	$trailread = 'yes';
	$trailupdate = 'no';
	$traildelete = 'no';
}

if($trailread == 'yes')
{

?>

<div class="trailview">
<div class="trails view">
<h2><?php  __($str_trails);?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __($str_name); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trail['Trail']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __($str_description); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $trail['Trail']['description']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __($str_stations); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($trail['Station']['name'], array('controller' => 'stations', 'action' => 'view', $trail['Station']['id'])); ?>
			&nbsp;
		</dd>
	</dl>

<br>

	<!--<table style="table-layout:fixed; overflow:hidden; white-space: nowrap;">-->
	<!-- map and tools div -->
	<div id="mapdiv">
		<!-- map container -->
		<div id="borderBox" style="position:relative;border:1px solid black;width:700px;height:700px;overflow:hidden;">

		<!-- map div -->
		<div id="mapLayer" style="width:1024px;height:1024px;top:0px;left:0px;position:absolute;cursor: default; background-image: url('/senderos/app/webroot/img/<?php echo $trail['Trail']['image']; ?>'); background-size: 1024px 1024px;" ></div><!-- /map div -->

		<!-- points layer -->
		<div id="pointsLayer" style="position: absolute;height: 1024px;width: 1024px; background-size: 1024px 1024px;pointer-events: none;">
		

		<?php foreach ($trail['Point'] as $point): ?>

			<!-- point_ -->
			<div id="point_<?php echo $point['id']; ?>" class="point" style="position: absolute;top: <?php echo $point['px_y']; ?>px; left: <?php echo $point['px_x']; ?>px; pointer-events: all; cursor: pointer;" onmouseover="PointTitle(<?php echo $point['id']; ?>);"></div><!-- /point_ -->

			<!-- labels -->
			<div id="label_<?php echo $point['id']; ?>" class="pointlabel" style="position: absolute;top: <?php echo ($point['px_y']-5); ?>px; left: <?php if(($point['pnumber'] * 1) < 10) echo ($point['px_x']-15); else echo ($point['px_x']-25); ?>px; pointer-events: none;"><?php echo $point['pnumber']; ?></div><!-- /labels -->

			<?php
				echo "<script type='text/javascript'>";
				echo "var newpoint = document.getElementById('point_".$point['id']."');";
				echo "newpoint.addEventListener('contextmenu', function(evt) {evt.preventDefault();}, false);";
				echo "var mover = function (event) {point_action(".$point['id'].",event);};";
				echo "var stopper = function (event) {};";
				echo "newpoint.addEventListener('mouseup', mover, false);";
				echo "</script>";
			?>


		<?php endforeach; ?>

		</div><!-- /points layer -->

    		</div><!-- /map container -->

		<!-- popup div -->
		<div id="point_title" style="z-index:100; position:absolute; display: none;"></div><!-- /popup div -->


		<!-- popup div -->
		<div id="context_menu" style="z-index:100; position:absolute; display: none;">
			
		</div><!-- /popup div -->


		<!-- maptools -->
		<div id="maptools">
			<select id='zooming' onchange="zoomings (this);">
				<option value="25%">25%</option>
				<option value="50%">50%</option>
				<option value="75%">75%</option>
				<option value="100%" selected="selected">100%</option>
				<option value="150%">150%</option>
				<option value="200%">200%</option>
				<option value="250%">250%</option>
				<option value="300%">300%</option>
			</select>

			<p style='display:none;'>X:<span id="x"></span></p>
			<p style='display:none;'>Y:<span id="y"></span></p>

			<p style='display:none;'>X:<span id="ax"></span></p>
			<p style='display:none;'>Y:<span id="ay"></span></p>

		</div>

	</div><!-- /map and tools div -->

	<script type="text/javascript">
		initMap();
	</script>


	<?php
	// accessing php language from javascript
		echo "<script type='text/javascript'>";
		echo "var str_explore='".$str_explore."';";
		echo "var str_multimedia='".$str_multimedia."';";
			echo "var str_images='".$str_images."';";
			echo "var str_videos='".$str_videos."';";
			echo "var str_sounds='".$str_sounds."';";
			echo "var str_texts='".$str_texts."';";
			echo "var str_others='".$str_others."';";
		echo "var str_cancel='".$str_cancel."';";
		
		echo "var languages='en';";
		if(isset($_POST['languages']))
			echo "languages='".$_POST['languages']."';";
		
		echo "</script>";
	?>



</div><!-- /trails view -->


<div id="popDiv" class="ontop">
	<div id="popup">
		<a style="cursor: pointer;" onClick="hide('popDiv')">Close</a>
		<div id="popup_content" >
		</div> <!-- popup_content -->
	</div> <!-- popup -->
</div> <!-- popDiv -->






<!--<div id="poping">-->
<div id="popingmenu" >
<!--<ul>
	<li><a class="firstitem" href="#">Explore</a></li>
	<li><a href="#">Multimedia</a>
		<ul>
			<li><a class="firstitem" href="#">Images</a></li>
			<li><a href="#">Videos</a></li>
			<li><a href="#">Sound</a></li>
			<li><a href="#">Text</a></li>
			<li><a class="lastitem" href="#">Other</a></li>
		</ul>
	</li>
	<li><a class="lastitem" href="#">Cancel</a></li>
</ul>-->
</div>


<?php 

}

?>



<div >

	<?php
	
	echo $result;
	
	?>

</div>


<?php 
if($_SESSION['role'] === 'restricted' || $_SESSION['role'] === 'administrator')
{
?>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php 
		if($trailupdate === 'yes')
			echo $this->Html->link(__('Edit Trail', true), array('action' => 'edit', $trail['Trail']['id'])); 
		/*else 
			echo "---";*/
		?> </li>
		<li><?php 
		if($traildelete === 'yes')
			echo $this->Html->link(__('Delete Trail', true), array('action' => 'delete', $trail['Trail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trail['Trail']['id'])); 
		/*else 
			echo "---";*/
		?> </li>
		<li><?php echo $this->Html->link(__('List Trails', true), array('action' => 'index')); ?> </li>
		<li><?php 
		if($trailcreate === 'yes')
			echo $this->Html->link(__('New Trail', true), array('action' => 'add')); 
		/*else 
			echo "---";*/
		?> </li>
		<!-- <li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li> -->
	</ul>
</div><!-- actions -->

<?php
}
else{
?>
    <div class="actions">
    	<ul>
    <li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link(__('List Trails', true), array('controller' => 'trails', 'action' => 'stationtrails',$station)); ?> </li>
	</ul>
</div>
<?php } ?>
</div>