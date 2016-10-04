
//	This JS file was created by CHRISTOPHER UZHUTHUVAL add Service Book details to College Info System using AJAX code 

var xmlhttp;
var i = 1;
var j = 1;
var k = 1;

function appendTbodyQ()
{
	iTbody = document.getElementById('addqual');
	eTr = document.createElement('tr');
	eTr.setAttribute("id" , "qdynamictr"+i);
	iTbody.appendChild(eTr);
}

function add_qual()
{
    appendTbodyQ();
    xmlhttp = GetXmlHttpObject();
    
    if (xmlhttp == null)
    {
        alert("Browser does not support HTTP request");
        return;
    }        
    
    var url="aj_servicebook.php?i="+i;
    xmlhttp.onreadystatechange=stateChanged;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
}

function stateChanged()
{
    if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
    {	
	document.getElementById("qdynamictr"+i).innerHTML=xmlhttp.responseText;
        i++;	
    }
}

function appendTbodySQ()
{
	iTbody = document.getElementById('addspqual');
	eTr = document.createElement('tr');
	eTr.setAttribute("id" , "spdynamictr"+j);
	iTbody.appendChild(eTr);
}

function add_spqual()
{
    appendTbodySQ();
    xmlhttp = GetXmlHttpObject();
    
    if (xmlhttp == null)
    {
        alert("Browser does not support HTTP request");
        return;
    }        
    
    var url="aj_servicebook.php?j="+j;
    xmlhttp.onreadystatechange=stateChanged1;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
}

function stateChanged1()
{
    if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
    {	
	document.getElementById("spdynamictr"+j).innerHTML=xmlhttp.responseText;
        j++;	
    }
}

function appendTbodySI()
{
	iTbody = document.getElementById('addserv');
	eTr = document.createElement('tr');
	eTr.setAttribute("id" , "sidynamictr"+k);
	iTbody.appendChild(eTr);
}

function add_serv()
{
    appendTbodySI();
    xmlhttp = GetXmlHttpObject();
    
    if (xmlhttp == null)
    {
        alert("Browser does not support HTTP request");
        return;
    }        
    
    var url="aj_servicebook.php?k="+k;
    xmlhttp.onreadystatechange=stateChanged2;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);
}

function stateChanged2()
{
    if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
    {	
	document.getElementById("sidynamictr"+k).innerHTML=xmlhttp.responseText;
        k++;	
    }
}

function delete_row(id,auto_inc,type)
{
    xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null)
    {
        alert ("Browser does not support HTTP Request");
	return;
    }
    auto_inc1 = auto_inc;
    //alert(auto_inc1);
    var url="aj_servicebook.php?id="+id+"&type="+type;
    xmlhttp.onreadystatechange=stateChanged3;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null);    
}

function stateChanged3()
{    
if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
{    
    document.getElementById(auto_inc1).innerHTML=xmlhttp.responseText;
}
}


function GetXmlHttpObject()
{
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        return new XMLHttpRequest();
    }
    if (window.ActiveXObject)
    {
        // code for IE6, IE5
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}

function toggleaddimg(switchElement)
{
    if (switchElement == '0')
        document.getElementById('addimage').style.visibility = 'hidden';
    else if (switchElement == '1')
        document.getElementById('addimage').style.visibility = 'visible';
}