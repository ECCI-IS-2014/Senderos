<?php
//echo $what."holis";

/****** IMAGENES */

$imagesdiv = "<div id='imagesdiv' class='filediv' ";
if($what==='all' or $what==='images')
	$imagesdiv .= "style='display:block;'";
else
	$imagesdiv .= "style='display:none;'";
$imagesdiv .= "><div id='imagesheader' class='fileheader'><h1>IMAGES</h1></div>";

/****** VIDEOS */

$videosdiv = "<div id='videosdiv' class='filediv' ";
if($what==='all' or $what==='videos')
	$videosdiv .= "style='display:block;'";
else
	$videosdiv .= "style='display:none;'";
$videosdiv .= "><div id='videosheader' class='fileheader'><h1>VIDEOS</h1></div>";

/****** SONIDOS */

$soundsdiv = "<div id='soundsdiv' class='filediv' ";
if($what==='all' or $what==='sounds')
	$soundsdiv .= "style='display:block;'";
else
	$soundsdiv .= "style='display:none;'";
$soundsdiv .= "><div id='soundsheader' class='fileheader'><h1>SOUNDS</h1></div>";

/****** TEXTOS */

$textsdiv = "<div id='textsdiv' class='filediv' ";
if($what==='all' or $what==='texts')
	$textsdiv .= "style='display:block;'";
else
	$textsdiv .= "style='display:none;'";
$textsdiv .= "><div id='textsheader' class='fileheader'><h1>TEXTS</h1></div>";

/****** OTROS */

$othersdiv = "<div id='othersdiv' class='filediv' ";
if($what==='all' or $what==='others')
	$othersdiv .= "style='display:block;'";
else
	$othersdiv .= "style='display:none;'";
$othersdiv .= "><div id='othersheader' class='fileheader'><h1>OTHER</h1></div>";

$imagescounter = 0;
$videoscounter = 0;
$soundscounter = 0;
$textscounter = 0;
$otherscounter = 0;

$show = 'no';

foreach($pointdocuments as $pointdocument):

// SE VERIFICA SI EL USUARIO O VISITANTE TIENE PERMISO DE VER LOS DOCUMENTOS

