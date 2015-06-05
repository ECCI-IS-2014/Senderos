<?php
$what = $_GET['what'];
switch($what)
{
    case '0':
        $what = 'video';
        break;
    case '1':
        $what = 'text';
        break;
    case '2':
        $what = 'images';
        break;
    case '3':
        $what = 'sound';
        break;
}

$imagesdiv = "<div id='imagesdiv' class='filediv'>";

$imagescounter = 0;
$show = 'no';


foreach($pointdocuments as $pointdocument):

if($pointdocument['Document']['language_id'] == $_SESSION['language'])
{

$show = 'no';

if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
	$show = 'yes';
else
{
	foreach ($visitors as $visitor):
		if($visitor['DocumentsVisitor']['document_id'] == $pointdocument['Document']['id'])
		{
			$show = 'yes';
			break;
		}
	endforeach;
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
		
		$imagesdiv .= ">"; //imageitemdiv

		//the file
		$imagesdiv .= "<div style='float: left; width: 80%; height: 100%;'>";
		$imagesdiv .= "<table><tr>";
		$imagesdiv .= "<td width='30px'><input class='middle' type='button' value='<' onclick='back(".$imagescounter.",".$pointdocument['Document']['type'].");' title='previous'/></td>";

		$imagesdiv .= "<td>";

		if($pointdocument['Document']['type'] === 'images') //if an image
		{
			$imagesdiv .="<img id='img".$pointdocument['Document']['id']."' style='width:500px; height:450px;' src='/senderos/app/webroot/images/".$pointdocument['Document']['route']."' />";
		}
		else if($pointdocument['Document']['type'] === 'video') //if a video
		{
			$imagesdiv .= "<video id='vid".$pointdocument['Document']['id']."' width='500' height='450' controls>";
			$imagesdiv .= "<source src='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' type='video/mp4'>";
  			$imagesdiv .= "<source src='/senderos/app/webroot/video/".$pointdocument['Document']['route']."' type='video/ogg'>";
			$imagesdiv .= "Your browser does not support the video tag";
			$imagesdiv .= "</video>";
		}
		else if($pointdocument['Document']['type'] === 'sound') //if a sound
		{
			$imagesdiv .= "<audio id='snd".$pointdocument['Document']['id']."' width='500' height='450' controls>";
			$imagesdiv .= "<source src='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' type='audio/mpeg'>";
  			$imagesdiv .= "<source src='/senderos/app/webroot/sound/".$pointdocument['Document']['route']."' type='audio/ogg'>";
			$imagesdiv .= "Your browser does not support the audio tag";
			$imagesdiv .= "</audio>";
		}
		else if($pointdocument['Document']['type'] === 'text') //if a text
		{
			$imagesdiv .="<embed id='txt".$pointdocument['Document']['id']."' style='width:500px; height:450px;' src='/senderos/app/webroot/text/".$pointdocument['Document']['route']."' />";
		}
		else
		{
		}
		

		$imagesdiv .= "</td>";

		$imagesdiv .= "<td width='30px'><input class='middle' type='button' value='>' onclick='forward(".$imagescounter.",".$pointdocument['Document']['type'].");' title='next'/></td>";
		$imagesdiv .= "</tr></table>";
		$imagesdiv .= "</div>";	//the file div

		$imagesdiv .= "</div>"; //imageitem div
	}

	
	
}

}
endforeach; // foreach document
$imagesdiv .= "<div id='imagescount' style='display:none;'>".$imagescounter."</div>";
$imagesdiv .= "</div>"; //end imagesdiv
?>

<div id="point_documents">

<?php
echo $imagesdiv."<br>";
?>

</div> <!-- point_documents -->
