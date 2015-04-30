var punto2, punto3, punto4, punto5, punto6, punto7, punto8, punto9, punto10, punto11, punto12, punto13;

var moused=0;

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

	var APosX = 0;
	var APosY = 0;


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

	APosX = PosX * 1;
	APosY = PosY * 1;

	PosX = PosX - ImgPos[0];
	PosY = PosY - ImgPos[1];

	return [PosX, PosY, APosX, APosY]; 

}


function getPoint(e)
{

	var PosX = 0;
	var PosY = 0;

	var coord = GetCoordinates(e);

	PosX = coord[0];
	PosY = coord[1];

	//myImg.style.cursor = 'move';
	moused = 1;

	punto1 = (PosX > 567 && PosX < 578 && PosY > 355 && PosY < 368);
	punto2 = (PosX > 541 && PosX < 551 && PosY > 393 && PosY < 404);
	punto3 = (PosX > 537 && PosX < 547 && PosY > 359 && PosY < 371);
	punto4 = (PosX > 601 && PosX < 611 && PosY > 307 && PosY < 317);
	punto5 = (PosX > 571 && PosX < 581 && PosY > 279 && PosY < 291);
	punto6 = (PosX > 586 && PosX < 596 && PosY > 276 && PosY < 288);
	punto7 = (PosX > 614 && PosX < 624 && PosY > 234 && PosY < 244);
	punto8 = (PosX > 579 && PosX < 589 && PosY > 243 && PosY < 253);
	punto9 = (PosX > 511 && PosX < 521 && PosY > 158 && PosY < 168);
	punto10 = (PosX > 456 && PosX < 466 && PosY > 146 && PosY < 156);
	punto11 = (PosX > 476 && PosX < 486 && PosY > 186 && PosY < 196);
	punto12 = (PosX > 525 && PosX < 535 && PosY > 199 && PosY < 209);
	punto13 = (PosX > 539 && PosX < 549 && PosY > 254 && PosY < 264);

	
	if(punto1)send_point_id(1);
	if(punto2)send_point_id(2);
	if(punto3)send_point_id(3);
	if(punto4)send_point_id(4);
	if(punto5)send_point_id(5);
	if(punto6)send_point_id(6);
	if(punto7)send_point_id(7);
	if(punto8)send_point_id(8);
	if(punto9)send_point_id(9);
	if(punto10)send_point_id(10);
	if(punto11)send_point_id(11);
	if(punto12)send_point_id(12);
	if(punto13)send_point_id(13);
}

function SetPointer(e)
{
	var PosX = 0;
	var PosY = 0;

	var APosX = 0;
	var APosY = 0;

	var coord = GetCoordinates(e);

	PosX = coord[0];
	PosY = coord[1];

	APosX = coord[2];
	APosY = coord[3];

	//document.getElementById("x").innerHTML = PosX;
	//document.getElementById("y").innerHTML = PosY;
	
	punto1 = (PosX > 567 && PosX < 578 && PosY > 355 && PosY < 368);
	punto2 = (PosX > 541 && PosX < 551 && PosY > 393 && PosY < 404);
	punto3 = (PosX > 537 && PosX < 547 && PosY > 359 && PosY < 371);
	punto4 = (PosX > 601 && PosX < 611 && PosY > 307 && PosY < 317);
	punto5 = (PosX > 571 && PosX < 581 && PosY > 279 && PosY < 291);
	punto6 = (PosX > 586 && PosX < 596 && PosY > 276 && PosY < 288);
	punto7 = (PosX > 614 && PosX < 624 && PosY > 234 && PosY < 244);
	punto8 = (PosX > 579 && PosX < 589 && PosY > 243 && PosY < 253);
	punto9 = (PosX > 511 && PosX < 521 && PosY > 158 && PosY < 168);
	punto10 = (PosX > 456 && PosX < 466 && PosY > 146 && PosY < 156);
	punto11 = (PosX > 476 && PosX < 486 && PosY > 186 && PosY < 196);
	punto12 = (PosX > 525 && PosX < 535 && PosY > 199 && PosY < 209);
	punto13 = (PosX > 539 && PosX < 549 && PosY > 254 && PosY < 264);

	var d = document.getElementById('leyenda');

	if(punto1 || punto2 || punto3 || punto4 || punto5 || punto6 || punto7 || punto8 || punto9 || punto10 || punto11 || punto12 || punto13)
		myImg.style.cursor = 'pointer';
	else if (moused == 1)
	{
		myImg.style.cursor = 'move';
		d.style.display = 'none';
	}
	else
	{
		myImg.style.cursor = 'default';
		d.style.display = 'none';
	}

	//document.getElementById("ax").innerHTML = APosX;
	//document.getElementById("ay").innerHTML = APosY;


	if(punto1)Ajax(1, APosX, APosY);
	if(punto2)Ajax(2, APosX, APosY);
	if(punto3)Ajax(3, APosX, APosY);
	if(punto4)Ajax(4, APosX, APosY);
	if(punto5)Ajax(5, APosX, APosY);
	if(punto6)Ajax(6, APosX, APosY);
	if(punto7)Ajax(7, APosX, APosY);
	if(punto8)Ajax(8, APosX, APosY);
	if(punto9)Ajax(9, APosX, APosY);
	if(punto10)Ajax(10, APosX, APosY);
	if(punto11)Ajax(11, APosX, APosY);
	if(punto12)Ajax(12, APosX, APosY);
	if(punto13)Ajax(13, APosX, APosY);

}


/*OTHER*/
function send_point_id(point_id) {

	window.location = '/senderos/points/view/'+point_id+'';
}





/*OTHER*/
function Ajax(id, x, y)
{
	if(window.XMLHttpRequest)
		ajax = new XMLHttpRequest()
	else
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	
	ajax.open("POST","/senderos/points/getinfo/"+id+"",true);
	
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4)
		{
			var respuesta=ajax.responseText;
			//alert(respuesta);
			display(id,respuesta,x,y);
		}
	}
	
	//ajax.send("nombre=nombre");
	ajax.send(null);
}


function display(id,info, x, y)
{

	var ax = ''+x+'px';
	var ay = ''+y+'px';
	
	var d = document.getElementById('leyenda');
	d.innerHTML = info;
	d.style.left = ax;
	d.style.top = ay;
	d.style.display = 'block';

	d.onclick = function() {
		send_point_id(id);
	};

}


