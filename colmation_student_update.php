<?php
session_start();

if (!isset($_SESSION[user]) && $_SESSION[ou] != 'Staff')
{
    echo "<body style=\"background-image: url('images/numbers.png');\" ><br /><br /><center><h3>Your Session has Expired. Close this window and Login again.</h3></center></body>";
}
else
{
?>

<style>
textarea
{
	border-style:solid;
	border-color:#d5d5d5;
	-moz-border-radius:5px;
	padding:5px;
}
</style>
<?php
//... colmation_insert.php

include_once 'conf/DB.php';
include_once 'classes/Student.php';

$connDB = new DB();
$connDB->connectDB();

$studentObj = new Student();

echo "<body style=\"background-image: url('images/numbers.png');\"  />";

//echo "<table border='1' cellpadding='3'><tr>";

// ... PROCURING TAB 1 ... PERSONAL DETAILS

//echo "<td>";

$student_id = $_POST[student_id];

$ldap_username = $_POST[ldap_username];
/*
$s_branch = substr($ldap_username, 0, 1);

$branch_name[1] = "EXTC";
$branch_name[2] = "COMP";
$branch_name[3] = "IT";
$branch_name[4] = "MECH";

$branch = $branch_name[$s_branch];

$stream_name[1] = "Electronics and Telecommunication";
$stream_name[2] = "Computer Engineering";
$stream_name[3] = "Information Technology";
$stream_name[4] = "Mechanical Engineering";

$stream = $stream_name[$s_branch];
*/
//echo "<hr /><b> PERSONAL DETAILS</b><hr /><br /><br />";

//echo $student_id."<br />";

//echo $ldap_username."<br />";
/*
//echo $branch."<br />";

//echo $stream."<br />";
*/
$name = mysql_real_escape_string(strtoupper($_POST[ln]));

//echo $name."<br />";

$firstname = mysql_real_escape_string(strtoupper($_POST[fn]));

//echo $firstname."<br />";

$middlename = mysql_real_escape_string(strtoupper($_POST[mn]));

//echo $middlename."<br />";

$surname = mysql_real_escape_string(strtoupper($_POST[sn]));

//echo $surname."<br />";

$gender = $_POST[gender];

//echo $gender."<br >";

$dob = $_POST[dob];

//echo $dob."<br />";

$email = $_POST[email];

//echo $email."<br />";

if (isset ($_POST[local_address]))
{
    $local_address = mysql_real_escape_string($_POST[local_address]);
}
else
{
    $local_address = mysql_real_escape_string($_POST[local_].", ".$_POST[local_city].", ".$_POST[local_state]);    
}

//echo $local_address."<br />";

if (isset ($_POST[native_address]))
{
    $native_address = mysql_real_escape_string($_POST[native_address]);
}
else
{
    $native_address = mysql_real_escape_string($_POST[native_].", ".$_POST[native_city].", ".$_POST[native_state]);    
}

//echo $native_address."<br />";

$telephone_number = $_POST[phn];

//echo $telephone_number."<br />";

$mobile_no = $_POST[mob_no];

//echo $mobile_no."<br />";

$nationality = $_POST[Nation];

//echo $nationality."<br />";

if (!isset ($_POST[n_domicile]))
{
    $domicile = $_POST[domicile];
}
else 
{
    $domicile = $_POST[n_domicile];
}

//echo "$domicile<br />";

if ($_POST[Religion] != '-')
{
    $religion = $_POST[Religion];
}
else 
{
    $religion = $_POST[o_Religion];
}

//echo $religion."<br />";

if ($_POST[Category] != '-')
{
    $category = $_POST[Category];
}
else 
{
    $category = $_POST[o_Category];
}

//echo $category."<br />";

$phy_hand = $_POST[phy_hand];

//echo $phy_hand."<br />";

$eco_back = $_POST[eco_back];

//echo $eco_back."<br />";

$place_of_birth = mysql_real_escape_string($_POST[POB]);

//echo $place_of_birth."<br />";

//echo "</td>";
//$identification_mark = $_POST["IM"];
////echo "$identification_mark<br />";

// ...  TAB 1 ENDS HERE!!


// ... PROCURING TAB 2 ... ACADEMIC DETAILS

//echo "<td>";

//echo "<hr /><b>ACADEMIC DETAILS</b><hr /><br /><br />";

$form_num = $_POST[form_num];

//echo $form_num."<br />";

$doj = $_POST[doj];

//echo $doj."<br />";

//$dol = $_POST[dol];

//echo $dol."<br />";

if ($_POST[prev_inst] != NULL && $_POST[prev_inst] != " ")
{
    $prev_inst = mysql_real_escape_string($_POST[prev_inst]);    
}
else 
{    
    $prev_inst = mysql_real_escape_string($_POST[o_prev_inst]);
}
//echo $prev_inst."<br />";

if($_POST[other_college] == '1' && $_POST[prev_inst_2] != NULL  && strlen(trim($_POST[prev_inst_2])) != 0)
{
    $prev_inst = mysql_real_escape_string($_POST[prev_inst_2]);
    $prev_inst_add = mysql_real_escape_string($_POST[prev_addr]);
}

$aieee = $_POST[aieee];

//echo $aieee."<br />";

$cet = $_POST[cet];

//echo $cet."<br />";

$hsc_agg = $_POST[hsc_agg];

//echo $hsc_agg."<br />";

$hsc_outof = $_POST[hsc_outof];

//echo $hsc_outof."<br />";

$pcm_total = $_POST[pcm_total];

//echo $pcm_total."<br />";

$pcm_outof = $_POST[pcm_outof];

//echo $pcm_outof."<br />";

$ssc_agg = $_POST[ssc_agg];

//echo $ssc_agg."<br />";

$ssc_outof = $_POST[ssc_outof];

//echo $ssc_outof."<br />";

$dip_agg = $_POST[dip_agg];

//echo $dip_agg."<br />";

$dip_outof = $_POST[dip_outof];

//echo $dip_outof."<br />";

//echo "</td>";

// ... TAB 2 ENDS HERE

// ... PROCURING TAB 3 ... HEALTH DETAILS

//echo "<td>";

//echo "<hr /><b>HEALTH DETAILS</b><hr /><br /><br />";

if ($_POST[blood_grp] != '-')
{
    $blood_grp = $_POST[blood_grp];
}
else
{
    $blood_grp = $_POST[o_blood_grp];
}

//echo $blood_grp."<br />";

$allergies = mysql_real_escape_string($_POST[allergies]);

//echo $allergies."<br />";

$thal = $_POST[thal];

//echo $thal."<br />";

$doc_name = "Dr. ".mysql_real_escape_string(strtoupper($_POST[doc_name]));

//echo $doc_name."<br />";

$doc_contact = $_POST[doc_contact];

//echo $doc_contact."<br />";

$doc_email = $_POST[doc_email];

//echo $doc_email."<br />";

$diagnosis = $_POST[diagnosis];

$att_def_hyp_dis = 'No';
$learn_disability = 'No';
$depression = 'No';

if (!empty($diagnosis))
{
    $count = count($diagnosis);
    
    for ($i = 0; $i < $count; $i++)
    {
        if ($diagnosis[$i] == 'ADHD')
            $att_def_hyp_dis = 'Yes';
        elseif ($diagnosis[$i] == 'LD')
            $learn_disability = 'Yes';
        elseif ($diagnosis[$i] == 'D')
            $depression = 'Yes';
    }
}    

//echo $att_def_hyp_dis."<br />";
//echo $learn_disability."<br />";
//echo $depression."<br />";

$other_diagnosis = mysql_real_escape_string($_POST[other_diagnosis]);

//  echo $other_diagnosis;

$psychiatric_medicine = mysql_real_escape_string($_POST[psychiatric_medicine]);

//  echo $psychiatric_medicine;

//echo "</td>";

// ... TAB 3 ENDS HERE

// ... PROCURING TAB 4 ... PARENT DETAILS

//echo "<td>";

//echo "<hr /><b>PARENT DETAILS</b><hr /><br /><br />";

if (isset ($_POST[fname]))
{
    $fname = mysql_real_escape_string(strtoupper($_POST[fname]));
}
else
{
    $fname = mysql_real_escape_string(strtoupper($_POST[fln]." ".$_POST[ffn]));
}

//echo $fname."<br />";

$foccupation = mysql_real_escape_string($_POST[foccupation]);

//echo $foccupation."<br />";

$foff_address = mysql_real_escape_string($_POST[foff_address]);

//echo $foff_address."<br />";

$fphn = $_POST[fphn];

//echo $fphn."<br />";

$f_mobileno = $_POST[f_mobileno];

//echo $f_mobileno."<br />";

$fannual_income = $_POST[fannual_income];

//echo $fannual_income."<br />";

$femail = $_POST[femail];

//echo $femail."<br /><hr />";

if (isset ($_POST[mname]))
{
    $mname = mysql_real_escape_string(strtoupper($_POST[mname]));
}
else
{
    $mname = mysql_real_escape_string(strtoupper($_POST[mln]." ".$_POST[mfn]));
}

//echo $mname."<br />";

$moccupation = mysql_real_escape_string($_POST[moccupation]);

//echo $moccupation."<br />";

$mphn = $_POST[mphn];

//echo $mphn."<br />";

$m_mobileno = $_POST[m_mobileno];

//echo $m_mobileno."<br />";

$moff_address = mysql_real_escape_string($_POST[moff_address]);

//echo $moff_address."<br />";

$mannual_income = $_POST[mannual_income];

//echo $mannual_income."<br />";

$memail = $_POST[memail];

//echo $memail."<br />";

//echo "</td>";

// ... TAB 4 ENDS HERE

// ... PROCURING TAB 5 ...REFERENCE DETAILS

//echo "<td>";

//echo "<hr /><b>REFERENCE DETAILS</b><hr /><br /><br />";

if (isset ($_POST[ref1name]))
{
    $ref1name = mysql_real_escape_string(strtoupper($_POST[ref1name]));
}
else
{
    $ref1name = mysql_real_escape_string(strtoupper($_POST[ref1ln]." ".$_POST[ref1fn]));
}

//echo $ref1name."<br />";

$ref1phn = $_POST[ref1phn];

//echo $ref1phn."<br />";

$ref1address = mysql_real_escape_string($_POST[ref1address]);

//echo $ref1address."<br />";

$ref1relation = mysql_real_escape_string($_POST[ref1relation]);

//echo $ref1relation."<br /><br />";

if (isset ($_POST[ref2name]))
{
    $ref2name = mysql_real_escape_string(strtoupper($_POST[ref2name]));
}
else
{
    $ref2name = mysql_real_escape_string(strtoupper($_POST[ref2ln]." ".$_POST[ref2fn]));
}

//echo $ref2name."<br />";

$ref2phn = $_POST[ref2phn];

//echo $ref2phn."<br />";

$ref2address = mysql_real_escape_string($_POST[ref2address]);

//echo $ref2address."<br />";

$ref2relation = mysql_real_escape_string($_POST[ref2relation]);

//echo $ref2relation."<br /><br />";

//echo "</td>";

//echo "</tr></table>";

// ... END OF TAB 5 ....!!

$studentObj->setStudentDetails($student_id,$ldap_username,$name,$gender,
            $dob,$local_address,$native_address,$telephone_number,$nationality,$domicile,
            $religion,$category,$place_of_birth,$email,$form_num,$prev_inst,$doj,
            $blood_grp,$allergies,$thal,$doc_name,$doc_contact,$doc_email,$fname,$foccupation,
            $fphn,$foff_address,$fannual_income,$femail,$mname,$moccupation,$mphn,$moff_address,
            $mannual_income,$memail,$ref1name,$ref1phn,$ref1address,$ref1relation,$ref2name,
            $ref2phn,$ref2address,$ref2relation);

$studentObj->setMoreStudentDetails($firstname,$middlename,$surname,$mobile_no,$phy_hand,$eco_back,
            $f_mobileno,$m_mobileno,$att_def_hyp_dis,$learn_disability,$depression,$other_diagnosis,
            $psychiatric_medicine);

$studentObj->setPrevStudentQual($aieee,$cet,$hsc_agg,$hsc_outof,$pcm_total,$pcm_outof,$ssc_agg,
        $ssc_outof,$dip_agg,$dip_outof);

$studentObj->InsertUpdateStudentDetails();

$studentObj->InsertUpdateMoreStudentDetails();

$studentObj->InsertUpdatePrevStudentQual();

if($_POST[other_college] == '1' && $_POST[prev_inst_2] != NULL  && strlen(trim($_POST[prev_inst_2])) != 0)
{        
        $studentObj->setPrevInstMaster($prev_inst_add);
        $studentObj->InsertUpdatePrevInstMaster();
}

echo "<br /><br /><br /><center><h3>The Update for LDAP Username : <font color='red'>$ldap_username</font> has been successfully completed. <br />Please Close this window and Logout of the system.</h3></center>";

echo "</body>";
}

?>