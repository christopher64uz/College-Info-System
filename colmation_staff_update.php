<?php
/*
 * This Code has been created by Christopher Uzhuthuval
 * for the Project College Information System.
 */

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
include_once 'classes/Staff.php';

$connDB = new DB();
$connDB->connectDB();

$staffObj = new Staff();

echo "<body style=\"background-image: url('images/numbers.png');\"  />";

// echo "<table border='1' cellpadding='3'><tr>";

// ... PROCURING TAB 1 ... PERSONAL DETAILS

// echo "<td>";

$empid = $_POST[empid];

$ldap_username = $_POST[ldap_username];
/*
$stream_name[1] = "Electronics and Telecommunication";
$stream_name[2] = "Computer Engineering";
$stream_name[3] = "Information Technology";
$stream_name[4] = "Mechanical Engineering";

$stream = $stream_name[$s_branch];
*/
// echo "<hr /><b> PERSONAL DETAILS</b><hr /><br /><br />";

// echo $empid."<br />";

// echo $ldap_username."<br />";
/*
//// echo $branch."<br />";

//// echo $stream."<br />";
*/
$ename = mysql_real_escape_string($_POST[ln]);

// echo $ename."<br />";

$firstname = mysql_real_escape_string($_POST[fn]);

// echo $firstname."<br />";

$middlename = mysql_real_escape_string($_POST[mn]);

// echo $middlename."<br />";

$surname = mysql_real_escape_string($_POST[sn]);

// echo $surname."<br />";

$gender = $_POST[gender];

// echo $gender."<br >";

$dob = $_POST[dob];

// echo $dob."<br />";

$email = $_POST[email];

// echo $email."<br />";

if (isset ($_POST[local_address]))
{
    $local_address = mysql_real_escape_string($_POST[local_address]);
}
else
{
    $local_address = mysql_real_escape_string($_POST[local_].", ".$_POST[local_city].", ".$_POST[local_state]);    
}

// echo $local_address."<br />";

if (isset ($_POST[permnt_address]))
{
    $permnt_address = mysql_real_escape_string($_POST[permnt_address]);
}
else
{
    $permnt_address = mysql_real_escape_string($_POST[permnt_].", ".$_POST[permnt_city].", ".$_POST[permnt_state]);    
}

// echo $permnt_address."<br />";

$mobile_no = $_POST[mobile];

// echo $mobile_no."<br />";

$landln_no = $_POST[landline];

// echo $landln_no."<br />";

$emrgncy_no = $_POST[emergency];

// echo $emrgncy_no."<br />";

$phy_hand = $_POST[phy_hand];

// echo $phy_hand."<br />";

$nationality = $_POST[nationality];

// echo $nationality."<br />";

if (!isset ($_POST[n_domicile]))
{
    $domicile = $_POST[domicile];
}
else 
{
    $domicile = $_POST[n_domicile];
}

// echo "$domicile<br />";

if ($_POST[Religion] != '-')
{
    $religion = $_POST[Religion];
}
else 
{
    $religion = $_POST[o_Religion];
}

// echo $religion."<br />";

if ($_POST[Category] != '-')
{
    $category = $_POST[Category];
}
else 
{
    $category = $_POST[o_Category];
}

// echo $category."<br />";

$fax_phone = $_POST[fax];

//  echo $fax_phone."<br />";

// echo "</td>";

// ...  TAB 1 ENDS HERE!!


// ... PROCURING TAB 2 ... WORKS DETAILS

// echo "<td>";

// echo "<hr /><b>WORKS DETAILS</b><hr /><br /><br />";

if ($_POST[pwd] == 'Change Log IN Password')
{
    $password = $_POST[old_pwd];
}
else 
{
    // echo $_POST[pwd] . " - ";
    $password = md5($_POST[pwd]);
}

// echo $password."<br />";

$department = $_POST[dept];

// echo $department."<br />";

$designation = $_POST[desig];

// echo $designation."<br />";

$pan = $_POST[PAN];

// echo $pan."<br />";

$pf = mysql_real_escape_string($_POST[PF]);

// echo $pf."<br />";

$bank_name = mysql_real_escape_string($_POST[b_name]);

// echo $bank_name."<br />";

$bank_branch = mysql_real_escape_string($_POST[b_branch]);

//  echo $bank_branch."<br />";

$bank_accntno = $_POST[accnt_num];

// echo $bank_accntno."<br />";

$iifc_code = mysql_real_escape_string($_POST[iifc]);

//  echo $iifc_code."<br />";

$doj = $_POST[doj];

// echo $doj."<br />";

$passport_no = $_POST[passport];

// echo $passport_no."<br />";

$passport_issuedate = $_POST[issdt];