if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
{
	$show = 'yes';
}
else if($_SESSION['role'] !== "administrator" || $_SESSION['role'] !== 'restricted')
{
	foreach ($visitors as $visitor):
		if($visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
		//if(($visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])&&($visitor['Visitor']['role'] == $_SESSION['role']))
		{
			$show = 'yes';
			break;
		}
	endforeach;
}
else
{
}

// SE MUESTRAN LOS DOCUMENTOS

if($show === 'yes')
{
	if($pointdocument['Document']['type'] === 'images') //if an image
	{
	    if($pointdocument['Document']['language_id'] === $_SESSION['language'])
	    {
            $imagescounter++;

            $imagesdiv .= "<center><div id='imageitem".$imagescounter."'";

            if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
                $imagesdiv .= " class='imageitem1'";
            else
                $imagesdiv .= " class='imageitem2'";

            if($imagescounter==1)
                $imagesdiv .= " style='display:block;'";
            else
                $imagesdiv .= " style='display:none;'";

            $imagesdiv .= ">"; //imageitemdiv

            $imagesdiv .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
            $imagesdiv .= "<input name='_method' value='POST' type='hidden'/>";

            $imagesdiv .= "<table><tr>";
            $imagesdiv .= "<td class='middle'><input type='button' value='<<' onclick='back(".$imagescounter.",2);' title='previous'/></td>";
            $imagesdiv .= "<td class='desc'>";
            $imagesdiv .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
            $imagesdiv .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
            $imagesdiv .= "<br>File:<br><input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='text' value='".$pointdocument['Document']['route']."'/><br>";
            //$imagesdiv .= "<br>Language:<br><input name='data[Document][language_id]' id='DocumentLanguage' type='text' value='".$pointdocument['Document']['language_id']."'/><br>";
            $imagesdiv .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
            $imagesdiv .= "</td>";//td desc

            $imagesdiv .= "<td class='filecont'>";
            $imagesdiv .= "<img id='img".$pointdocument['Document']['id']."' src='/senderos/app/webroot/images/".$pointdocument['Document']['route']."'";
            $imagesdiv .= " style='cursor:pointer;'/><br>";
            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $imagesdiv .= "<div id='filediv".$pointdocument['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
                $imagesdiv .= "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
                $imagesdiv .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file'";
                $imagesdiv .= " onchange=\"previewFile('".$pointdocument['Document']['id']."','DocumentArchivo".$pointdocument['Document']['id']."')\"";
                $imagesdiv .= " accept='image/*, video/*, audio/*, application/pdf'";
                $imagesdiv .= " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";//file
                $imagesdiv .= "</div>"; //div filediv???
            }
            $imagesdiv .= "</td>"; //td img

            $imagesdiv .= "<td class='middle'><input type='button' value='>>' onclick='forward(".$imagescounter.",2);' title='next'/></td>";

            $imagesdiv .= "</tr>";

            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $imagesdiv .= "<tr><td colspan=4><div id=\"choosevisitors\" style=\"text-align:left;\">";
                //$imagesdiv .= "<input type=\"hidden\" id=\"DocumentVisitors\" name=\"data[Document][visitors]\" value=\";\"/>";
                $imagesdiv .= "Available for:<br>";

                $availability = ";";

                $imagesdiv .= "<input type=\"checkbox\" value=\"Student\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Student' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $imagesdiv .= " checked";
                        $availability .= "Student;";
                        break;
                    }
                endforeach;
                $imagesdiv .= ">Student<br>";

                $imagesdiv .= "<input type=\"checkbox\" value=\"Professor\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Professor' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $imagesdiv .= " checked";
                        $availability .= "Professor;";
                        break;
                    }
                endforeach;
                $imagesdiv .= ">Professor<br>";
                $imagesdiv .= "<input type=\"checkbox\" value=\"Researcher\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Researcher' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $imagesdiv .= " checked";
                        $availability .= "Researcher;";
                        break;
                    }
                endforeach;
                $imagesdiv .= ">Researcher<br>";
                $imagesdiv .= "<input type=\"checkbox\" value=\"History\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'History' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $imagesdiv .= " checked";
                        $availability .= "History;";
                        break;
                    }
                endforeach;
                $imagesdiv .= ">History<br>";

                $imagesdiv .= "<input type=\"hidden\" id=\"D_".$pointdocument['Document']['id']."\" name=\"data[Document][visitors]\" value=\"".$availability."\"/>";

                $imagesdiv .= "</div> </td></tr><!-- choosevisitors -->";

                $imagesdiv .= "<tr><td colspan=3 style='text-align:right;' title='Save the current document'>";
                $imagesdiv .= "<a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");'>save</a>";
                $imagesdiv .= "</td></tr>";
            }

            $imagesdiv .= "</table>";


            $imagesdiv .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";

            $imagesdiv .= "</form>";

            $imagesdiv .= "</div></center>"; //imageitemdiv
		}
	}
	else if($pointdocument['Document']['type'] === 'video') //if a video
	{
            if($pointdocument['Document']['language_id'] === $_SESSION['language'])
            {
            $videoscounter++;

            $videosdiv .= "<center><div id='videoitem".$videoscounter."'";

            if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
                $videosdiv .= " class='imageitem1'";
            else
                $videosdiv .= " class='imageitem2'";

            if($videoscounter==1)
                $videosdiv .= " style='display:block;'";
            else
                $videosdiv .= " style='display:none;'";

            $videosdiv .= ">"; //videoitemdiv

            $videosdiv .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
            $videosdiv .= "<input name='_method' value='POST' type='hidden'/>";

            $videosdiv .= "<table><tr>";
            $videosdiv .= "<td class='middle'><input type='button' value='<<' onclick='back(".$videoscounter.",0);' title='previous'/></td>";
            $videosdiv .= "<td class='desc'>";
            $videosdiv .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
            $videosdiv .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
            $videosdiv .= "<br>File:<br><input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='text' value='".$pointdocument['Document']['route']."'/><br>";
            //$videosdiv .= "<br>Language:<br><input name='data[Document][language]' id='DocumentLanguage' type='text' value='".$pointdocument['Document']['language']."'/><br>";
            $videosdiv .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
            $videosdiv .= "</td>";//td desc

            $videosdiv .= "<td class='filecont'>";

            if (strpos($pointdocument['Document']['route'], '.swf') !== false || strpos($pointdocument['Document']['route'], '.flv') !== false)//if flash
            {
                $videosdiv .= "<embed id='vid".$pointdocument['Document']['id']."' name='vid".$pointdocument['Document']['id']."' src='/senderos/app/webroot/video/mediaplayer.swf?file=/senderos/app/webroot/video/".$pointdocument['Document']['route']."' allowfullscreen='true' />";
            }
            else if (strpos($pointdocument['Document']['route'], '.wmv') !== false)
            {
                $videosdiv .= "<object id='vid".$pointdocument['Document']['id']."' name='vid".$pointdocument['Document']['id']."' type='video/x-ms-asf' url='/senderos/app/webroot/video/".$pointdocument['Document']['route']."'";
                $videosdiv .= " data='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' classid='CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6'>";
                $videosdiv .= "<param name='url' value='/senderos/app/webroot/video/".$pointdocument['Document']['route']."'>";
                $videosdiv .= "<param name='filename' value='".$pointdocument['Document']['route']."'>";
                $videosdiv .= "<param name='autostart' value='0'>";
                $videosdiv .= "<param name='uiMode' value='full'>";
                $videosdiv .= "<param name='autosize' value='1'>";
                $videosdiv .= "<param name='playcount' value='1'>";
                $videosdiv .= "<embed id='vid".$pointdocument['Document']['id']."' name='vid".$pointdocument['Document']['id']."' type='application/x-mplayer2' src='/senderos/app/webroot/video/".$pointdocument['Document']['route']."'";
                $videosdiv .= " autostart='false' showcontrols='true' pluginspage='http://www.microsoft.com/Windows/MediaPlayer/'>";
                $videosdiv .= "</embed>";
                $videosdiv .= "</object>";
            }
            else if (strpos($pointdocument['Document']['route'], '.mp4') !== false)
            {
                $videosdiv .= "<OBJECT id='vid".$pointdocument['Document']['id']."' name='vid".$pointdocument['Document']['id']."' CLASSID='clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B'";
                $videosdiv .= "CODEBASE='http://www.apple.com/qtactivex/qtplugin.cab' >";
                //$videosdiv .= "<PARAM NAME='SRC' VALUE='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' />";
                $videosdiv .= "<PARAM NAME='autoplay' VALUE='false' />";
                $videosdiv .= "<EMBED id='vid".$pointdocument['Document']['id']."' name='vid".$pointdocument['Document']['id']."' SRC='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' TYPE='image/x-macpaint'";
                $videosdiv .= "PLUGINSPAGE='http://www.apple.com/quicktime/download'";
                $videosdiv .= " AUTOPLAY='false'></EMBED>";
                $videosdiv .= "<PARAM NAME='SRC' VALUE='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' />";
                $videosdiv .= "</OBJECT>";
            }
            else
            {

            }

            //$videosdiv .= "<img id='img".$pointdocument['Document']['id']."' src='/senderos/app/webroot/videos/".$pointdocument['Document']['route']."'";
            //$videosdiv .= " style='cursor:pointer;' onclick=\"fullScreen('img".$pointdocument['Document']['id']."')\"/><br>";




            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $videosdiv .= "<div id='filediv".$pointdocument['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
                $videosdiv .= "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
                $videosdiv .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file'";
                $videosdiv .= " onchange=\"previewFile('".$pointdocument['Document']['id']."','DocumentArchivo".$pointdocument['Document']['id']."')\"";
                $videosdiv .= " accept='video/*, video/*, audio/*, application/pdf'";
                $videosdiv .= " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";//file
                $videosdiv .= "</div>"; //div filediv???
            }
            $videosdiv .= "</td>"; //td img

            $videosdiv .= "<td class='middle'><input type='button' value='>>' onclick='forward(".$videoscounter.",0);' title='next'/></td>";

            $videosdiv .= "</tr>";

            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $videosdiv .= "<tr><td colspan=4><div id=\"choosevisitors\" style=\"text-align:left;\">";
                //$videosdiv .= "<input type=\"hidden\" id=\"DocumentVisitors\" name=\"data[Document][visitors]\" value=\";\"/>";
                $videosdiv .= "Available for:<br>";

                $availability = ";";

                $videosdiv .= "<input type=\"checkbox\" value=\"Student\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Student' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $videosdiv .= " checked";
                        $availability .= "Student;";
                        break;
                    }
                endforeach;
                $videosdiv .= ">Student<br>";

                $videosdiv .= "<input type=\"checkbox\" value=\"Professor\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Professor' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $videosdiv .= " checked";
                        $availability .= "Professor;";
                        break;
                    }
                endforeach;
                $videosdiv .= ">Professor<br>";
                $videosdiv .= "<input type=\"checkbox\" value=\"Researcher\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Researcher' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $videosdiv .= " checked";
                        $availability .= "Researcher;";
                        break;
                    }
                endforeach;
                $videosdiv .= ">Researcher<br>";
                $videosdiv .= "<input type=\"checkbox\" value=\"History\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'History' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $videosdiv .= " checked";
                        $availability .= "History;";
                        break;
                    }
                endforeach;
                $videosdiv .= ">History<br>";

                $videosdiv .= "<input type=\"hidden\" id=\"D_".$pointdocument['Document']['id']."\" name=\"data[Document][visitors]\" value=\"".$availability."\"/>";
                $videosdiv .= "</div> </td></tr><!-- choosevisitors -->";

                $videosdiv .= "<tr><td colspan=3 style='text-align:right;' title='Save the current document'>";
                $videosdiv .= "<a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");'>save</a>";
                $videosdiv .= "</td></tr>";
            }

            $videosdiv .= "</table>";


            $videosdiv .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";

            $videosdiv .= "</form>";

            $videosdiv .= "</div></center>"; //videoitemdiv
        }
	}
	else if($pointdocument['Document']['type'] === 'sound') //if a sound
	{
		if($pointdocument['Document']['language_id'] === $_SESSION['language'])
    	{
            $soundscounter++;

            $soundsdiv .= "<center><div id='sounditem".$soundscounter."'";

            if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
                $soundsdiv .= " class='imageitem1'";
            else
                $soundsdiv .= " class='imageitem2'";

            if($soundscounter==1)
                $soundsdiv .= " style='display:block;'";
            else
                $soundsdiv .= " style='display:none;'";

            $soundsdiv .= ">"; //sounditemdiv

            $soundsdiv .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
            $soundsdiv .= "<input name='_method' value='POST' type='hidden'/>";

            $soundsdiv .= "<table><tr>";
            $soundsdiv .= "<td class='middle'><input type='button' value='<<' onclick='back(".$soundscounter.",3);' title='previous'/></td>";
            $soundsdiv .= "<td class='desc'>";
            $soundsdiv .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
            $soundsdiv .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
            $soundsdiv .= "<br>File:<br><input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='text' value='".$pointdocument['Document']['route']."'/><br>";
            //$soundsdiv .= "<br>Language:<br><input name='data[Document][language]' id='DocumentLanguage' type='text' value='".$pointdocument['Document']['language']."'/><br>";
            $soundsdiv .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
            $soundsdiv .= "</td>";//td desc

            $soundsdiv .= "<td class='filecont'>";

            if (strpos($pointdocument['Document']['route'], '.mp3') !== false)//if mp3
            {
                $soundsdiv .= "<object id='snd".$pointdocument['Document']['id']."' name='snd".$pointdocument['Document']['id']."'";
                $soundsdiv .= " data='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' >";
                $soundsdiv .= "<param name='src' value='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."'/>";
                $soundsdiv .= "<PARAM NAME='autoplay' VALUE='false' />";
                $soundsdiv .= "<EMBED id='snd".$pointdocument['Document']['id']."' name='snd".$pointdocument['Document']['id']."' SRC='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' AUTOPLAY='false'></EMBED>";
                $soundsdiv .= "</object>";
            }
            else
            {

            }



            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $soundsdiv .= "<div id='filediv".$pointdocument['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
                $soundsdiv .= "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
                $soundsdiv .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file'";
                $soundsdiv .= " onchange=\"previewFile('".$pointdocument['Document']['id']."','DocumentArchivo".$pointdocument['Document']['id']."')\"";
                $soundsdiv .= " accept='sound/*, sound/*, audio/*, application/pdf'";
                $soundsdiv .= " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";//file
                $soundsdiv .= "</div>"; //div filediv???
            }
            $soundsdiv .= "</td>"; //td img

            $soundsdiv .= "<td class='middle'><input type='button' value='>>' onclick='forward(".$soundscounter.",3);' title='next'/></td>";

            $soundsdiv .= "</tr>";

            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $soundsdiv .= "<tr><td colspan=4><div id=\"choosevisitors\" style=\"text-align:left;\">";
                //$soundsdiv .= "<input type=\"hidden\" id=\"DocumentVisitors\" name=\"data[Document][visitors]\" value=\";\"/>";
                $soundsdiv .= "Available for:<br>";

                $availability = ";";

                $soundsdiv .= "<input type=\"checkbox\" value=\"Student\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Student' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $soundsdiv .= " checked";
                        $availability .= 'Student;';
                        break;
                    }
                endforeach;
                $soundsdiv .= ">Student<br>";

                $soundsdiv .= "<input type=\"checkbox\" value=\"Professor\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Professor' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $soundsdiv .= " checked";
                        $availability .= 'Professor;';
                        break;
                    }
                endforeach;
                $soundsdiv .= ">Professor<br>";
                $soundsdiv .= "<input type=\"checkbox\" value=\"Researcher\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Researcher' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $soundsdiv .= " checked";
                        $availability .= 'Researcher;';
                        break;
                    }
                endforeach;
                $soundsdiv .= ">Researcher<br>";
                $soundsdiv .= "<input type=\"checkbox\" value=\"History\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'History' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $soundsdiv .= " checked";
                        $availability .= 'History;';
                        break;
                    }
                endforeach;
                $soundsdiv .= ">History<br>";

                $soundsdiv .= "<input type=\"hidden\" id=\"D_".$pointdocument['Document']['id']."\" name=\"data[Document][visitors]\" value=\"".$availability."\"/>";
                $soundsdiv .= "</div> </td></tr><!-- choosevisitors -->";

                $soundsdiv .= "<tr><td colspan=3 style='sound-align:right;' title='Save the current document'>";
                $soundsdiv .= "<a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");'>save</a>";
                $soundsdiv .= "</td></tr>";
            }

            $soundsdiv .= "</table>";


            $soundsdiv .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";

            $soundsdiv .= "</form>";

            $soundsdiv .= "</div></center>"; //sounditemdiv
        }
	}
	else if($pointdocument['Document']['type'] === 'text') //if a text
	{
        if($pointdocument['Document']['language_id'] === $_SESSION['language'])
    	{
            $textscounter++;

            $textsdiv .= "<center><div id='textitem".$textscounter."'";

            if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
                $textsdiv .= " class='imageitem1'";
            else
                $textsdiv .= " class='imageitem2'";

            if($textscounter==1)
                $textsdiv .= " style='display:block;'";
            else
                $textsdiv .= " style='display:none;'";

            $textsdiv .= ">"; //textitemdiv

            $textsdiv .= "<form action='/senderos/documents/add' id='DocumentEditForm".$pointdocument['Document']['id']."' enctype='multipart/form-data' method='post' accept-charset='utf-8'>";
            $textsdiv .= "<input name='_method' value='POST' type='hidden'/>";

            $textsdiv .= "<table><tr>";
            $textsdiv .= "<td class='middle'><input type='button' value='<<' onclick='back(".$textscounter.",1);' title='previous'/></td>";
            $textsdiv .= "<td class='desc'>";
            $textsdiv .= "<input name='data[Document][id]' id='DocumentId' type='hidden' value='".$pointdocument['Document']['id']."'/><br>";
            $textsdiv .= "Name:<br><input name='data[Document][name]' id='DocumentName' type='text' value='".$pointdocument['Document']['name']."'/><br>";
            $textsdiv .= "<br>File:<br><input name='data[Document][route]' id='DocumentRoute".$pointdocument['Document']['id']."' type='text' value='".$pointdocument['Document']['route']."'/><br>";
            //$textsdiv .= "<br>Language:<br><input name='data[Document][language]' id='DocumentLanguage' type='text' value='".$pointdocument['Document']['language']."'/><br>";
            $textsdiv .= "<br>Description:<br><textarea name='data[Document][description]' id='DocumentDescription'>".$pointdocument['Document']['description']."</textarea><br>";
            $textsdiv .= "</td>";//td desc

            $textsdiv .= "<td class='filecont'>";

            $textsdiv .= "<object id='txt".$pointdocument['Document']['id']."' name='txt".$pointdocument['Document']['id']."'";
            $textsdiv .= " data='/senderos/app/webroot/text/".$pointdocument['Document']['route']."' >";
            $textsdiv .= "<param name='src' value='/senderos/app/webroot/text/".$pointdocument['Document']['route']."'/>";
            $textsdiv .= "</object>";




            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $textsdiv .= "<div id='filediv".$pointdocument['Document']['id']."' style='display: block; width: 100px; height: 20px; overflow: hidden;cursor: pointer;' title='Change file'>";
                $textsdiv .= "<a href='javascript: void(0)' style='width: 110px; height: 30px; position: relative; top: -5px; left: -5px;cursor: pointer;'>Change</a>";
                $textsdiv .= "<input name='data[Document][archivo]' id='DocumentArchivo".$pointdocument['Document']['id']."' type='file'";
                $textsdiv .= " onchange=\"previewFile('".$pointdocument['Document']['id']."','DocumentArchivo".$pointdocument['Document']['id']."')\"";
                $textsdiv .= " accept='text/*, text/*, audio/*, application/pdf'";
                $textsdiv .= " style='font-size: 50px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -40px; left: -20px; cursor: pointer;'/>";//file
                $textsdiv .= "</div>"; //div filediv???
            }
            $textsdiv .= "</td>"; //td img

            $textsdiv .= "<td class='middle'><input type='button' value='>>' onclick='forward(".$textscounter.",1);' title='next'/></td>";

            $textsdiv .= "</tr>";

            if($_SESSION['role'] === "administrator" || $_SESSION['role'] === 'restricted')
            {
                $textsdiv .= "<tr><td colspan=4><div id=\"choosevisitors\" style=\"text-align:left;\">";
                //$textsdiv .= "<input type=\"hidden\" id=\"DocumentVisitors\" name=\"data[Document][visitors]\" value=\";\"/>";
                $textsdiv .= "Available for:<br>";

                $availability = ";";

                $textsdiv .= "<input type=\"checkbox\" value=\"Student\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Student' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $textsdiv .= " checked";
                        $availability .= 'Student;';
                        break;
                    }
                endforeach;
                $textsdiv .= ">Student<br>";

                $textsdiv .= "<input type=\"checkbox\" value=\"Professor\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Professor' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $textsdiv .= " checked";
                        $availability .= 'Professor;';
                        break;
                    }
                endforeach;
                $textsdiv .= ">Professor<br>";
                $textsdiv .= "<input type=\"checkbox\" value=\"Researcher\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'Researcher' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $textsdiv .= " checked";
                        $availability .= 'Researcher;';
                        break;
                    }
                endforeach;
                $textsdiv .= ">Researcher<br>";
                $textsdiv .= "<input type=\"checkbox\" value=\"History\" onclick=\"AddVisitor(this.checked, this.value, D_".$pointdocument['Document']['id'].");\"";
                foreach ($visitors as $visitor):
                    if($visitor['Visitor']['role'] == 'History' && $visitor['Visitor']['document_id'] == $pointdocument['Document']['id'])
                    {
                        $textsdiv .= " checked";
                        $availability .= 'History;';
                        break;
                    }
                endforeach;
                $textsdiv .= ">History<br>";

                $textsdiv .= "<input type=\"hidden\" id=\"D_".$pointdocument['Document']['id']."\" name=\"data[Document][visitors]\" value=\"".$availability."\"/>";
                $textsdiv .= "</div> </td></tr><!-- choosevisitors -->";

                $textsdiv .= "<tr><td colspan=3 style='text-align:right;' title='Save the current document'>";
                $textsdiv .= "<a style='cursor:pointer;' onclick='editDocument(".$pointdocument['Document']['id'].");'>save</a>";
                $textsdiv .= "</td></tr>";
            }

            $textsdiv .= "</table>";


            $textsdiv .= "<input name='data[Document][type]' id='DocumentType' type='hidden' value='".$pointdocument['Document']['type']."'/>";

            $textsdiv .= "</form>";

            $textsdiv .= "</div></center>"; //textitemdiv
        }
	}
	else
	{
	}
}

endforeach; // foreach document

$imagesdiv .= "Total: <div id='imagescount'>".$imagescounter."</div></div>"; //end images div
$videosdiv .= "Total: <div id='videoscount'>".$videoscounter."</div></div>"; //end videos div
$soundsdiv .= "Total: <div id='soundscount'>".$soundscounter."</div></div>"; //end soundsdiv
$textsdiv .= "Total: <div id='textscount'>".$textscounter."</div></div>";    //end textsdiv
//$othersdiv .= "Total: <div id='otherscount'>".$otherscounter."</div></div>"; //end others div

?>


<div id="point_documents">


<?php 

if($imagescounter>0) echo $imagesdiv."<br>";
if($videoscounter>0) echo $videosdiv."<br>";
if($soundscounter>0) echo $soundsdiv."<br>";
if($textscounter>0) echo $textsdiv."<br>";
//if($otherscounter>0) echo $othersdiv."<br>";


//debug($pointdocuments);
?>


</div> <!-- point_documents -->



<div id="slider">
	
</div>
