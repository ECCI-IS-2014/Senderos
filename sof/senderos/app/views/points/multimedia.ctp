
<?php

$imagesdiv = "<div id='imagesdiv' class='filediv'>";

$imagescounter = 0;
$show = 'no';

$what = $_GET['what'];

if($what === '0') $what = 'video';
if($what === '1') $what = 'text';
if($what === '2') $what = 'images';
if($what === '3') $what = 'sound';

$visitorid = $this->requestAction('/visitors/getid/'.$_SESSION['role'].'');
$languageid = $this->requestAction('/languages/getid/'.$_SESSION['language'].'');

/*debug($pointdocuments);
debug($visitors);
debug($languages);*/


foreach($pointdocuments as $pointdocument):

	$show = 'no';

	if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
		$show = 'yes';
	else
	{

		$visitor_available = false;
		$language_available = false;

		foreach ($visitors as $visitor):
			if($visitor['Visitor']['id'] == $visitorid && $visitor['Document']['id'] == $pointdocument['Document']['id'])
			{
				//echo 'Visitor: '.$visitor['Visitor']['id'].', current: '.$visitorid.'<br>';
				$visitor_available = true;
				break;
			}
		endforeach;

		foreach ($languages as $language):
			if($language['Language']['id'] == $languageid  && $language['Document']['id'] == $pointdocument['Document']['id'])
			{
				//echo 'Language: '.$language['Language']['id'].', current: '.$languageid.'<br>';
				$language_available = true;
				break;
			}
		endforeach;

		if($visitor_available && $language_available)
			$show = 'yes';
	}

	if($show === 'yes')
	{
		if($pointdocument['Document']['type'] === $what) //if an image
		{
			$imagescounter++;
		
			$imagesdiv .= "<div id='";

			if($pointdocument['Document']['type'] === 'images')$imagesdiv .= "imageitem";
			if($pointdocument['Document']['type'] === 'video')$imagesdiv .= "videoitem";
			if($pointdocument['Document']['type'] === 'text')$imagesdiv .= "textitem";
			if($pointdocument['Document']['type'] === 'sound')$imagesdiv .= "sounditem";


			$imagesdiv .= $imagescounter."'";
		
			if($imagescounter==1)
				$imagesdiv .= " style='display:block;'";
			else
				$imagesdiv .= " style='display:none;'";
		
			//$imagesdiv .= " title=".$pointdocument['Document']['description'].">"; //imageitemdiv
			$imagesdiv .= ">"; //imageitemdiv

			//the file
			//$imagesdiv .= "<div>";// style='float: left; width: 100%; height: 100%;'>";
			//$imagesdiv .= "<table width='100%'><tr width='100%'>";
			$imagesdiv .= "<div style='width: 10%; float:left; text-align:left;z-index=3;'><input class='middle' type='button' value='<' onclick=\"back(".$imagescounter.",'".$pointdocument['Document']['type']."');\" title='previous'/></div>";

			$imagesdiv .= "<div style='position: absolute; float:left; left: 5%; right:5%; z-index=2;'>";

			if($pointdocument['Document']['type'] === 'images') //if an image
			{
				$imagesdiv .="<img id='img".$pointdocument['Document']['id']."'  src='/senderos/app/webroot/images/".$pointdocument['Document']['route']."' />";
			}
			else if($pointdocument['Document']['type'] === 'video') //if a video
			{
				$imagesdiv .= "<embed id='vid".$pointdocument['Document']['id']."' name='vid".$pointdocument['Document']['id']."' width='100%' height='100%'src='/senderos/app/webroot/files/mediaplayer.swf?file=/senderos/app/webroot/video/".$pointdocument['Document']['route']."' allowfullscreen='true' />";
				/*$imagesdiv .= "<video id='vid".$pointdocument['Document']['id']."' width='100%' height='100%' controls>";
				$imagesdiv .= "<source src='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' type='video/mp4'>";
  				$imagesdiv .= "<source src='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' type='video/ogg'>";
				$imagesdiv .= "Your browser does not support the video tag";
				$imagesdiv .= "</video>";*/
			}
			else if($pointdocument['Document']['type'] === 'sound') //if a sound
			{
				/*$imagesdiv .= "<audio id='snd".$pointdocument['Document']['id']."' width='500' height='200' controls>";
				$imagesdiv .= "<source src='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' type='audio/mpeg'>";
  				$imagesdiv .= "<source src='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' type='audio/ogg'>";
				$imagesdiv .= "Your browser does not support the audio tag";
				$imagesdiv .= "</audio>";*/
				$imagesdiv .= "<object id='snd".$pointdocument['Document']['id']."' name='snd".$pointdocument['Document']['id']."'";
				$imagesdiv .= " data='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' width='500' height='400'>";
				$imagesdiv .= "<param name='src' value='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."'/>";
				$imagesdiv .= "<PARAM NAME='autoplay' VALUE='true' />";
				$imagesdiv .= "<EMBED id='snd".$pointdocument['Document']['id']."' name='snd".$pointdocument['Document']['id']."' SRC='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' AUTOPLAY='true' width='400' height='200'></EMBED>";
				$imagesdiv .= "</object><br>";
			}
			else if($pointdocument['Document']['type'] === 'text') //if a text
			{
				//$imagesdiv .="<embed id='txt".$pointdocument['Document']['id']."' style='width:500px; height:300px;' src='/senderos/app/webroot/text/".$pointdocument['Document']['route']."' />";
				$imagesdiv .="<div id='txt".$pointdocument['Document']['id']."' style='background-color: white; width:100%; height:400px; overflow-y: scroll;'>".$pointdocument['Document']['htmltext']."</div>";
			}
			else
			{
			}

			//$imagesdiv .= "<div title='".$pointdocument['Document']['description']."' style='cursor: default;'><h3>".$pointdocument['Document']['name']."</h3></div>";
		

			$imagesdiv .= "</div>";

			$imagesdiv .= "<div style='width: 10%; float:right; text-align:center;'><input class='middle' type='button' value='>' onclick=\"forward(".$imagescounter.",'".$pointdocument['Document']['type']."');\" title='next'/></div>";
			//$imagesdiv .= "</tr></table>";
			//$imagesdiv .= "</div>";	//the file div
		
			//information
			/*$imagesdiv .= "<div class='imageinfo' style='float: left; width: 20%; height: 100%;'>";

			//$imagesdiv .= "".$pointdocument['Document']['id']."<br>";
			$imagesdiv .= "<h1>".$pointdocument['Document']['name']."</h1>";
			//$imagesdiv .= "".$pointdocument['Document']['route']."<br>";
			//$imagesdiv .= "".$pointdocument['Document']['language']."<br>";
			$imagesdiv .= "<p>".$pointdocument['Document']['description']."</p>";

			$imagesdiv .= "</div>"; //information div*/

			$imagesdiv .= "</div>"; //imageitem div
		
		}//end if docuement type

	}//end if show yes

endforeach; // foreach point document

$imagesdiv .= "<div id='imagescount' style='display:none;'>".$imagescounter."</div>";

$imagesdiv .= "</div>"; //end imagesdiv

?>


<div id="point_documents">


<?php 

echo $imagesdiv;

?>


</div> <!-- point_documents -->