// echo $passport_issuedate."<br />";

$passport_expirydate = $_POST[expdt];

// echo $passport_expirydate."<br />";

$fy_commsubteacher = $_POST[fy_commsubteacher];

// echo $fy_commsubteacher."<br />";

$fy_commsubject = mysql_real_escape_string($_POST[fy_commsubject]);

// echo $fy_commsubject."<br />";

// echo "</td>";

// ... TAB 2 ENDS HERE

// ... PROCURING TAB 3 ... EXPERIENCE DETAILS

// echo "<td>";

// echo "<hr /><b>EXPERIENCE DETAILS</b><hr /><br /><br />";

$doctrate_deg = $_POST[doctrate_deg];

// echo $doctrate_deg."<br/>";

$pg_deg = mysql_real_escape_string($_POST[pg_deg]);

// echo $pg_deg."<br/>";

$ug_deg = mysql_real_escape_string($_POST[ug_deg]);

// echo $ug_deg."<br/>";

$other_qual = mysql_real_escape_string($_POST[other_qual]);

// echo $other_qual."<br/>";

$area_special = mysql_real_escape_string($_POST[area_special]);

// echo $area_special."<br/>";

$diploma = mysql_real_escape_string($_POST[diploma]);

//  echo $diploma."<br/>";

$total_work_years = $_POST[work_years];

//  echo $total_work_years."<br/>";

$teach_years = $_POST[teach_years];

// echo $teach_years."<br/>";

$research_years = $_POST[research_years];

// echo $research_years."<br/>";

$nat_public = mysql_real_escape_string($_POST[nat_public]);

// echo $nat_public."<br/>";

$patents = mysql_real_escape_string($_POST[patents]);

// echo $patents."<br/>";

$no_pg_proj = $_POST[no_pg_proj];

// echo $no_pg_proj."<br/>";

$no_doc_proj = $_POST[no_doc_proj];

// echo $no_doc_proj."<br/>";

$inter_public = mysql_real_escape_string( $_POST[inter_public]);

// echo $inter_public."<br/>";

$books_pub = mysql_real_escape_string($_POST[books_pub]);

// echo $books_pub."<br/>";

// echo "</td>";

// ... TAB 3 ENDS HERE

// ... PROCURING TAB 4 ... PARENT DETAILS

// echo "<td>";

// echo "<hr /><b>PARENT DETAILS</b><hr /><br /><br />";

$mother_tongue = mysql_real_escape_string($_POST[mother_tongue]);

//  echo $mother_tongue."<br/>";

$birth_place = mysql_real_escape_string($_POST[birth_place]);

//  echo $birth_place."<br/>";

$marital = $_POST[marital];

// echo $marital."<br/>";

$spouse_name = mysql_real_escape_string($_POST[spouse_name]);

// echo $spouse_name."<br/>";

if (isset ($_POST[fname]))
{
    $fname = mysql_real_escape_string($_POST[fname]);
}
else
{
    $fname = mysql_real_escape_string($_POST[fln]." ".$_POST[ffn]);
}

// echo $fname."<br />";

if (isset ($_POST[mname]))
{
    $mname = mysql_real_escape_string($_POST[mname]);
}
else
{
    $mname = mysql_real_escape_string($_POST[mln]." ".$_POST[mfn]);
}

// echo $mname."<br />";

if (isset ($_POST[guardian_residence]))
{
    $guardian_address = mysql_real_escape_string($_POST[guardian_residence]);
}
else
{
    $guardian_address = mysql_real_escape_string($_POST[guardian_].", ".$_POST[guardian_city].", ".$_POST[guardian_state]);    
}

//  echo $guardian_address."<br />";

$fmly_no = $_POST[fmly_no];

// echo $fmly_no."<br/>";

$depndnt_no = $_POST[depndnt_no];

// echo $depndnt_no."<br/>";

// echo "</td>";

// ... TAB 4 ENDS HERE

// ... PROCURING TAB 5 ...OTHER DETAILS
// echo "<td>";

// echo "<hr /><b>OTHER DETAILS</b><hr /><br /><br />";

$height = $_POST[height];

//  echo $height."<br/>";

$personal_marks_of_identification = mysql_real_escape_string($_POST[mark_identify]);

//  echo $personal_marks_of_identification."<br/>";

$medical_examination_date = $_POST[med_exam_date];

//  echo $medical_exmination_date."<br/>";

$medical_examination_result = mysql_real_escape_string($_POST[med_exam_result]);

//  echo $medical_exmination_result."<br/>";

$medical_certification_date = $_POST[med_cert_date];

//  echo $medical_certification_date."<br/>";

$medical_certification_number = $_POST[med_cert_no];

//  echo $medical_certification_number."<br/>";

