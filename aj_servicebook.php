<?php
/*
 * This Code has been created by Christopher Uzhuthuval
 * for the Project College Information System to include the Service Book.
 */
session_start();

include_once 'conf/DB.php';

$connDB = new DB();
$connDB->connectDB();

$i = $_GET[i];
$j = $_GET[j];
$k = $_GET[k];
$id = $_GET['id'];
$type = $_GET['type'];

if ($i)
{  
    echo "<td><input name='q_exam_cert$i' type='text' size='15' title='Examination Certificate'></td>";
    echo "<td><input name='q_sp_sub$i' type='text' size='7' title='Special Subject'></td>";
    echo "<td><input name='q_univ_name$i' type='text' size='9' title='University Name'></td>";
    echo "<td><input name='q_pass_year$i' type='text' size='5' title='Passing Year'></td>";
    echo "<td><input name='q_class$i' type='text' size='1' title='Class'></td>";    
    echo "<td>Yes<input name='q_distinction$i' type='radio' title='Distinction' value='1' />
          No<input name='q_distinction$i' type='radio' title='Distinction' value='0' checked = checked /></td>";
}

if ($j)
{  
    echo "<td><input name='sp_exam_cert$j' type='text' size='15' title='Examination Certificate'></td>"; 
    echo "<td><input name='sp_univ_name$j' type='text' size='9' title='University Name'></td>";
    echo "<td><input name='sp_pass_year$j' type='text' size='5' title='Passing Year'></td>";
    echo "<td><input name='sp_class$j' type='text' size='1' title='Class'></td>";    
    echo "<td>Yes<input name='sp_distinction$j' type='radio' title='Distinction' value='1' />
          No<input name='sp_distinction$j' type='radio' title='Distinction' value='0' checked = checked /></td>";
}

if ($k)
{  
    echo "<td><input name='si_inst_name$k' type='text' size='13' title='Name of Institution'></td>";
    echo "<td><input name='si_serv_from$k' type='text' size='4' title='Service From'></td>";
    echo "<td><input name='si_serv_to$k' type='text' size='4' title='Service To'></td>";
    echo "<td><input name='si_leave_from$k' type='text' size='4' title='Leave From'></td>";
    echo "<td><input name='si_leave_to$k' type='text' size='4' title='Leave To'></td>";
    echo "<td><input name='si_basic_pay$k' type='text' size='20' title='Basic Pay with Scale'></td>";      
}

if ($id)
{
    if ($type == 'qual')
        mysql_query("DELETE FROM staff_qualification WHERE id = '$id'") or die ("Error : ".mysql_error());
    else if ($type == 'spqual')
        mysql_query("DELETE FROM staff_special_qualification WHERE id = '$id'") or die ("Error : ".mysql_error());
    else if ($type == 'serv')
        mysql_query("DELETE FROM staff_institute_experience WHERE id = '$id'") or die ("Error : ".mysql_error());
}
?>
