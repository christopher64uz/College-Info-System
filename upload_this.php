<?php

//  This file has been CREATED by Christopher Uz to allow Uploading of different files
// 
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$Stud_ID = $_REQUEST["Stud_ID"];
$type = $_REQUEST["type"];
$extension = $_REQUEST["extension"];

$directory = dirname(__FILE__);

if ($type == 'photo')
{
    //  Change the path accordingly on server   
    $uploadfile = "../colmation/students_images/$Stud_ID.jpg";
}
else 
{
    $uploadfile = "$directory/students_docs/$Stud_ID/$type.$extension";
}

//$uploadfile = $uploaddir . basename($_FILES['file']['name']);

//echo "$uploadfile<br /><pre>";
//echo "File Type : ".$_FILES['upload_file']['type']."<br />";

if (!is_dir('students_docs/'.$Stud_ID))
{    
    mkdir("students_docs/$Stud_ID");
}

if($_FILES['upload_file']['type'] == 'image/jpeg' && ($type == 'photo' || $type == 'sign' || $type == 'lc'))
{    
	if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile))
	{
		shell_exec("chmod 755 $uploadfile");
  		echo "<center><h3>File ";
                if ($type == 'photo')
                    echo $Stud_ID.".".$extension;
                else 
                    echo $type.".".$extension;
                echo " was successfully uploaded.</h3>";
                if ($type == 'photo')
                    echo "<img src='../colmation/students_images/$Stud_ID.jpg' width='125' height='150'>";
                else
                    echo "<img src='students_docs/$Stud_ID/$type.jpg' width='125' height='150'>";                
		echo "<br /><br /><A href='javascript:window.close();'>Close This Window</a></center>";
	}
	else
	{
  		echo "Possible file upload attack!\n";
		echo "Error : ".$_FILES['upload_file']['error']."<br />";
  		echo 'Here is some more debugging info:';
  		print_r($_FILES);
	}
}
elseif($_FILES['upload_file']['type'] == 'application/pdf')
{    
	if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $uploadfile))
	{
		shell_exec("chmod 755 $uploadfile");
  		echo "<center><h3>File $type.$extension was successfully uploaded.</h3><img src='images/$type.jpg' width='125' height='150'>";
		echo "<br /><br /><A href='javascript:window.close();'>Close This Window</a></center>";
	}
	else
	{
  		echo "Possible file upload attack!\n";
		echo "Error : ".$_FILES['upload_file']['error']."<br />";
  		echo 'Here is some more debugging info:';
  		print_r($_FILES);
	}
}
else
{
	echo "</pre>Could Not Upload File<br /><br />Only JPG/PDF files are allowed<br /><br />Click <a href='javascript:history.go(-1)'>here to go back";
}
print "</pre>";

?>
