
<?php

//echo $what;

$imagesselect = "<select id='imagesselect' onchange=\"loadFile(this,'image');\" onclick=\"loadFile(this,'image');\"><option disabled selected>Choose image</option>";
$videosselect = "<select id='videosselect' onchange=\"loadFile(this,'video');\" onclick=\"loadFile(this,'video');\"><option disabled selected>Choose video</option>";
$soundsselect = "<select id='soundsselect' onchange=\"loadFile(this,'sound');\" onclick=\"loadFile(this,'sound');\"><option disabled selected>Choose sound</option>";
$textsselect = "<select id='textsselect' onchange=\"loadFile(this,'text');\" onclick=\"loadFile(this,'text');\"><option disabled selected>Choose text</option>";


$imagesbuilder = "";
$videosbuilder = "";
$soundsbuilder = "";
$textsbuilder = "";


$imagescounter = 0;
$videoscounter = 0;
$soundscounter = 0;
$textscounter = 0;

$show = 'no';

$visitors = $this->requestAction('/visitors/getvisitors');
$languages = $this->requestAction('/languages/getlanguages');


foreach($pointdocuments as $pointdocument):

	$show = 'no';

	if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
	{
		$show = 'yes';
		//aqui se pueden hacer los filtros de restringuido	
	}
	else
	{
		$show = 'no';
	}

	if($show === 'yes')
	{

		if($pointdocument['Document']['type'] === 'images') //if an image
		{
			$imagescounter++;
			$imagesselect .= "<option value='".$imagescounter."'>".$pointdocument['Document']['name']."</option>";

			$imagesbuilder .= "<div id='imageitem".$imagescounter."' style='display:none;'>";
			$imagesbuilder .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
			$imagesbuilder .= "<input name='_method' value='POST' type='hidden'/>";

			$imagesbuilder .= "<table>";
			$imagesbuilder .= "<tr>";
			$imagesbuilder .= "<td>"; //cell for file

			$imagesbuilder .= "<img id='img".$pointdocument['Document']['id']."' src='/senderos/app/webroot/images/".$pointdocument['Document']['route']."' /><br>";

			$imagesbuilder .= "<div id='filediv".$pointdocument['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
			$imagesbuilder .= "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
			$imagesbuilder .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file'";
			$imagesbuilder .= " onchange=\"previewFile('".$pointdocument['Document']['id']."','DocumentArchivo".$pointdocument['Document']['id']."')\"";
			$imagesbuilder .= " accept='image/*'";
			$imagesbuilder .= " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";
			$imagesbuilder .= "</div>";

			$imagesbuilder .= "</td>"; // end cell for file
			$imagesbuilder .= "<td style='vertical-align: top'>"; //cell for data

			$imagesbuilder .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
			$imagesbuilder .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
			$imagesbuilder .= "<br>File:<br><input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='text' value='".$pointdocument['Document']['route']."'/><br>";
			$imagesbuilder .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
			
			$imagesbuilder .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";
			$imagesbuilder .= "</td>"; // end cell for data
			$imagesbuilder .= "</tr>";

			$imagesbuilder .= "<tr>";

			$imagesbuilder .= "<td style='vertical-align: top'>";	//cell for visitors
			$imagesbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //visitors div

			$availability = ";";

			$imagesbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($visitors as $visitor):
				$imagesbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$visitor['Visitor']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentVisitors".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/visitors/isavailable/".$visitor['Visitor']['role']."/".$pointdocument['Document']['id']."");
				if($available){
					$imagesbuilder .= " checked";
					$availability .= $visitor['Visitor']['id'].';';
				}

				$imagesbuilder .= ">".$visitor['Visitor']['role']."</td></tr>";
			endforeach;
			$imagesbuilder .= "</table>";

			$imagesbuilder .= "<input name='data[Document][visitors".$pointdocument['Document']['id']."]' id='DocumentVisitors".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$imagesbuilder .= "</div>"; //end visitors div
			$imagesbuilder .= "</td>";	//end cell for visitors

			$imagesbuilder .= "<td style='vertical-align: top'>";	//cell for languages
			$imagesbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //languages div

			$availability = ";";

			$imagesbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($languages as $language):
				$imagesbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$language['Language']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentLanguages".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/languages/isavailable/".$language['Language']['name']."/".$pointdocument['Document']['id']."");
				if($available){
					$imagesbuilder .= " checked";
					$availability .= $language['Language']['id'].';';
				}

				$imagesbuilder .= ">".$language['Language']['name']."</td></tr>";
			endforeach;
			$imagesbuilder .= "</table>";

			$imagesbuilder .= "<input name='data[Document][languages".$pointdocument['Document']['id']."]' id='DocumentLanguages".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$imagesbuilder .= "</div>"; //end languages div
			$imagesbuilder .= "</td>";	//end cell for visitors

			$imagesbuilder .= "</tr>";

			$imagesbuilder .= "</table>";

			$imagesbuilder .= "<center><a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");' title='save changes'>save</a></center>";

			$imagesbuilder .= "</form>";
			$imagesbuilder .= "</div>";
			
		}
		else if($pointdocument['Document']['type'] === 'video') //if a video
		{
			$videoscounter++;
			$videosselect .= "<option value='".$videoscounter."'>".$pointdocument['Document']['name']."</option>";

			$videosbuilder .= "<div id='videoitem".$videoscounter."' style='display:none;'>";
			$videosbuilder .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
			$videosbuilder .= "<input name='_method' value='POST' type='hidden'/>";

			$videosbuilder .= "<table>";
			$videosbuilder .= "<tr>";
			$videosbuilder .= "<td>"; //cell for file

			$videosbuilder .= "<embed id='vid".$pointdocument['Document']['id']."' name='vid".$pointdocument['Document']['id']."' src='/senderos/app/webroot/files/mediaplayer.swf?file=/senderos/app/webroot/video/".$pointdocument['Document']['route']."' allowfullscreen='true' /><br>";

			$videosbuilder .= "<div id='filediv".$pointdocument['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
			$videosbuilder .= "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
			$videosbuilder .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file'";
			$videosbuilder .= " accept='video/*'";
			$videosbuilder .= " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";
			$videosbuilder .= "</div>";

			$videosbuilder .= "</td>"; // end cell for file
			$videosbuilder .= "<td style='vertical-align: top'>"; //cell for data

			$videosbuilder .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
			$videosbuilder .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
			$videosbuilder .= "<br>File:<br><input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='text' value='".$pointdocument['Document']['route']."'/><br>";
			$videosbuilder .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
			
			$videosbuilder .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";
			$videosbuilder .= "</td>"; // end cell for data
			$videosbuilder .= "</tr>";

			$videosbuilder .= "<tr>";

			$videosbuilder .= "<td style='vertical-align: top'>";	//cell for visitors
			$videosbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //visitors div

			$availability = ";";

			$videosbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($visitors as $visitor):
				$videosbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$visitor['Visitor']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentVisitors".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/visitors/isavailable/".$visitor['Visitor']['role']."/".$pointdocument['Document']['id']."");
				if($available){
					$videosbuilder .= " checked";
					$availability .= $visitor['Visitor']['id'].';';
				}

				$videosbuilder .= ">".$visitor['Visitor']['role']."</td></tr>";
			endforeach;
			$videosbuilder .= "</table>";

			$videosbuilder .= "<input name='data[Document][visitors".$pointdocument['Document']['id']."]' id='DocumentVisitors".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$videosbuilder .= "</div>"; //end visitors div
			$videosbuilder .= "</td>";	//end cell for visitors

			$videosbuilder .= "<td style='vertical-align: top'>";	//cell for languages
			$videosbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //languages div

			$availability = ";";

			$videosbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($languages as $language):
				$videosbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$language['Language']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentLanguages".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/languages/isavailable/".$language['Language']['name']."/".$pointdocument['Document']['id']."");
				if($available){
					$videosbuilder .= " checked";
					$availability .= $language['Language']['id'].';';
				}

				$videosbuilder .= ">".$language['Language']['name']."</td></tr>";
			endforeach;
			$videosbuilder .= "</table>";

			$videosbuilder .= "<input name='data[Document][languages".$pointdocument['Document']['id']."]' id='DocumentLanguages".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$videosbuilder .= "</div>"; //end languages div
			$videosbuilder .= "</td>";	//end cell for visitors

			$videosbuilder .= "</tr>";

			$videosbuilder .= "</table>";

			$videosbuilder .= "<center><a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");' title='save changes'>save</a></center>";

			$videosbuilder .= "</form>";
			$videosbuilder .= "</div>";
		}
		else if($pointdocument['Document']['type'] === 'sound') //if a sound
		{
			$soundscounter++;
			$soundsselect .= "<option value='".$soundscounter."'>".$pointdocument['Document']['name']."</option>";

			$soundsbuilder .= "<div id='sounditem".$soundscounter."' style='display:none;'>";
			$soundsbuilder .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
			$soundsbuilder .= "<input name='_method' value='POST' type='hidden'/>";

			$soundsbuilder .= "<table>";
			$soundsbuilder .= "<tr>";
			$soundsbuilder .= "<td>"; //cell for file

			$soundsbuilder .= "<object id='snd".$pointdocument['Document']['id']."' name='snd".$pointdocument['Document']['id']."'";
			$soundsbuilder .= " data='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' >";
			$soundsbuilder .= "<param name='src' value='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."'/>";
			$soundsbuilder .= "<PARAM NAME='autoplay' VALUE='false' />";
			$soundsbuilder .= "<EMBED id='snd".$pointdocument['Document']['id']."' name='snd".$pointdocument['Document']['id']."' SRC='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' AUTOPLAY='false'></EMBED>";
			$soundsbuilder .= "</object><br>";

			$soundsbuilder .= "<div id='filediv".$pointdocument['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
			$soundsbuilder .= "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
			$soundsbuilder .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file'";
			$soundsbuilder .= " accept='audio/*'";
			$soundsbuilder .= " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";
			$soundsbuilder .= "</div>";

			$soundsbuilder .= "</td>"; // end cell for file
			$soundsbuilder .= "<td style='vertical-align: top'>"; //cell for data

			$soundsbuilder .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
			$soundsbuilder .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
			$soundsbuilder .= "<br>File:<br><input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='text' value='".$pointdocument['Document']['route']."'/><br>";
			$soundsbuilder .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
			
			$soundsbuilder .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";
			$soundsbuilder .= "</td>"; // end cell for data
			$soundsbuilder .= "</tr>";

			$soundsbuilder .= "<tr>";

			$soundsbuilder .= "<td style='vertical-align: top'>";	//cell for visitors
			$soundsbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //visitors div

			$availability = ";";

			$soundsbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($visitors as $visitor):
				$soundsbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$visitor['Visitor']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentVisitors".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/visitors/isavailable/".$visitor['Visitor']['role']."/".$pointdocument['Document']['id']."");
				if($available){
					$soundsbuilder .= " checked";
					$availability .= $visitor['Visitor']['id'].';';
				}

				$soundsbuilder .= ">".$visitor['Visitor']['role']."</td></tr>";
			endforeach;
			$soundsbuilder .= "</table>";

			$soundsbuilder .= "<input name='data[Document][visitors".$pointdocument['Document']['id']."]' id='DocumentVisitors".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$soundsbuilder .= "</div>"; //end visitors div
			$soundsbuilder .= "</td>";	//end cell for visitors

			$soundsbuilder .= "<td style='vertical-align: top'>";	//cell for languages
			$soundsbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //languages div

			$availability = ";";

			$soundsbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($languages as $language):
				$soundsbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$language['Language']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentLanguages".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/languages/isavailable/".$language['Language']['name']."/".$pointdocument['Document']['id']."");
				if($available){
					$soundsbuilder .= " checked";
					$availability .= $language['Language']['id'].';';
				}

				$soundsbuilder .= ">".$language['Language']['name']."</td></tr>";
			endforeach;
			$soundsbuilder .= "</table>";

			$soundsbuilder .= "<input name='data[Document][languages".$pointdocument['Document']['id']."]' id='DocumentLanguages".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$soundsbuilder .= "</div>"; //end languages div
			$soundsbuilder .= "</td>";	//end cell for visitors

			$soundsbuilder .= "</tr>";

			$soundsbuilder .= "</table>";

			$soundsbuilder .= "<center><a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");' title='save changes'>save</a></center>";

			$soundsbuilder .= "</form>";
			$soundsbuilder .= "</div>";
		}
		else if($pointdocument['Document']['type'] === 'text') //if a text
		{
			$textscounter++;
			$textsselect .= "<option value='".$textscounter."'>".$pointdocument['Document']['name']."</option>";

			$textsbuilder .= "<div id='textitem".$textscounter."' style='display:none;'>";
			$textsbuilder .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
			$textsbuilder .= "<input name='_method' value='POST' type='hidden'/>";

			$textsbuilder .= "<table>";
			$textsbuilder .= "<tr>";
			$textsbuilder .= "<td>"; //cell for file

			//$textsbuilder .= "<div id='txt".$pointdocument['Document']['id']."'>".$pointdocument['Document']['htmltext']."</div><br>";
			$textsbuilder .= "<div id='editorcontainer' style='background-color: transparent;margin:0; padding:0; width:100%; height: 500px;'>";
			$textsbuilder .= "<iframe id='iframeditor' name='iframeditor' width='100%' height='100%' src='/senderos/app/webroot/files/ckeditor.html' frameBorder='0'>";
			$textsbuilder .= "</iframe>";
			$textsbuilder .= "</div><!-- editorcontainer -->";

			//fake div
			$textsbuilder .= "<div style='display: none;'>";
			$textsbuilder .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file' style='visibilty:hidden;' />";
			$textsbuilder .= "</div>";//end efake div
			$textsbuilder .= "</td>"; // end cell for file

			$textsbuilder .= "<td style='vertical-align: top'>"; //cell for data

			$textsbuilder .= "<textarea name='data[Document][htmltext]' id='DocumentHtmltext' style='display:none;'>".$pointdocument['Document']['htmltext']."</textarea>";

			$textsbuilder .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
			$textsbuilder .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
			$textsbuilder .= "<input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='hidden' value='".$pointdocument['Document']['route']."'/><br>";

			$textsbuilder .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
			
			$textsbuilder .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";
			$textsbuilder .= "</td>"; // end cell for data
			$textsbuilder .= "</tr>";

			$textsbuilder .= "<tr>";

			$textsbuilder .= "<td style='vertical-align: top'>";	//cell for visitors
			$textsbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //visitors div

			$availability = ";";

			$textsbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($visitors as $visitor):
				$textsbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$visitor['Visitor']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentVisitors".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/visitors/isavailable/".$visitor['Visitor']['role']."/".$pointdocument['Document']['id']."");
				if($available){
					$textsbuilder .= " checked";
					$availability .= $visitor['Visitor']['id'].';';
				}

				$textsbuilder .= ">".$visitor['Visitor']['role']."</td></tr>";
			endforeach;
			$textsbuilder .= "</table>";

			$textsbuilder .= "<input name='data[Document][visitors".$pointdocument['Document']['id']."]' id='DocumentVisitors".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$textsbuilder .= "</div>"; //end visitors div
			$textsbuilder .= "</td>";	//end cell for visitors

			$textsbuilder .= "<td style='vertical-align: top'>";	//cell for languages
			$textsbuilder .= "<div style='height: 60px; overflow-x: hidden; overflow-y: scroll;'>"; //languages div

			$availability = ";";

			$textsbuilder .= "<table style='height:initial; background-color:initial; margin:0; padding: 0;'>";
			foreach($languages as $language):
				$textsbuilder .= "<tr><td style='height:initial; background-color:initial; margin:0; padding: 0;'><input type=\"checkbox\" value=\"".$language['Language']['id']."\" onclick=\"AddVisitor(this.checked, this.value, 'DocumentLanguages".$pointdocument['Document']['id']."');\"";

				$available = $this->requestAction("/languages/isavailable/".$language['Language']['name']."/".$pointdocument['Document']['id']."");
				if($available){
					$textsbuilder .= " checked";
					$availability .= $language['Language']['id'].';';
				}

				$textsbuilder .= ">".$language['Language']['name']."</td></tr>";
			endforeach;
			$textsbuilder .= "</table>";

			$textsbuilder .= "<input name='data[Document][languages".$pointdocument['Document']['id']."]' id='DocumentLanguages".$pointdocument['Document']['id']."' type='hidden' value='".$availability."'>";

			$textsbuilder .= "</div>"; //end languages div
			$textsbuilder .= "</td>";	//end cell for visitors

			$textsbuilder .= "</tr>";

			$textsbuilder .= "</table>";

			$textsbuilder .= "<center><a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");' title='save changes'>save</a></center>";

			$textsbuilder .= "</form>";
			$textsbuilder .= "</div>";
		}
		else
		{
		}
	}
