<?php
session_start();

if (!isset($_SESSION[user]) && !isset($_SESSION[ou]))
{
    echo "<body style=\"background-image: url('images/numbers.png');\" ><br /><br /><center><h3>Your Session has Expired. Close this window and Login again.</h3></center></body>";
}
elseif ($_SESSION[ou] == 'Staff')
{
    header("Location: colmation_staff.php");
}
//elseif ($_SESSION[ou] == 'FE')
//{    
//    header("Location: colmation_festudent.php");
//}
elseif ( $_SESSION[ou] == 'CE' || $_SESSION[ou] == 'EXTC' || $_SESSION[ou] == 'IT' || $_SESSION[ou] == 'MECH' || $_SESSION[ou] == 'FE') 
{
    header("Location: colmation_student.php");
}
?>
