/*
Function USING AJAX XMLHTTP objects to get college names in easy key presses.
*/

var xmlHttp;

function lookup_inst_ajax()
{

	str = document.form.inst_search.value;

	if (str.length==0)
	{ 
		//document.getElementById("txtHint").innerHTML="";
		return;
	}
	
	xmlHttp = GetXmlHttpObject();
	
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
				return;
	} 
	
	var url="get_inst.php?inst=" + str;
		
	xmlHttp.onreadystatechange = stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
} 

function stateChanged() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("inst_select").innerHTML = xmlHttp.responseText;
	} 
} 

function GetXmlHttpObject()
{ 
	var objXMLHttp = null;
	if (window.XMLHttpRequest)
	{
		objXMLHttp=new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return objXMLHttp;
}

function update_inst()
{
	document.form.inst_search.value = document.form.prev_inst_1.value;
	document.form.prev_inst.value = document.form.inst_search.value;
	document.form.other_college.value='0';
}