$medical_authority_name = mysql_real_escape_string($_POST[med_auth_name]);

//  echo $medical_authority_name."<br/>";

$medical_authority_designation = mysql_real_escape_string($_POST[med_auth_desig]);

//  echo $medical_authority_designation."<br/>";

$aicte_expert = $_POST[aicte_expert];

// echo $aicte_expert."<br />";

$aicte_grant = $_POST[aicte_grant];

// echo $aicte_grant."<br /><br />";

// echo "</td>";

// echo "</tr></table>";

if(($_FILES["file"]["type"] != "")&& ($_FILES["file"]["type"] !=null)&&($_FILES["file"]["size"] !=0)&&($_FILES["file"]["size"] != null))
{
    if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg")|| ($_FILES["file"]["type"] == "image/png"))&& ($_FILES["file"]["size"] < 2000000))
    {
        if ($_FILES["file"]["error"] > 0)
        {            
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {            
                //echo $_FILES["file"]["name"] . " already exists. ";               
                unlink("staff_images/".$empid.".jpg");   //deleting the already existing file
                move_uploaded_file($_FILES["file"]["tmp_name"],"staff_images/".$empid);            
        }
    }
    else
    {
        echo "Image could not be uploaded <br />Reason: Invalid file<br />";
    }
}

// ... END OF TAB 5 ....!!

$staffObj->setStaffPersonalDetails($empid,$ldap_username,$ename,$gender,$dob,$email,$local_address,
            $permnt_address,$mobile_no,$landln_no,$emrgncy_no,$nationality,$religion,$category,$password,
            $passport_no,$passport_issuedate,$passport_expirydate,$marital,$spouse_name);

$staffObj->setStaffWorkDetails($doj,$department,$designation,$pan,$pf,$bank_name,$bank_accntno);

$staffObj->setFamilyDetails($fmly_no,$depndnt_no);

$staffObj->setStaffOtherDetails($firstname,$middlename,$surname,$mname,$fname,$domicile,$phy_hand,$fax_phone,
        $bank_branch,$iifc_code,$fy_commsubteacher,$fy_commsubject,$aicte_expert,$aicte_grant);

$staffObj->setStaffHighEducDetails($doctrate_deg,$pg_deg,$ug_deg,$diploma,$other_qual,$area_special,$teach_years,
            $research_years,$total_work_years,$nat_public,$patents,$no_pg_proj,$no_doc_proj,$inter_public,$books_pub);

$staffObj->setStaffServiceBookRecord($guardian_address,$birth_place,$mother_tongue,$medical_examination_date,
        $medical_examination_result,$height,$personal_marks_of_identification,$medical_certification_number,
        $medical_certification_date,$medical_authority_name,$medical_authority_designation);

$staffObj->UpdateStaffPersonalDetails();

$staffObj->InsertUpdateStaffWorkDetails();

$staffObj->InsertUpdateStaffFamilyDetails();

$staffObj->InsertUpdateStaffOtherDetails();

$staffObj->InsertUpdateStaffHighEducDetails();

$staffObj->InsertUpdateStaffServiceBookRecord();

// ... PROCURING TAB 6 ...SERVICE BOOK DETAILS
// echo "<td>";

// echo "<hr /><b>SERVICE BOOK DETAILS</b><hr /><br /><br />";

//  Qualifications Entry

//  Update old rows
$count = $_POST[q_no];   

for ($i = 1; $i < $count; $i++)
{
	$q_id = $_POST['oq_id'.$i];
        $q_exam_cert = mysql_real_escape_string($_POST['oq_exam_cert'.$i]);
        $q_sp_sub = mysql_real_escape_string($_POST['oq_sp_sub'.$i]);
        $q_univ_name = mysql_real_escape_string($_POST['oq_univ_name'.$i]);
        $q_pass_year = $_POST['oq_pass_year'.$i];
        $q_class = mysql_real_escape_string($_POST['oq_class'.$i]);
        $q_distinction = $_POST['oq_distinction'.$i];
        
        $staffObj->setStaffQualification($q_id, $q_exam_cert, $q_sp_sub, $q_univ_name, $q_pass_year, $q_class, $q_distinction);
        $staffObj->UpdateStaffQualification();   
}

//  Insert new rows
$i = 1;
$flag = 1;
do
{
    if(($_POST['q_exam_cert'.$i]=='0') || ($_POST['q_exam_cert'.$i] == 'NULL') || ($_POST['q_exam_cert'.$i] == ''))
    {
        $flag = 0;
    }
    else
    {
        $q_id = NULL;
        $q_exam_cert = mysql_real_escape_string($_POST['q_exam_cert'.$i]);
        $q_sp_sub = mysql_real_escape_string($_POST['q_sp_sub'.$i]);
        $q_univ_name = mysql_real_escape_string($_POST['q_univ_name'.$i]);
        $q_pass_year = $_POST['q_pass_year'.$i];
        $q_class = mysql_real_escape_string($_POST['q_class'.$i]);
        $q_distinction = $_POST['q_distinction'.$i];

        $staffObj->setStaffQualification($q_id, $q_exam_cert, $q_sp_sub, $q_univ_name, $q_pass_year, $q_class, $q_distinction);
        $staffObj->InsertStaffQualification();
        $i++;
    }
} while($flag==1);

//  Special Qualifications Entry

//  Update old rows
$count = $_POST[sp_no];   

for ($i = 1; $i < $count; $i++)
{
	$sp_id = $_POST['osp_id'.$i];
        $sp_exam_cert = mysql_real_escape_string($_POST['osp_exam_cert'.$i]);        
        $sp_univ_name = mysql_real_escape_string($_POST['osp_univ_name'.$i]);
        $sp_pass_year = $_POST['osp_pass_year'.$i];
        $sp_class = mysql_real_escape_string($_POST['osp_class'.$i]);
        $sp_distinction = $_POST['osp_distinction'.$i];
        
        $staffObj->setStaffSpecialQualification($sp_id, $sp_exam_cert, $sp_univ_name, $sp_pass_year, $sp_class, $sp_distinction);
        $staffObj->UpdateStaffSpecialQualification();
}

//  Insert new rows
$i = 1;
$flag = 1;
do
{
    if(($_POST['sp_exam_cert'.$i]=='0') || ($_POST['sp_exam_cert'.$i] == 'NULL') || ($_POST['sp_exam_cert'.$i] == ''))
    {
        $flag = 0;
    }
    else
    {
        $sp_id = NULL;
        $sp_exam_cert = mysql_real_escape_string($_POST['sp_exam_cert'.$i]);        
        $sp_univ_name = mysql_real_escape_string($_POST['sp_univ_name'.$i]);
        $sp_pass_year = $_POST['sp_pass_year'.$i];
        $sp_class = mysql_real_escape_string($_POST['sp_class'.$i]);
        $sp_distinction = $_POST['sp_distinction'.$i];

        $staffObj->setStaffSpecialQualification($sp_id, $sp_exam_cert, $sp_univ_name, $sp_pass_year, $sp_class, $sp_distinction);
        $staffObj->InsertStaffSpecialQualification();
        $i++;
    }
} while($flag==1);

//  Service in other Institute Entry

//  Update old rows
$count = $_POST[si_no];   

for ($i = 1; $i < $count; $i++)
{
	$si_id = $_POST['osi_id'.$i];
        $si_inst_name = mysql_real_escape_string($_POST['osi_inst_name'.$i]);        
        $si_serv_from = $_POST['osi_serv_from'.$i];
        $si_serv_to = $_POST['osi_serv_to'.$i];
        $si_leave_from = $_POST['osi_leave_from'.$i];
        $si_leave_to = $_POST['osi_leave_to'.$i];
        $si_basic_pay = $_POST['osi_basic_pay'.$i];

        $staffObj->setStaffInstituteExperience($si_id, $si_inst_name, $si_serv_from, $si_serv_to, $si_leave_from, $si_leave_to, $si_basic_pay);
        $staffObj->UpdateStaffInstituteExperience();
}

//  Insert new rows
$i = 1;
$flag = 1;
do
{
    if(($_POST['si_inst_name'.$i]=='0') || ($_POST['si_inst_name'.$i] == 'NULL') || ($_POST['si_inst_name'.$i] == ''))
    {
        $flag = 0;
    }
    else
    {
        $si_id = NULL;
        $si_inst_name = mysql_real_escape_string($_POST['si_inst_name'.$i]);        
        $si_serv_from = $_POST['si_serv_from'.$i];
        $si_serv_to = $_POST['si_serv_to'.$i];
        $si_leave_from = $_POST['si_leave_from'.$i];
        $si_leave_to = $_POST['si_leave_to'.$i];
        $si_basic_pay = $_POST['si_basic_pay'.$i];

        $staffObj->setStaffInstituteExperience($si_id, $si_inst_name, $si_serv_from, $si_serv_to, $si_leave_from, $si_leave_to, $si_basic_pay);
        $staffObj->InsertStaffInstituteExperience();
        $i++;
    }
} while($flag==1);

// ... END OF TAB 6 ....!!

echo "<br /><br /><br /><center><h3>The Update for LDAP Username : <font color='red'>$ldap_username</font> has been successfully completed. <br />Please Close this window and Logout of the system.</h3></center>";

echo "</body>";
}

?>