endforeach; // foreach document

$imagesselect .= "</select><div id='imagescount' style='display: none;'>".$imagescounter."</div>";
$videosselect .= "</select><div id='videoscount' style='display: none;'>".$videoscounter."</div>";
$soundsselect .= "</select><div id='soundscount' style='display: none;'>".$soundscounter."</div>";
$textsselect .= "</select><div id='textscount' style='display: none;'>".$textscounter."</div>";

?>


<div id="point_documents" style="padding-left: 50px;">

<table>
<tr><!-- header-->
<?php 

if($imagescounter>0) echo '<td>'.$imagesselect."</td>";
if($videoscounter>0) echo '<td>'.$videosselect."</td>";
if($soundscounter>0) echo '<td>'.$soundsselect."</td>";
if($textscounter>0) echo '<td>'.$textsselect."</td>";
?>

</tr></table><!-- end header -->

<div id="thefile" class="imageitem2">
</div>

</div> <!-- point_documents -->


<?php

$empty = true;

if($imagescounter>0) {echo $imagesbuilder; $empty = false;}
if($videoscounter>0) {echo $videosbuilder; $empty = false;}
if($soundscounter>0) {echo $soundsbuilder; $empty = false;}
if($textscounter>0) {echo $textsbuilder; $empty = false;}

if($empty) echo "<center>You have not added files to this point ... <br><a onclick=\"displaySaveDocumentForm(".$point_id.");\" style=\"cursor:pointer\">Add a new file</a></center>";

?>

