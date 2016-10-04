var xmlHttp;
var url;

//  New Code

function popup(url) 
{
 params  = 'width='+screen.width;
 params += ', height='+screen.height;
 params += ', top=0, left=0'
 params += ', fullscreen=yes';

 col_win=window.open(url,'windowname4', params);
 if (window.focus) {col_win.focus()} 
 colwin=1;
 return false;
}

function check_auth()
{
    xmlHttp = GetXmlHttpObject();
    
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP request");
        return;
    }
    
    var username = document.form.username.value;
    var password = document.form.password.value;
    
    var url = "aj_auth_ldap.php?username="+username+"&password="+password;
    //alert(url);
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function stateChanged()
{
    //alert(xmlHttp.readyState);
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")    
    {      
        //alert(xmlHttp.responseText.substring(4,8));
        if(xmlHttp.responseText.substring(4,8) == "span")
        {
            //alert("hi");
            document.getElementById("login_legend").innerHTML = "Welcome to Colmation";
            document.getElementById("result").innerHTML = "<span style='padding:5px;background-color:#dddddd;color:#223355'><b>Success</b></span><br /><br />";
            document.getElementById("user").innerHTML = document.form.username.value;
            document.getElementById("pass").innerHTML = "<i>HIDDEN</i>";

            colwin=0;
            
            document.getElementById("submit").innerHTML = xmlHttp.responseText;
            //document.getElementById("links").innerHTML = "<hr /><li><a onclick='col_win=window.open(\"colmation.php\",\"COLMATION\",\"notoolbar\");colwin=1;' onmouseover='this.style.cursor=\"pointer\"' onmouseout='this.style.cursor=\"default\"'>Update Self Info</a></li><hr />";
            document.getElementById("links").innerHTML = "<hr /><li><a onclick=\"popup('colmation.php')\">Update Self Info</a></li><hr />";
            
            document.getElementById("links").innerHTML += "<br />[ <a href='logout.php' onclick='javascript:if(colwin==1){col_win.close();colwin=0;}'>Log Out</a> ]";
        }
        else
        {
            //alert("bye");
            document.getElementById("result").innerHTML = xmlHttp.responseText;
        }
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

