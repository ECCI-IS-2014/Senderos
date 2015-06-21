<?php echo $html->css('pointscss'); ?>
<?php echo $html->css('menu7'); ?>
<?php echo $html->css('documentscss'); ?>
<?php echo $html->css("slider"); ?>
<?php echo $html->script("draggable"); ?>
<?php echo $html->script("points"); ?>
<?php echo $html->script("slider"); ?>

<?php
$visitors = $this->requestAction('/visitors/getvisitors');
$languages = $this->requestAction('/languages/getlanguages');
?>


<div id="save_document" style="display:block; padding-left:25%;">
	<div class="documents form" style="width: 50%;">
		<form action="/senderos/documents/add" id="DocumentAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			<div style="display:none;">
				<input name="_method" value="POST" type="hidden">
			</div>
				
			<fieldset id="formulario_interno">
				<legend><?php __('Save File'); ?></legend>
				<input name="data[Point][id]" id="PointId" type="hidden">
				<input name="data[Document][id]" id="DocumentId" type="hidden" value="<?php echo $this->data['Document']['id']; ?>">
				<div id="choosename" style="text-align:left;">
					<label for="DocumentName">Name</label>
					<input name="data[Document][name]" maxlength="100" id="DocumentName" type="text" style="width: 70%;" value="<?php echo $this->data['Document']['name']; ?>">
				</div>
				<div id="choosedescription" style="text-align:left;">
				<label for="DocumentDescription">Description</label>
				<input name="data[Document][description]" maxlength="500" id="DocumentDescription" type="text" style="width: 70%;"  value="<?php echo $this->data['Document']['description']; ?>">
				</div>


				<input name="data[Document][type]" maxlength="100" id="DocumentType" type="hidden" style="width: 90%;" value="<?php echo $this->data['Document']['type']; ?>">
				
				<textarea name="data[Document][htmltext]" id="DocumentHtmltext" style="display:none;"><?php echo $this->data['Document']['htmltext']; ?></textarea>


				<?php
				if($this->data['Document']['type'] === 'text')
				{
					echo "<div id='editorcontainer' style='background-color: transparent;margin:0; padding:0; width:100%; height: 500px;'>";
					echo "<iframe id='iframeditor' name='iframeditor' width='100%' height='100%' src='/senderos/app/webroot/files/ckeditor.html' frameBorder='0'>";
					echo "</iframe>";
					echo "</div><!-- editorcontainer -->";

			//fake div
					echo "<div style='display: none;'>";
					echo "<input name='data[Document][archivo]' id='DocumentArchivo".$this->data['Document']['id']."' type='file' style='visibilty:hidden;' />";
					echo "</div>";//end efake div
				}
				else
				{

				if($this->data['Document']['type'] === 'images')
				{
					echo "<img id='img".$this->data['Document']['id']."' src='/senderos/app/webroot/images/".$this->data['Document']['route']."' width='200px' height='150px' /><br>";
				}
				if($this->data['Document']['type'] === 'video')
				{
					echo "<embed id='vid".$this->data['Document']['id']."' name='vid".$this->data['Document']['id']."' src='/senderos/app/webroot/files/mediaplayer.swf?file=/senderos/app/webroot/video/".$this->data['Document']['route']."' allowfullscreen='true' width='200px' height='150px' /><br>";

				}
				if($this->data['Document']['type'] === 'sound')
				{
					echo "<object id='snd".$this->data['Document']['id']."' name='snd".$this->data['Document']['id']."'";
					echo " data='/senderos/app/webroot/sound/".$this->data['Document']['route']."' width='200px' height='150px' >";
					echo "<param name='src' value='/senderos/app/webroot/sound/".$this->data['Document']['route']."'/>";
					echo "<PARAM NAME='autoplay' VALUE='false' />";
					echo "<EMBED id='snd".$this->data['Document']['id']."' name='snd".$this->data['Document']['id']."' SRC='/senderos/app/webroot/sound/".$this->data['Document']['route']."' AUTOPLAY='false' width='200px' height='150px' ></EMBED>";
					echo "</object><br>";
				}

				echo "<div id='filediv".$this->data['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
				echo "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
				echo "<input name='data[Document][archivo]' id='DocumentArchivo".$this->data['Document']['id']."' type='file'";
				echo " onchange=\"previewimage('img".$this->data['Document']['id']."','DocumentArchivo".$this->data['Document']['id']."')\"";
				//echo " accept='image/*'";
				echo " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";
				echo "</div>";

				}
				?>

				<?php
				echo "<div style='text-align:left;padding:0; margin:0;'>Visitors:</div><div style='height: 60px; overflow-x: hidden; overflow-y: scroll;width: 70%;'>"; //visitors div

				$availability = ";";

				echo "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
				foreach($visitors as $visitor):
					echo "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$visitor['Visitor']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentVisitors');\"";

					$available = $this->requestAction("/visitors/isavailable/".$visitor['Visitor']['role']."/".$this->data['Document']['id']."");

					if($available){
						echo " checked";
						$availability .= $visitor['Visitor']['id'].';';
					}

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

					$available = $this->requestAction("/languages/isavailable/".$language['Language']['name']."/".$this->data['Document']['id']."");
					if($available){
						echo " checked";
						$availability .= $language['Language']['id'].';';
					}

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
						<div class="submit">
							<input type="button" value="Submit" onclick="editThis();" style="font size: 110%; width: auto; min-width: 0px; border: 1px solid #2D6324; border-radius: 8px; text-decoration: none; font-weight: normal; padding: 4px 8px; background: #62AF56 -moz-linear-gradient(center top , #A8EA9C, #62AF56) repeat scroll 0% 0%; color: #000; text-shadow: 0px 1px 0px #8CEE7C; cursor: pointer;"></input>
					    	</div>
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
			<!-- <div id="submit_button">
				<div class="submit">
					<input value="Submit" type="submit">
				</div>
			</div> -->
		</form>
	</div> <!-- documents form -->
</div> <!-- save_document -->



<script>

function previewimage(img, inputfile) {

	var preview = document.getElementById(img);

	if(preview != null)
	{
		var file    = document.getElementById(inputfile).files[0];

		var reader  = new FileReader();

		reader.onloadend = function () {
			preview.src = reader.result;
		}

		if (file) {
			reader.readAsDataURL(file);
		} else {
			preview.src = "";
		}
	}

}

function editThis()
{
	document.getElementById('waitdiv').style.display = 'block';

	if(window.XMLHttpRequest)
		ajax = new XMLHttpRequest()
	else
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	
	ajax.open("POST","/senderos/points/editfile/"+document.getElementById('PointId').value+"",true);
	//ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	ajax.onreadystatechange=function(){
		if(ajax.readyState==4)
		{
			alert(ajax.responseText);

			window.location = "/senderos/documents";

			ret=false;
		}
	}
	
	ajax.send(new FormData(document.getElementById("DocumentAddForm")));
}


//setcurrent('PointStyle');

</script>



<script>

document.getElementById('iframeditor').onload = function() {
	//alert(document.getElementById('DocumentHtmltext').value);
	var win = document.getElementById('iframeditor').contentWindow;
	win.editme(document.getElementById('DocumentHtmltext').value); // call function in iframed document
}


</script>

<?php

?>
