function FindPosition(oElement)
 {
   if(typeof( oElement.offsetParent ) != "undefined")
   {
     for(var posX = 0, posY = 0; oElement; oElement = oElement.offsetParent)
     {
       posX += oElement.offsetLeft;
       posY += oElement.offsetTop;
     }
       return [ posX, posY ];
     }
     else
     {
       return [ oElement.x, oElement.y ];
     }
 }

function GetCoordinates(e)
 {
   var PosX = 0;
   var PosY = 0;
   var ImgPos;
   ImgPos = FindPosition(myImg);
   if (!e) var e = window.event;
   if (e.pageX || e.pageY)
   {
     PosX = e.pageX;
     PosY = e.pageY;
   }
   else if (e.clientX || e.clientY)
     {
       PosX = e.clientX + document.body.scrollLeft
         + document.documentElement.scrollLeft;
       PosY = e.clientY + document.body.scrollTop
         + document.documentElement.scrollTop;
     }
   PosX = PosX - ImgPos[0];
   PosY = PosY - ImgPos[1];
   document.getElementById("x").innerHTML = PosX;
   document.getElementById("y").innerHTML = PosY;

   //PUNTO 1
   if(PosX > 567 && PosX < 578 && PosY > 355 && PosY < 368){
	send_point_id(1);
   }

   //PUNTO 2
   if(PosX > 541 && PosX < 551 && PosY > 393 && PosY < 404){
	send_point_id(2);
   }

   //PUNTO 3
   if(PosX > 537 && PosX < 547 && PosY > 359 && PosY < 371){
	send_point_id(3);
   }

   //PUNTO 4
   if(PosX > 601 && PosX < 611 && PosY > 307 && PosY < 317){
	send_point_id(4);
   }

   //PUNTO 5
   if(PosX > 571 && PosX < 581 && PosY > 279 && PosY < 291){
	send_point_id(5);
   }

   //PUNTO 6
   if(PosX > 586 && PosX < 596 && PosY > 276 && PosY < 288){
	send_point_id(6);
   }

   //PUNTO 7
   if(PosX > 614 && PosX < 624 && PosY > 234 && PosY < 244){
	send_point_id(7);
   }

   //PUNTO 8
   if(PosX > 579 && PosX < 589 && PosY > 243 && PosY < 253){
	send_point_id(8);
   }

   //PUNTO 9
   if(PosX > 511 && PosX < 521 && PosY > 158 && PosY < 168){
	send_point_id(9);
   }

   //PUNTO 10
   if(PosX > 456 && PosX < 466 && PosY > 146 && PosY < 156){
	send_point_id(10);
   }

   //PUNTO 11
   if(PosX > 476 && PosX < 486 && PosY > 186 && PosY < 196){
	send_point_id(11);
   }

   //PUNTO 12
   if(PosX > 525 && PosX < 535 && PosY > 199 && PosY < 209){
	send_point_id(12);
   }

   //PUNTO 13
   if(PosX > 539 && PosX < 549 && PosY > 254 && PosY < 264){
	send_point_id(13);
   }

 }

function SetPointer(e)
{
/*document.getElementById("draggableElement").style = "cursor: pointer";
	if((PosX > 567 && PosX < 578 && PosY > 355 && PosY < 368))
		document.getElementById("draggableElement").style = "cursor: pointer";
	//PUNTO 1
   if((PosX > 567 && PosX < 578 && PosY > 355 && PosY < 368)
	|| (PosX > 541 && PosX < 551 && PosY > 393 && PosY < 404)
	|| (PosX > 537 && PosX < 547 && PosY > 359 && PosY < 371)
	|| (PosX > 601 && PosX < 611 && PosY > 307 && PosY < 317)
	|| (PosX > 571 && PosX < 581 && PosY > 279 && PosY < 291)
	|| (PosX > 586 && PosX < 596 && PosY > 276 && PosY < 288)
	|| (PosX > 614 && PosX < 624 && PosY > 234 && PosY < 244)
	|| (PosX > 579 && PosX < 589 && PosY > 243 && PosY < 253)
	|| (PosX > 511 && PosX < 521 && PosY > 158 && PosY < 168)
	|| (PosX > 456 && PosX < 466 && PosY > 146 && PosY < 156)
	|| (PosX > 476 && PosX < 486 && PosY > 186 && PosY < 196)
	|| (PosX > 525 && PosX < 535 && PosY > 199 && PosY < 209)
	|| (PosX > 539 && PosX < 549 && PosY > 254 && PosY < 264)){
		
		//document.getElementById("draggableElement").style.cursor = "pointer";
		alert('kkk');
	}*/
}


/*OTHER*/
function send_point_id(point_id) {

	window.location = '/senderos/points/view/'+point_id+'';
}
