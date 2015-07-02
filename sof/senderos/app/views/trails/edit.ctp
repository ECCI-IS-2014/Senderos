<?php echo $html->css('pointscss'); ?>
<?php echo $html->css('menu7'); ?>
<?php echo $html->css('documentscss'); ?>
<?php echo $html->css("slider"); ?>
<?php echo $html->script("draggable"); ?>
<?php echo $html->script("points"); ?>
<?php echo $html->script("slider"); ?>

<?php 

if($edit_trail==1){

$result = '';

$trailcreate = 'no';
$trailread = 'yes';
$trailupdate = 'no';
$traildelete = 'no';

$visitors = $this->requestAction('/visitors/getvisitors');
$languages = $this->requestAction('/languages/getlanguages');

        if($_SESSION['role'] === 'restricted')
        {
            foreach ($restrictions as $restriction):
                if( ($restriction['Station']['id'] == $trail['Station']['id'])
                    && ($restriction['Restriction']['trail_id'] == $trail['Trail']['id'] || $restriction['Restriction']['allt'] == 1)
                )
                {
                    $trailcreate = 'no';
                    $trailread = 'yes';
                    $trailupdate = 'yes';
                    $traildelete = 'yes';

                   // $result .= "<br>Found a restriction on ".$trail['Trail']['id'].": C=".$trailcreate.", R=".$trailread.", U=".$trailupdate.", D=".$traildelete."";

                    if($restriction['Station']['id'] == $trail['Station']['id'] && $restriction['Restriction']['allt'] == 1){
                        $trailcreate = 'yes';
                    }
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

<script> var currdiam = 'none'; var currback = 'none'; var currfont = 'none'; </script>

<div class="actions">
	<ul>

		<li title = "Delete this trail"><?php
		if($traildelete === 'yes')
			echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Trail.id')), null, sprintf(__('Are you sure you want to delete %s?', true), $this->Form->value('Trail.name')));
		/*else
			echo "---";*/
		?></li>
		<li title = "Index for trails"><?php echo $this->Html->link(__('List Trails', true), array('action' => 'index'));?></li>
		<!-- <li><?php echo $this->Html->link(__('List Stations', true), array('controller' => 'stations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Station', true), array('controller' => 'stations', 'action' => 'add')); ?> </li> -->
	</ul>
</div> <!-- actions -->

<div class="infohelp">
    <a href="#" class="tooltip">
        <?php
            echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:right;"));
        ?>
        <span>
            If you edit this trail, you can also add or edit the points and documents associated to this trail.
        </span>
    </a>
</div>

<div class="trails form" style="width:55%">
<?php echo $this->Form->create('Trail', array('type' => 'file'));?>
	<fieldset>
		<legend><?php __('Edit Trail'); ?></legend>
    



        <?php
        	echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('name', array('style' => 'width:50%'));
		echo $this->Form->input('description', array('style' => 'width:50%'));
		echo $this->Form->input('station_id');
        	echo $this->Form->input('archivo', array('type' => 'file', 'label'=>'Select a map image:', "onchange" => "previewMap();"));
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
		<div id="borderBox" style="position:relative;border:1px solid black;width:800px;height:700px;overflow:hidden;">

		<!-- map div -->
		<div id="mapLayer" style="width:800px;height:700px;top:0px;left:0px;position:absolute;cursor: default; background-image: url('/senderos/app/webroot/img/<?php echo $trail['Trail']['image']; ?>'); background-size: 800px 700px;" ></div><!-- /map div -->

		<!-- points layer -->
		<div id="pointsLayer" style="position: absolute;height: 700px;width: 100%; background-size: 800px 700px;pointer-events: none;">
		

		<?php foreach ($trail['Point'] as $point): ?>

			<!-- point_ -->
			<div id="point_<?php echo $point['id']; ?>" class="point" style="position: absolute;top: <?php echo $point['px_y']; ?>px; left: <?php echo $point['px_x']; ?>px; pointer-events: all; cursor: pointer; <?php echo $point['style']; ?>" onmouseover="point_action(<?php echo $point['id']; ?>,event); setcurrent('point_<?php echo $point['id']; ?>_style');"><?php echo $point['pnumber']; ?></div><!-- /point_ -->

			<input type="hidden" id="point_<?php echo $point['id']; ?>_id" value="<?php echo $point['id']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_pnumber" value="<?php echo $point['pnumber']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_name" value="<?php echo $point['name']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_cordx" value="<?php echo $point['cordx']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_cordy" value="<?php echo $point['cordy']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_description" value="<?php echo $point['description']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_trail_id" value="<?php echo $point['trail_id']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_px_x" value="<?php echo $point['px_x']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_px_y" value="<?php echo $point['px_y']; ?>"/>
			<input type="hidden" id="point_<?php echo $point['id']; ?>_style" value="<?php echo $point['style']; ?>"/>
			
			<!-- labels -->
			<!-- <div id="label_<?php echo $point['id']; ?>" class="pointlabel" style="position: absolute;top: <?php echo ($point['px_y']-5); ?>px; left: <?php if(($point['pnumber'] * 1) < 10) echo ($point['px_x']-15); else echo ($point['px_x']-25); ?>px; pointer-events: none;"><?php echo $point['pnumber']; ?></div><!-- /labels -->

			<?php
				echo "<script type='text/javascript'>";
				echo "var newpoint = document.getElementById('point_".$point['id']."');";
				echo "newpoint.addEventListener('contextmenu', function(evt) {evt.preventDefault();}, false);";
				echo "var mover = function (event) {point_action(".$point['id'].",event);  document.getElementById('popupcontent').scrollTop = 0; };";
				echo "var stopper = function (event) {};";
				echo "newpoint.addEventListener('mouseup', mover, false);";
				echo "newpoint.addEventListener('mouseover', mover, false);";
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
		//window.addEventListener("contextmenu", function(e) { e.preventDefault(); });
		document.getElementById("mapLayer").oncontextmenu = function() {
		     return false;  
		} 
		document.getElementById("pointsLayer").oncontextmenu = function() {
		     return false;  
		} 
	</script>
	
	
	<?php 
	}

    if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
        echo $this->Form->end(__('Submit', true));
        echo "<input type='submit' id='hiddencancel' value='Cancel' onclick=\"window.location.href = window.history.back(1);\" style='border: 0px solid #2D6324; padding: 4px 8px;display:inline;float:right;'/>";
    ?>
	</fieldset>
<script>
document.getElementsByClassName('submit')[0].appendChild(document.getElementById('hiddencancel'));
document.getElementById('hiddencancel').style.display ='block';
</script>
	

</div>


<script type="text/javascript">

function hide2(div)
{
	document.getElementById('popDiv').scrollTop = 0;
	document.getElementById('popup').scrollTop = 0;
	document.getElementById('popupcontent').scrollTop = 0;
	document.getElementById(div).style.display = 'none';
}

</script>



<div id="popDiv" class="ontop">
	<div id="popup">
		<a style="cursor: pointer;" onClick="hide2('popDiv');">Close</a>
		<div id="popupcontent" >
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


<script>

function validateCoords(textinput)
{
	var newchar = textinput.value[textinput.value.length - 1];

	if(undefined != newchar)
	{
		if(isNaN(newchar))
			textinput.value = textinput.value.substring(0, textinput.value.length-1);

		if(newchar == '-' && textinput.value.length == 0)
		{
			textinput.value = '-' + textinput.value;
			//textinput.value = textinput.value.replace(/-/g,'');
		}
		if(newchar == '.')
		{
			if(textinput.value.split(newchar).length == 1 && textinput.value.length > 1)
				textinput.value = textinput.value + '.';
		}
	}
	
}

</script>


<div id="save_point" style="display:none">
	<div class="points form" style="position: absolute; left:25%">
		<?php echo $this->Form->create('Point');?>
			<fieldset>
				<legend><?php __('Save Point'); ?></legend>
			<?php
				echo $this->Form->input('pnumber',  array("onkeyup" => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"));
				echo $this->Form->input('name');
				echo $this->Form->input('cordx', array("onkeyup" => "validateCoords(this)"));
				echo $this->Form->input('cordy', array("onkeyup" => "validateCoords(this)"));
				echo $this->Form->input('description');
				//echo $this->Form->input('trail_id',array('value' => 'hidden'));
				echo "<div class='input text required'>\n
	    				
	    				<input id='PointTrailId' type='hidden' value='".$trail['Trail']['id']."' maxlength='100' name='data[Point][trail_id]'></input>\n
					</div>\n";
				echo $this->Form->input('px_x',array('type' => 'hidden'));
				echo $this->Form->input('px_y',array('type' => 'hidden'));

				echo $this->Form->input('style',array('type' => 'hidden'));

			?>

		
<script>

	function setcurrent(point_style)
	{
		point_style = document.getElementById(point_style).value.split(';');

		currdiam = point_style[1].split(':')[1];
		currdiam = currdiam.replace('px','');
		currdiam = currdiam.replace(' ','');
		currback = point_style[2].split(':')[1];
		currback = currback.replace(' ','');
		currfont = point_style[3].split(':')[1];
		currfont = currfont.replace(' ','');

		//setselects();
		scroll_top();

	}

	function setselects(select)
	{
		if(select == 1)
		{
			//document.getElementById('diameter').value = currdiam;
			//diameter = "width: "+currdiam+"px; height: "+currdiam+"px;";
			currdiam = document.getElementById('diameter').value;
			background= "background-color: "+currback+";";
			font= "color: "+currfont+";";
		}
		if(select == 2)
		{
			//document.getElementById('background').value = currdiam;
			diameter = "width: "+currdiam+"px; height: "+currdiam+"px;";
			currback = document.getElementById('background').value;
			font= "color: "+currfont+";";
		}
		if(select == 3)
		{
			//document.getElementById('font').value = currdiam;
			diameter = "width: "+currdiam+"px; height: "+currdiam+"px;";
			background= "background-color: "+currback+";";
			currfont = document.getElementById('font').value;
		}

		document.getElementById('PointStyle').value = diameter+background+font+centerit;
	}


	

</script>

	

			<div style="text-align:left;">Style:
			<div id="pointstyling" >
				<div id="thepoint" class="point" >#
				</div> <!-- the point -->
				<div id="stylechooser" >
					Diameter:<br>
					<select id='diameter' onchange="stylepoint(this, 'diameter'); setselects(1);">
						<option value='25' selected disabled>Choose diameter</option>
						<option value='10'>10</option>
						<option value='15'>15</option>
						<option value='20'>20</option>
						<option value='25'>25</option>
						<option value='30'>30</option>
						<option value='35'>35</option>
						<option value='40'>40</option>
						<option value='45'>45</option>
						<option value='50'>50</option>
					</select><br>


					Background color:<br>
					<select id='background' onchange="stylepoint(this, 'background'); setselects(2);">
						<option value='green' selected disabled>Choose background</option>
						<option value='green'>Green</option>
						<option value='blue'>Blue</option>
						<option value='violet'>Violet</option>
						<option value='red'>Red</option>
						<option value='pink'>Pink</option>
						<option value='white'>White</option>
						<option value='gray'>Gray</option>
						<option value='black'>Black</option>
						<option value='yellow'>Yellow</option>
						<option value='orange'>Orange</option>
						<option value='brown'>Brown</option>
					</select><br>
					Font color:<br>
					<select id='font' onchange="stylepoint(this, 'font');  setselects(3);">
						<option value='white' selected disabled>Choose font color</option>
						<option value='green'>Green</option>
						<option value='blue'>Blue</option>
						<option value='violet'>Violet</option>
						<option value='red'>Red</option>
						<option value='pink'>Pink</option>
						<option value='white'>White</option>
						<option value='gray'>Gray</option>
						<option value='black'>Black</option>
						<option value='yellow'>Yellow</option>
						<option value='orange'>Orange</option>
						<option value='brown'>Brown</option>
					</select>
				</div> <!-- stylechooser -->
			</div> <!-- point styling -->
			</div>

			<?php if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted'){ ?>
			    <input id="savePoint" type="submit" value="Submit" style="width:auto;float:left;border: 0px solid #2D6324; padding: 4px 8px;"></input>
			    <input type="submit" id="hiddencancel" value="Cancel" onclick=\"window.location.href = window.history.back(1);\" style="width:auto;border: 0px solid #2D6324; padding: 4px 8px;display:inline;"/>
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
	<div class="documents form" style="position: absolute; left:15%; width: 70%;">
		<form action="/senderos/documents/add" id="DocumentAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div style="display:none;">
				<input name="_method" value="POST" type="hidden">
			</div>
				
			<fieldset id="formulario_interno">
				<legend><?php __('Save File'); ?></legend>
				<input name="data[Point][id]" id="PointId" type="hidden">
				<input name="data[Document][id]" id="DocumentId" type="hidden">
				<div id="choosename" style="text-align:left;">
					<label for="DocumentName">Name</label>
					<input name="data[Document][name]" maxlength="100" id="DocumentName" type="text" style="width: 70%;">
				</div>
				<div id="choosedescription" style="text-align:left;">
				<label for="DocumentDescription">Description</label>
				<input name="data[Document][description]" maxlength="500" id="DocumentDescription" type="text" style="width: 70%;">
				</div>
				<div style="text-align:left;">
					<label for="DocumentType">Type</label><br>
					<select name="data[Document][type]" id="DocumentType" onchange="displayEditor(this);">
						<option value="images">Image</option>
						<option value="video">Video</option>
						<option value="sound">Sound</option>
						<option value="text">Text</option>
					</select>
				</div>
				
				<textarea name="data[Document][htmltext]" id="DocumentHtmltext" style="display:none;"></textarea>

				<div id="editartexto" style="height: auto; margin-bottom: 0;">
				</div><!-- editartexto -->

				<div id="rendereditartexto" style="height: 0px; overflow:hidden; line-height: 0; margin-bottom: 0; visibility: hidden;">
				<div id="editorcontainer" style="background-color: transparent;margin:0; padding:0; width:100%; height: 500px;">
					<iframe id="iframeditor" name="iframeditor" width="100%" height="100%" src="/senderos/app/webroot/files/ckeditor.html" frameBorder="0">
					</iframe>
				</div><!-- editorcontainer -->
				</div><!-- rendereditartexto-->



				<div id="choosefile" style="text-align:left;">
				<label for="DocumentRoute">Select a file:</label><br>
				<input name="data[Document][archivo]" id="DocumentArchivo" type="file" accept="image/*, video/*, audio/*, application/pdf">
				</div>

<!-- <select name="data[Document][languages]" id="DocumentLanguages"> -->

<!-- <select name="data[Document][visitors]" id="DocumentVisitors"> -->

				<?php
				echo "<div style='text-align:left;padding:0; margin:0;'>Visitors:</div><div style='height: 60px; overflow-x: hidden; overflow-y: scroll;width: 70%;'>"; //visitors div

				$availability = ";";

				echo "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
				foreach($visitors as $visitor):
					echo "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$visitor['Visitor']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentVisitors');\"";

					echo ">".$visitor['Visitor']['role']."</td></tr>";
				endforeach;
				echo "</table>";

				echo "<input name='data[Document][visitors]' id='DocumentVisitors' type='hidden' value='".$availability."'>";

				echo "</div>"; //end visitors div


				echo "<div style='text-align:left;padding:0; margin:0;'>Languages:</div><div style='height: 60px; overflow-x: hidden; overflow-y: scroll;width: 70%;'>"; //languages div

				$availability = ";";

				echo "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
				foreach($languages as $language):
					echo "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$language['Language']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentLanguages');\"";

					echo ">".$language['Language']['name']."</td></tr>";
				endforeach;
				echo "</table>";

				echo "<input name='data[Document][languages]' id='DocumentLanguages' type='hidden' value='".$availability."'>";

				echo "</div>"; //end languages div

				?>


				<!--<input type="button" onclick="alert(document.getElementById('DocumentVisitors').value);" />-->

				
				<?php if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted'){ ?>
				<table style="background-color: transparent; border:none;"><tr>
					<td style="background-color: transparent; border:none;">
							<input type="submit" value="Submit" onclick="saveDocument();" style="width:auto;border: 0px solid #2D6324; padding: 4px 8px;"></input>
					    	<input type="submit" id="hiddencancel" value="Cancel" onclick=\"window.location.href = window.history.back(1);\" style="width:auto;border: 0px solid #2D6324; padding: 4px 8px;display:inline;"/>
					</td>
					<td style="background-color: transparent; border:none;">
						<div id="waitdiv" style="height:50%; width:50%; display:none;">
							<img src="/senderos/app/webroot/css/wait.gif" height="90%" width="100%"/>
							<center>Please wait . . .</center>
						</div>
					</td>				
					</tr></table>
			    <?php } ?>
				
				
			</fieldset>
		</form>
	</div> <!-- documents form -->
</div> <!-- save_document -->



<!--<input type="button" value="Submit" onclick="newPoint()">-->


<?php 

}

?>



<div >

	<?php
	
	echo $result;
	
	?>

</div>

<?php }
else{ ?>

<h2>You're not authorized to view this page</h2>

<?php
}
?>

<!--<script>
	// attach handlers once iframe is loaded
document.getElementById('iframeditor').onload = function() {

	/*var win = document.getElementById('iframeditor').contentWindow;
        win.minimizing(); // call function in iframed document*/
}
</script>-->
