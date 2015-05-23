<?php echo $html->css('pointscss'); ?>
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

<div class="trails form">
<?php echo $this->Form->create('Trail', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Edit Trail'); ?></legend>
	<?php
        echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('station_id');
        	echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Select a map image:'));
	?>

	
	<?php 
	if($_SESSION['role'] === 'restricted' || $_SESSION['role'] === 'administrator')
	{
	?>

	<label for="EditMap"><b>Edit current map:</b></label>

	<!--<?php echo WWW_ROOT; ?>-->

	
	
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

			<input type="hidden" id="point_<?php echo $point['id']; ?>_id" value="<?php echo $point['id']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_pnumber" value="<?php echo $point['pnumber']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_name" value="<?php echo $point['name']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_cordx" value="<?php echo $point['cordx']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_cordy" value="<?php echo $point['cordy']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_description" value="<?php echo $point['description']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_trail_id" value="<?php echo $point['trail_id']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_px_x" value="<?php echo $point['px_x']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_px_y" value="<?php echo $point['px_y']; ?>"/>
			
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
		echo "var languages='en';";
		if(isset($_POST['languages']))
		echo "languages='".$_POST['languages']."';";
		echo "</script>";
	?>
	
	
	
	
	
	<?php 
	}
	?>


	</fieldset>
	
<?php 

if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
	echo $this->Form->end(__('Submit', true));

?>

	

</div>



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
	<li onclick="context_menu.innerHTML = '<li>Drag the point !!</li>';setMoving('"+id+"');">Move</li>
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


<div id="save_point" style="display:none">
	<div class="points form">
		<?php echo $this->Form->create('Point');?>
			<fieldset>
				<legend><?php __('Save Point'); ?></legend>
			<?php
				echo $this->Form->input('pnumber', array("onkeyup" => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"));
				echo $this->Form->input('name');
				echo $this->Form->input('cordx', array("onkeyup" => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"));
				echo $this->Form->input('cordy', array("onkeyup" => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"));
				echo $this->Form->input('description');
				//echo $this->Form->input('trail_id',array('value' => 'hidden'));
				echo "<div class='input text required'>\n
	    				
	    				<input id='PointTrailId' type='hidden' value='".$trail['Trail']['id']."' maxlength='100' name='data[Point][trail_id]'></input>\n
					</div>\n";
				echo $this->Form->input('px_x',array('type' => 'hidden'));
				echo $this->Form->input('px_y',array('type' => 'hidden'));
			?>

			<?php if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted'){ ?>
			<div class="submit">
			<input id="savePoint" type="button" value="Submit"></input>
		    </div>
		    
		    <?php } ?>
		    

			</fieldset>
		<!--<?php 
				if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
					echo $this->Form->end(__('Submit', true));
				?>-->
		    

		</form>

	</div><!-- points form -->

</div> <!-- save_point -->


<?php
	/*ini_set('upload_max_filesize', '50M');
	ini_set('post_max_size', '50M');
	ini_set('max_input_time', 300);
	ini_set('max_execution_time', 300);*/
				
?>



<div id="save_document" style="display:none">
	<div class="documents form">
		<form action="/senderos/documents/add" id="DocumentAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div style="display:none;">
				<input name="_method" value="POST" type="hidden">
			</div>
				
			<fieldset id="formulario_interno">
				<legend><?php __('Save File'); ?></legend>
				<input name="data[Point][id]" id="PointId" type="hidden">
				<input name="data[Document][id]" id="DocumentId" type="hidden">
				<div class="input text required">
					<label for="DocumentName">Name</label>
					<input name="data[Document][name]" maxlength="100" id="DocumentName" type="text">
				</div>
				<div class="input text required">
				<label for="DocumentDescription">Description</label>
				<input name="data[Document][description]" maxlength="500" id="DocumentDescription" type="text">
				</div>
				<div class="input select required">
					<label for="DocumentType">Type</label>
					<select name="data[Document][type]" id="DocumentType">
						<option value="2">Image</option>
						<option value="0">Video</option>
						<option value="3">Sound</option>
						<option value="1">Text</option>
						<option value="4">Other</option>
					</select>
				</div>
				<div class="input file">
				<table><tr><td>
				<label for="DocumentRoute"><b>Select a file:</b></label></td><td>
				<input name="data[Document][archivo]" id="DocumentArchivo" type="file" accept="image/*, video/*, audio/*, application/pdf">
				</td></tr></table>
				</div>
				<div class="input text required">
					<label for="DocumentLanguage">Language</label>
					<input name="data[Document][language]" maxlength="100" id="DocumentLanguage" type="text">
				</div>
				
				<?php if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted'){ ?>
				<div class="submit">
				<input type="button" value="Submit" onclick="saveDocument();"></input>
			    </div>
			    <?php } ?>
				
				
			</fieldset>
			<!-- <div id="submit_button">
				<div class="submit">
					<input value="Submit" type="submit">
				</div>
			</div> -->
		</form>
	</div> <!-- documents form -->
</div> <!-- save_document -->



<!--<input type="button" value="Submit" onclick="newPoint()">-->


<?php 

}

?>



<div >

	<?php
	
	//echo $result;
	
	?>

</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php 
		if($traildelete === 'yes')
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Trail.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Trail.id'))); 
		/*else 
			echo "---";*/
		?></li>
		<li><?php echo $this->Html->link(__('List Trails', true), array('action' => 'index'));?></li>
		<!-- <li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li> -->
	</ul>
</div> <!-- actions -->

