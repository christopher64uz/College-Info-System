<?php
session_start();

if (!isset($_SESSION[user]) && $_SESSION[ou] != 'CE' && $_SESSION[ou] != 'EXTC' && $_SESSION[ou] != 'IT' && $_SESSION[ou] != 'MECH' && $_SESSION[ou] != 'FE')
{
    echo "<body style=\"background-image: url('images/numbers.png');\" ><br /><br /><center><h3>Your Session has Expired. Close this window and Login again.</h3></center></body>";
}
else
{
//echo $_SESSION[ou];
//echo $_SESSION[user];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- Written By Christopher Uzhuthuval using OO PHP-->
<html>
<head>

<script language='JavaScript' src='scripts/calendar/calendar_db.js'></script>
<link rel='stylesheet' href='scripts/calendar/calendar.css'>

<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/inst_lookup.js" desc="AJAX Code for elicitation of Institute's Names"></script>
<link type="text/css" href="css/colmation.css" rel="stylesheet" />

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<title>ColMation - Office Automation for DBIT</title>

</head>


<body style="background-image: url('images/numbers.png');">
<?php
	include_once 'conf/DB.php';
        include_once 'classes/Student.php';
        
        $connDB = new DB();
        $connDB->connectDB();
        
        if ($_SESSION[ou] == 'FE')
        {
            $student_id = $_SESSION[user];
        }    
        else
        {    
            $studObj = new Student();
            $student_id = $studObj->findStudID($_SESSION[user]);
        }
        
        $sql_stud_details = mysql_query("SELECT * FROM student_details WHERE Stud_ID = '$student_id'") or die ("Error : ".mysql_error());
        $res_stud_details = mysql_fetch_array($sql_stud_details);
        
        $sql_morestud_details = mysql_query("SELECT * FROM student_more_details WHERE Stud_ID = '$student_id'") or die ("Error : ".mysql_error()); 
        $res_morestud_details = mysql_fetch_array($sql_morestud_details);
        
        $sql_studprev_qual = mysql_query("SELECT * FROM student_prev_qual WHERE Stud_ID = '$student_id'") or die ("Error : ".mysql_error());
        $res_studprev_qual = mysql_fetch_array($sql_studprev_qual);
?>

<form action="colmation_student_update.php" method="post" name="form" onsubmit="return validate_all()">
  
  <div style="text-align: center;"><a name="PerD"></a>

  <h3>ColMation - College Automation System</h3>
  
  <h4>[ Create / Update Student Record ]</h4>
  
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

    <tbody>

      <tr>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); font-weight: bold; background-color: rgb(255, 255, 255); text-align: center;" padding="7px"><a href="#PerD">[&nbsp;&nbsp;Personal Details &nbsp; ]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#AD" >[Academic Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#HD" >[Health Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ParD" >[Parent Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#RD" >[Reference Details]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#UF" >[Upload Files]</a></td>

      </tr>

      <tr align="center">
        <td colspan="6" rowspan="1" class="one">
        <table style="width: 1000px; height: 540px;">
          <tbody style="text-align: center;">
            <tr>
              <td style="text-align: right;"><b>Student ID</b></td>
              <td>:</td>
              <td style="text-align: left;"><b><?php echo $student_id; ?></b><input type="hidden" name="student_id" value="<?php echo $student_id;?>" /></td>
              <td style="text-align: right"><b>LDAP (Y: Drive) Username </b> : </td>
              <td style="text-align: left"><b><?php echo $_SESSION[user];?></b><input type="hidden" name="ldap_username" value="<?php echo $_SESSION[user];?>" /></td>

            </tr>
            <tr>
              <td style="text-align: right;"><b>Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left" colspan="5"><input size="50" name="ln" type="text" title="Name" value="<?php echo $res_stud_details[Name]; ?>"> <i>* As in Higher School Certificate / Diploma </i></td>
            </tr>
            <tr>               
              <td style="text-align: right;"><b>First Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left"><input name="fn" type="text" title="First Name" value="<?php echo $res_morestud_details[firstname]; ?>"></td>
              <td style="text-align: right;"><b>Middle Name</b> : </td>              
              <td style="color:red; text-align:left"><input name="mn" type="text" title="Middle Name" value="<?php echo $res_morestud_details[middlename]; ?>"></td>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Surname</b></td>
              <td>:</td>
              <td style="color:red; text-align:left"><input name="sn" type="text" title="Surname" value="<?php echo $res_morestud_details[surname]; ?>"></td>
              <td style="text-align: right;"><b>Gender</b> : </td>
              <td style="text-align: left">
		Male <input name="gender" value="Male" title="Gender" type="radio" <?php if ($res_stud_details[Sex] == 'M' || $res_stud_details[Sex] == 'Male') echo "checked = checked" ?>>
		Female <input name="gender" value="Female" title="Gender" type="radio" <?php if ($res_stud_details[Sex] == 'F' || $res_stud_details[Sex] == 'Female') echo "checked = checked" ?>>
	     </td>    
            </tr>
            <tr>
              <td style="text-align: right;"><b>Date of Birth</b></td>
              <td>:</td>
              <td align='left'><input type='text' size='9' title="Date of Birth" name='dob' value='<?php  if ($res_stud_details[DOB] != '0000-00-00') echo $res_stud_details[DOB]; else echo date('Y-m-d'); ?>' />
              	<script language='Javascript'>
		new tcal({'formname': 'form', 'controlname': 'dob'});
		</script>
              </td>
              <td style="text-align: right;"><b>Email Address </b>:</td>
              <td align='left'><input value="<?php echo $res_stud_details[Email]; ?>" name="email" type="text" title="E-Mail"></td>
            </tr>

            <tr align="right">
              <td style="background-color: rgb(245, 245, 245); text-align: left;"><b>[ ADDRESS ]<br></b></td>
            </tr>        
        <?php 
            if ($res_stud_details[Local] != " " && $res_stud_details[Local] != "-, -, -" && $res_stud_details[Local] != "")
            {
        ?>        
                <tr>
                <td style="text-align: right; background-color: rgb(245, 245, 245);"><b>Local</b></td>
                <td style="background-color: rgb(245, 245, 245);">:</td>
                <td style="background-color: rgb(245, 245, 245);" colspan="3" align="left"><input value="<?php echo $res_stud_details[Local]; ?>" size="85" name="local_address" type="text" title="Local Address"></td>
                </tr>
        <?php
            }
            else {            
        ?>
              <tr>
              <td style="text-align: right; background-color: rgb(245, 245, 245);"><b>Local</b></td>
              <td style="background-color: rgb(245, 245, 245);">:</td>
              <td style="background-color: rgb(245, 245, 245);"><input value="" name="local_" type="text" title="Local Address"></td>
              <td style="background-color: rgb(245, 245, 245);">
		City : <input value="" type="text" name="local_city" title="Local City">
              </td>
              <td style="background-color: rgb(245, 245, 245);">
              
              <select name="local_state" title="Local State">
              <option value="-">[ Select State ] </option>
              <option value="Andhra Pradesh">Andhra Pradesh </option>
              <option value="Arunachal Pradesh">Arunachal
Pradesh </option>
              <option value="Assam">Assam </option>
              <option value="Bihar"> Bihar </option>
              <option value="Chhattisgarh">Chhattisgarh </option>
              <option value="Goa">Goa </option>
              <option value="Gujarat">Gujarat </option>
              <option value="Haryana">Haryana </option>
              <option value="Himachal Pradesh"> Himachal Pradesh </option>
              <option value="Jammu Kashmir">Jammu Kashmir </option>
              <option value="Jharkhand"> Jharkhand </option>
              <option value="Karnataka">Karnataka </option>
              <option value="Kerala"> Kerala </option>
              <option value="Madhya Pradesh">Madhya Pradesh </option>
              <option value="Maharashtra"> Maharashtra </option>
              <option value="Manipur">Manipur </option>
              <option value="Meghalaya">Meghalaya </option>
              <option value="Mizoram"> Mizoram </option>
              <option value="Nagaland">Nagaland </option>
              <option value="Orissa"> Orissa </option>
              <option value="Punjab"> Punjab </option>
              <option value="Rajasthan">Rajasthan </option>
              <option value="Sikkim"> Sikkim </option>
              <option value="Tamil Nadu">Tamil Nadu </option>
              <option value="Tripura"> Tripura </option>
              <option value="Uttar Pradesh">Uttar Pradesh </option>
              <option value="Uttaranchal">Uttaranchal </option>
              <option value="West Bengal">West Bengal </option>
              </select>
              </td>
            </tr>
            <?php
            } 
            if ($res_stud_details[Native] != " " && $res_stud_details[Native] != "-, -, -" && $res_stud_details[Native] != "")
            {
        ?>        
                <tr>
                <td style="text-align: right; background-color: rgb(245, 245, 245);"><b>Native</b></td>
                <td style="background-color: rgb(245, 245, 245);">:</td>
                <td style="background-color: rgb(245, 245, 245);" colspan="3" align="left"><input value="<?php echo $res_stud_details[Native]; ?>" size="85" name="native_address" type="text" title="Native Address"></td>
                </tr>
        <?php
            }
            else {            
        ?>            
              <tr>
              <td style="text-align: right; background-color: rgb(245, 245, 245);"><b>Native</b></td>
              <td style="background-color: rgb(245, 245, 245);">:</td>
              <td style="background-color: rgb(245, 245, 245);"><input value="" name="native_" type="text" title="Native Address"></td>
              <td style="background-color: rgb(245, 245, 245);">
		City : <input value="" type="text" name="native_city" title="Native Place/City">
              </td>
              <td style="background-color: rgb(245, 245, 245);">
              <select name="native_state" title="Native State">
              <option value="-">[ Select State ]</option>
              <option value="Andhra Pradesh">Andhra Pradesh </option>
              <option value="Arunachal Pradesh">Arunachal Pradesh </option>
              <option value="Assam">Assam </option>
              <option value="Bihar"> Bihar </option>
              <option value="Chhattisgarh">Chhattisgarh </option>
              <option value="Goa">Goa </option>
              <option value="Gujarat">Gujarat </option>
              <option value="Haryana">Haryana </option>
              <option value="Himachal Pradesh"> Himachal Pradesh </option>
              <option value="Jammu Kashmir">Jammu Kashmir </option>
              <option value="Jharkhand"> Jharkhand </option>
              <option value="Karnataka">Karnataka </option>
              <option value="Kerala"> Kerala </option>
              <option value="Madhya Pradesh">Madhya Pradesh </option>
              <option value="Maharashtra"> Maharashtra </option>
              <option value="Manipur">Manipur </option>
              <option value="Meghalaya">Meghalaya </option>
              <option value="Mizoram"> Mizoram </option>
              <option value="Nagaland">Nagaland </option>
              <option value="Orissa"> Orissa </option>
              <option value="Punjab"> Punjab </option>
              <option value="Rajasthan">Rajasthan </option>
              <option value="Sikkim"> Sikkim </option>
              <option value="Tamil Nadu">Tamil Nadu </option>
              <option value="Tripura"> Tripura </option>
              <option value="Uttar Pradesh">Uttar Pradesh </option>
              <option value="Uttaranchal">Uttaranchal </option>
              <option value="West Bengal">West Bengal </option>
              </select>
              </td>
              </tr>
         <?php
            }
         ?>
            <tr>
              <td style="text-align: right;"><b>Telephone No</b></td>
              <td>:</td>
              <td align='left'><input value="<?php echo $res_stud_details[Contact_No]?>" name="phn" type="text" title="Telephone Number"></td>
              <td style="text-align: right;"><b>Mobile No </b> : </td>
              <td align='left'><input value="<?php echo $res_morestud_details[mobile_no];?>" name="mob_no" type="text" title="Mobile Number"></td>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Nationality</b></td>
              <td>:</td>
              <td align='left'><input value="<?php echo $res_stud_details[Nationality];?>" name="Nation" type="text" title="Nationality"></td>              
              <?php 
                    if ($res_stud_details[Domicile] == " " || $res_stud_details[Domicile] == "-" || $res_stud_details[Domicile] == "")
                    {
              ?>
              <td style="text-align: right;"><b>Domicile</b> :
              <span id="domicile" style="text-align:left" />
              <input name="crap" type="radio" onclick="document.form.domicile1.disabled=false;document.form.domicile2.disabled=true;document.form.domicile1.value=''" title="Domicile 1"> Indian
              <select name="domicile1">
              <option value="-">[ Select State ] </option>
              <option value="Andhra Pradesh">Andhra Pradesh </option>
              <option value="Arunachal Pradesh">Arunachal Pradesh </option>
              <option value="Assam">Assam </option>
              <option value="Bihar"> Bihar </option>
              <option value="Chhattisgarh">Chhattisgarh </option>
              <option value="Goa">Goa </option>
              <option value="Gujarat">Gujarat </option>
              <option value="Haryana">Haryana </option>
              <option value="Himachal Pradesh"> Himachal Pradesh </option>
              <option value="Jammu Kashmir">Jammu Kashmir </option>
              <option value="Jharkhand"> Jharkhand </option>
              <option value="Karnataka">Karnataka </option>
              <option value="Kerala"> Kerala </option>
              <option value="Madhya Pradesh">Madhya Pradesh </option>
              <option value="Maharashtra"> Maharashtra </option>
              <option value="Manipur">Manipur </option>
              <option value="Meghalaya">Meghalaya </option>
              <option value="Mizoram"> Mizoram </option>
              <option value="Nagaland">Nagaland </option>
              <option value="Orissa"> Orissa </option>
              <option value="Punjab"> Punjab </option>
              <option value="Rajasthan">Rajasthan </option>
              <option value="Sikkim"> Sikkim </option>
              <option value="Tamil Nadu">Tamil Nadu </option>
              <option value="Tripura"> Tripura </option>
              <option value="Uttar Pradesh">Uttar Pradesh </option>
              <option value="Uttaranchal">Uttaranchal </option>
              <option value="West Bengal">West Bengal </option>
              </select>
              </td>
              <td>
	      <input name="crap" type="radio" onclick="document.form.domicile2.disabled=false;document.form.domicile1.disabled=true;document.form.domicile2.value=''" title="Domicile 2"> Other <input size="10" value="" type="text" name="domicile2">
              <input type="hidden" name="domicile" value="" title="Domicile">
              </td>
              <?php
                }
                else 
                {
                ?>
              <td style="text-align: right;"><b>Domicile</b> : </td>
              <td align='left'><input value="<?php echo $res_stud_details[Domicile];?>" name="n_domicile" type="text" title="Domicile State"></td>
              <?php
                }
              ?>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Religion</b></td>
              <td>:</td>
              <td align="left">
                <?php echo $res_stud_details[Religion];?>
                <input value="<?php echo $res_stud_details[Religion];?>" name="o_Religion" type="hidden" title="Religion">
                <select name="Religion" title="Religion">
                        <option value="-">[ Religion ] </option>
                        <option value="Roman Catholic">Roman Catholic</option>
                        <option value="Catholic">Catholic</option>
                        <option value="Christian">Christian</option>
                        <option value="Protestant">Protestant</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Sikh">Sikh</option>
                        <option value="Buddhist">Buddhist</option>
                        <option value="Parsi">Parsi</option>
                        <option value="Jain">Jain</option>
                        <option value="Unspecified">Unspecified</option>
                        <option value="Other">Other</option>
                </select>
               </td>
              <td style="text-align:right;"><b>Category </b>:</td>
              <td style="text-align:left">
                <?php echo $res_stud_details[Category];?>
                <input value="<?php echo $res_stud_details[Category];?>" name="o_Category" type="hidden" title="Category">  
		<select name="Category" title="Category">
			<option value="-"> [ Category ]</option> 
			<option value="Open">&nbsp;Open&nbsp;&nbsp;</option>
			<option value="OBC">&nbsp;OBC&nbsp;&nbsp;</option>
			<option value="SC / ST">&nbsp;SC / ST&nbsp;&nbsp;</option>
			<option value="VJ / NT (1, 2, 3)">&nbsp;VJ / NT (1, 2, 3)&nbsp;&nbsp;</option>
		</select>
	      </td>
            </tr>
            <tr>
                <td align="left" colspan="3"><b>Physical Handicap </b> :               
		&nbsp;&nbsp; Yes <input name="phy_hand" title="Physical Handicap" value="Yes" type="radio" <?php if ($res_morestud_details[phy_handicapped] == 'Yes') echo "checked = checked" ?>>
		&nbsp;&nbsp; No  <input name="phy_hand" title="Physical Handicap" value="No" type="radio" <?php if ($res_morestud_details[phy_handicapped] == 'No') echo "checked = checked" ?>>
                </td>
                <td style="text-align: right;"><b>Economically Backwards </b> : </td>                
                <td style="text-align: left">		
		&nbsp;&nbsp; Yes <input name="eco_back" title="Economically Backwards" value="Yes" type="radio" <?php if ($res_morestud_details[eco_backward] == 'Yes') echo "checked = checked" ?>>
		&nbsp;&nbsp; No  <input name="eco_back" title="Economically Backwards" value="No" type="radio" <?php if ($res_morestud_details[eco_backward] == 'No') echo "checked = checked" ?>>
                </td>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Place of Birth</b></td>
              <td>:</td>
              <td align="left"><input value="<?php echo $res_stud_details[POB];?>" name="POB" type="text" title="Place of Birth"></td>

              <!--<td style="text-align: right;"><b>Identification Mark :&nbsp;</b></td>

              <td><input name="IM" type="text" title="Identification Mark"></td>-->

              <td></td><td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#AD" >  NEXT >>  </a></td>

            </tr>
          </tbody>
        </table>
        </td>
      </tr>
    </tbody>
   </table>

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

  <a name="AD"></a>

  <h3>ColMation - College Automation System</h3>  
   <h4>[ Create / Update Student Record ]</h4>
  
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">
    <tbody>
      <tr>
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PerD">[Personal Details]</a></td>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); text-align: center; font-weight: bold;"><a href="#AD" >[ &nbsp; Academic
Details&nbsp; &nbsp;]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#HD" >[Health Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ParD" >[Parent Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#RD" >[Reference Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#UF" >[Upload Files]</a></td>

      </tr>


      <tr align="center">

        <td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">

        <div style="text-align: right;"></div>

        <table style="width: 943px; height: 238px;" align="center">
          <tbody>

            <tr>
              <td style="text-align: right;"><b>Student ID</b></td>
              <td>:</td>
              <td style="text-align: left;"><b><?php echo $student_id; ?></b></td>	    
              <td style="text-align: right;"><b>Form No </b>:</td>
              <td><input value="<?php echo $res_stud_details[Form_No];?>" name="form_num" type="text" title="Form No"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><b>Date Of Joining (DBIT)</b></td>
                <td>:</td>
                <td align='left'><input type='text' size='9' name='doj' title="Date of Joining" value='<?php if ($res_stud_details[doj] != '0000-00-00') echo $res_stud_details[doj]; else echo date('Y-m-d'); ?>' />
                <script language='Javascript'>
                new tcal({'formname': 'form', 'controlname': 'doj'});
                </script> 
                </td>
<!--            <td style="text-align: right;"><b>Date of Leaving (DBIT)</b>:</td>                
                <td align='left'><input type='text' size='9' name='dol' title="Date of Leaving" value='<?php// if ($res_stud_details[dol] != '0000-00-00') echo $res_stud_details[dol]; ?>' />
              	<script language='Javascript'>
		new tcal({'formname': 'form', 'controlname': 'dol'});
		</script>
                </td>-->
            </tr>
            <?php 
            if ($res_stud_details[prev_inst] != ' ' && $res_stud_details[prev_inst] != '-')
            {
            ?>    
                <tr bgcolor="#f5f5f5">
                    <td style="text-align:right"><b>Previous Institute </b></td> <td>:</td> <td colspan="3"><?php echo $res_stud_details[prev_inst];?><input value="<?php echo $res_stud_details[prev_inst];?>"  type="hidden" name="o_prev_inst" ></td>
                </tr>
            <?php
            }
            ?>
            <tr bgcolor="#f5f5f5">
                <td style="text-align:right"><b>Institute Search</b></td> <td>:</td> <td colspan="3"><input value="" size="70" type="text" name="inst_search" onkeyup="lookup_inst_ajax()"></td>
            </tr>

            <tr bgcolor="#f5f5f5">
		<td style="text-align: right;"><b>Previous Institute</b></td>
		<td>:</td>
		<td colspan="3">
		<input type="hidden" name="other_college" value="0">
		<input type="radio" name="inst" onclick="document.form.prev_inst_1.disabled=false;document.form.prev_inst_2.disabled=true;document.form.other_college.value='0';">
                <div id="inst_select">&nbsp;&nbsp;&nbsp;&nbsp;
		<select size="4" name="prev_inst_1" title="Previous Institute" style="width:600px;padding:10px">
	<?php
		$query_inst = "select * from prev_inst_master order by prev_inst_name;";
		$rs = mysql_query($query_inst);
		$errors = mysql_error();
		if($errors != "")
			die("<script>alert(\"Could not perform query $query_inst : $errors\");</script>");		
	
		while ($row = mysql_fetch_array($rs, MYSQL_NUM))
		{
    			echo "<option onclick='update_inst()' value=\"$row[0]\">$row[0]</option>";
    		}
	?>
		</select></div><br />
		<input type="radio" name="inst" onclick="document.form.prev_inst_1.disabled=true;document.form.prev_inst_2.disabled=false;document.form.other_college.value='1';"> 
		Other : <input value="" type="text" name="prev_inst_2" title="Previous Institute">
		@ Location : <input value="" type="text" name="prev_addr">
		<input type="hidden" name="prev_inst" title="Previous Institute">
		</td>
		</tr>
                <tr>
                <td style="text-align: right;"><b>AIEEE Score</b></td>
                <td>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[aieee_score];?>" name="aieee" type="text" title="AIEEE Score"></td>
                <td style="text-align: right;"><b>CET Score </b>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[cet_score];?>" name="cet" type="text" title="CET Score"></td>
                </tr>
                <tr>
                <td style="text-align: right;"><b>HSC Aggregate</b></td>
                <td>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[hsc_aggregate];?>" name="hsc_agg" type="text" title="HSC Aggregate"></td>
                <td style="text-align: right;"><b>HSC Outof </b>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[hsc_outof];?>" name="hsc_outof" type="text" title="HSC Outof"></td>
                </tr>
                <tr>
                <td style="text-align: right;"><b>PCM Total</b></td>
                <td>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[pcm_total];?>" name="pcm_total" type="text" title="PCM Total"></td>
                <td style="text-align: right;"><b>PCM Outof </b>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[pcm_outof];?>" name="pcm_outof" type="text" title="PCM Outof"></td>
                </tr>
                <tr>
                <td style="text-align: right;"><b>SSC Aggregate</b></td>
                <td>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[ssc_aggregate];?>" name="ssc_agg" type="text" title="SSC Aggregate"></td>
                <td style="text-align: right;"><b>SSC Outof </b>:</td>
                <td align ="left"><input value="<?php echo $res_studprev_qual[ssc_outof];?>" name="ssc_outof" type="text" title="SSC Outof"></td>
                </tr>
                <tr>
                <td style="text-align: right;"><b>Diploma Aggregate</b></td>
                <td>:</td>
                <td align ="left"><input value="<?php if ($res_studprev_qual[diploma_aggregate] != '0' && $res_studprev_qual[diploma_aggregate] != '') echo $res_studprev_qual[diploma_aggregate]; else echo 'If Applicable'; ?>" onblur="if(this.value.length == 0) this.value='If Applicable';" onclick="if(this.value == 'If Applicable') this.value='';" name="dip_agg" type="text" title="Diploma Aggregate"></td>
                <td style="text-align: right;"><b>Diploma Outof </b>:</td>
                <td align ="left"><input value="<?php if ($res_studprev_qual[diploma_outof] != '0' && $res_studprev_qual[diploma_outof] != '') echo $res_studprev_qual[diploma_outof]; else echo 'If Applicable'; ?>" onblur="if(this.value.length == 0) this.value='If Applicable';" onclick="if(this.value == 'If Applicable') this.value='';" name="dip_outof" type="text" title="Diploma Outof"></td>
                </tr>              
                <tr>
                    <td></td><td></td><td></td>
		<td></td><td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#HD" >  NEXT >>  </a></td>
            </tr>

          </tbody>
        
        </table>


        </td>


      </tr>


    
    </tbody>
  
  </table>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <a name="HD"></a>
  
  <h3>ColMation - College Automation System</h3>

  
   <h4>[ Create / Update Student Record ]</h4>

  
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

    <tbody>

      <tr>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PerD">[Personal Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#AD" >[Academic Details]</a></td>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); text-align: center; font-weight: bold;"><a href="#HD" >[ &nbsp; Health
Details&nbsp; &nbsp;]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ParD" >[Parent Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#RD" >[Reference Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#UF" >[Upload Files]</a></td>
      </tr>

      <tr align="center">
        <td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
        <div style="text-align: right;"></div>
        <table style="width: 1000px; height: 400px;" align="center">
          <tbody>
           <tr>
              <td style="text-align: right;"><b>Student ID</b></td>
              <td>:</td>
              <td><b><?php echo $student_id; ?></b></td>
              <td style="text-align: right;"><b>Blood Group</b></td>
              <td>:</td>
              <td>
                <input value="<?php echo $res_stud_details[Blood_Grp];?>"  type="hidden" name="o_blood_grp" >  
		<?php if ($res_stud_details[Blood_Grp] != ' ' && $res_stud_details[Blood_Grp] != '-') echo $res_stud_details[Blood_Grp];?>
			<select name="blood_grp" title="Blood Group">
                                <option value="-">[ Blood Group ]</option>
				<option value="A+">A+</option>
				<option value="A-">A-</option>
				<option value="B+">B+</option>
				<option value="B-">B-</option>
				<option value="AB+">AB+</option>	
				<option value="AB-">AB-</option>
				<option value="O+">O+</option>
				<option value="O-">O-</option>
			</select>		
	      </td>
	   </tr>
           <tr>
		<td style="text-align: right;"><b>Thalassemia Patient</b></td>
 		<td>:</td>
		<td>
			<select name='thal'>
				<option value='-'>[ Type ]</option>
				<option value='NO' <?php if ($res_stud_details[Thalassemia] == 'NO') echo "selected=selected"; ?>> NOT Thalassemic &nbsp;</option>
				<option value='Major' <?php if ($res_stud_details[Thalassemia] == 'Major') echo "selected=selected"; ?>> Major </option>
				<option value='Minor' <?php if ($res_stud_details[Thalassemia] == 'Minor') echo "selected=selected"; ?>> Minor </option>
			</select>
		</td>
                <td style="text-align: right;"><b>Allergies</b></td>
                <td>:</td>
                <td rowspan='2'><textarea name="allergies" rows='3' cols='23'><?php echo $res_stud_details[Allergies];?></textarea></td>
           </tr>     
           <tr>     
                <?php $doc_name = explode('Dr. ',$res_stud_details[doc_name]);?>
                <td style="text-align: right;"><b>Name</b></td>
                <td>:</td>
                <td>Dr. <input value="<?php echo $doc_name[1]; ?>" name="doc_name" type="text"></td>
	   </tr>
            <tr>
                <td style="text-align: right;"><b>Doc's Contact No</b></td>
                <td>:</td>
                <td><input value="<?php echo $res_stud_details[doc_contact]; ?>" name="doc_contact" title="Doc's Contact No" type="text"></td>
                <td style="text-align: right;"><b>Doc's Email ID</b></td>
                <td>:</td>
                <td><input value="<?php echo $res_stud_details[doc_email]; ?>" name="doc_email" title="Doc's Email" type="text"></td>
            </tr>
            <tr>
                <td colspan ="6">
                    <b>Have you been diagnosed with any of the following</b> 
                </td>                
            </tr>
            <tr>
                <td colspan ="3">
                <input type="checkbox" name="diagnosis[]" value="ADHD" <?php if ($res_morestud_details[att_def_hyp_dis] == "Yes") 
                    echo "checked=checked"; ?> /><b>Attention Deficit Hyperactivity Disorder</b><br />  
                <input type="checkbox" name="diagnosis[]" value="LD" <?php if ($res_morestud_details[learn_disability] == "Yes") 
                    echo "checked=checked"; ?> /><b>Learning Disability</b><br />  
                <input type="checkbox" name="diagnosis[]" value="D" <?php if ($res_morestud_details[depression] == "Yes") 
                    echo "checked=checked"; ?> /><b>Depression</b><br /> 
                </td>
                <td><b>If Other Specify</b></td>
                <td>:</td>
                <td><textarea title="Other Diagnosis" rows="3" cols="23" name="other_diagnosis"><?php echo $res_morestud_details[other_diagnosis];?></textarea></td> 
            </tr>
            <tr>
                <td colspan="4">
                    <b>Have you been advised for psychiatric medicines. If yes, please specify the condition / ailment you are taking and provide the names of the medicine.</b> 
                </td>
                <td>:</td>
                <td><textarea title="Psychiatric Medicine" rows="3" cols="23" name="psychiatric_medicine"><?php echo $res_morestud_details[psychiatric_medicine];?></textarea></td>                
            </tr>                       
	<tr><td></td><td></td><td></td><td></td><td></td>
	<td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ParD" >  NEXT >>  </a></td>
      </tr>
            </tbody>
          </table>
        </td>
	</tr>	
    </tbody>
  </table>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <a name="ParD"></a>

  
  <h3>ColMation - College Automation System</h3>

  
  <h4>[ Create / Update Student Record ]</h4>

  
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">
    <tbody>
      <tr>
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PerD">[Personal Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#AD" >[Academic Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#HD" >[Health Details]</a></td>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); text-align: center; font-weight: bold;"><a href="#ParD" >[ &nbsp; Parent
Details &nbsp; ]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#RD" >[Reference Details]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#UF" >[Upload Files]</a></td>
      </tr>

      <tr align="center">
        <td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
        <table style="width: 933px; height: 425px;" align="center">
          <tbody>
            <tr>
              <td style="text-align: right;"><b>Student Id</b></td>
              <td>:</td>
              <td><b><?php echo $student_id; ?></b></td>
            </tr>

	    <tr>
		<td colspan="7"><br /><b>[ Father's Info. ]</b><hr /></td>
	    </tr>
            <?php 
            if($res_stud_details[F_NAME] != ' ' && $res_stud_details[F_NAME] != '-' && $res_stud_details[F_NAME] != '')  
            {
            ?>
            <tr>
              <td style="text-align: right;"><b>Father's Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left" colspan="4"><input value="<?php echo $res_stud_details[F_NAME];?>" title="Father's Name" size="45" name="fname" type="text">&nbsp;<i>* Lastname Firstname Format</i></td>
            </tr>
            <?php
            }
            else
            {    
            ?>
            <tr>
              <td style="text-align: right;"><b>Father's Lastname</b></td>
              <td>:</td>
              <td><input value="" name="fln" type="text" title="Father's Lastname"></td>

              <td style="text-align: right;"><b>Father's Firstname</b></td>
              <td>:</td>
              <td><input value="" name="ffn" type="text" title="Father's Firstname"></td>
            </tr>
            <?php
            }
            ?>
            <tr>
              <td style="text-align: right;"><b>Occupation</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[F_Occupation];?>" name="foccupation" type="text" title="Father's Occupation"></td>
              <td style="text-align: right;"><b>Office Address</b></td>
              <td>:</td>
              <td rowspan="2"><textarea title="Father's Off Add" rows="3" cols="23" name="foff_address"><?php echo $res_stud_details[F_Office_address];?></textarea></td> 
            </tr>
            <tr>
              <td style="text-align: right;"><b>Telephone No</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[F_Contact_No];?>" name="fphn" type="text" title="Father's Contact"></td>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Mobile No</b></td>
              <td>:</td>
              <td>            
		<input value="<?php echo $res_morestud_details[f_mobile_no];?>" type="text" name="f_mobileno" title="Father's Mobile">
              </td>
              <td style="text-align: right;"><b>Email ID</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[F_Email_Id];?>" name="femail" type="text" title="Father's Email"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><b>Annual Income</b></td>
                <td>:</td>
                <td>            
                    <input value="<?php echo $res_stud_details[F_Annual_Income];?>" type="text" name="fannual_income" title="Father's Income">
                </td>
            </tr>
            <tr>
		<td colspan="7"><br /><b>[ Mother's Info. ]</b><br /><hr /></td>
	    </tr>
             <?php 
            if($res_stud_details[M_Name] != ' ' && $res_stud_details[M_Name] != '-' && $res_stud_details[M_Name] != '')  
            {
            ?>
            <tr>
              <td style="text-align: right;"><b>Mother's Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left" colspan="4"><input value="<?php echo $res_stud_details[M_Name];?>" size="45" name="mname" type="text" title="Mother's Name">&nbsp;<i>* Lastname Firstname Format</i></td>
            </tr>
            <?php
            }
            else
            {    
            ?>
            <tr>
              <td style="text-align: right;"><b>Mother's Lastname</b></td>
              <td>:</td>
              <td><input value="" name="mln" type="text" title="Mother's Lastname"></td>
              <td style="text-align: right;"><b>Mother's Firstname</b></td>
              <td>:</td>
              <td><input value="" name="mfn" type="text" title="Mother's Firstname"></td>
            </tr>
             <?php
            }
            ?>
            <tr>
              <td style="text-align: right;"><b>Occupation</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[M_Occupation];?>" name="moccupation" type="text" title="Mother's Occupation"></td>
              <td style="text-align: right;"><b>Office Address</b></td>
              <td>:</td>
              <td rowspan="2"><textarea rows="3" cols="23" name="moff_address" title="Mother's Off Add"><?php echo $res_stud_details[M_Office_address];?></textarea></td>
            </tr>

            <tr>
              <td style="text-align: right;"><b>Telephone No</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[M_Contact_No];?>" name="mphn" type="text" title="Mother's Telephone"></td>
            </tr>

            <tr>
              <td style="text-align: right;"><b>Mobile No</b></td>
	      <td>:</td>
              <td>		
		<input value="<?php echo $res_morestud_details[m_mobile_no];?>" type="text" name="m_mobileno" title="Mother's Mobile">
              </td>
              <td style="text-align: right;"><b>Email ID</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[M_Email_Id];?>" name="memail" type="text" title="Mother's Email"></td>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Annual Income</b></td>
	      <td>:</td>
              <td>		
		<input value="<?php echo $res_stud_details[M_Annual_Income];?>" type="text" name="mannual_income" title="Mother's Income">
              </td>            
              <td></td><td></td>
		<td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#RD" >  NEXT >>  </a></td>
      	
	</tr>
          </tbody>
        </table>
        </td>
      </tr>
    </tbody>
  </table>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <a name="RD"></a>

  
  <h3>ColMation - College Automation System</h3>

  
 <h4>[ Create / Update Student Record ]</h4>

  
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">


    <tbody>


      <tr>


        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PerD">[Personal Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#AD" >[Academic Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#HD" >[Health Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ParD" >[Parent Details]</a></td>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); text-align: center; font-weight: bold;"><a href="#RD" >
                [ &nbsp; Reference Details  &nbsp;]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#UF" >[Upload Files]</a></td>
      </tr>

      <tr align="center">

        <td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
        
        <div style="text-align: right;"></div>
        
        <table style="width: 1000px; height: 33fbhvgn60
               0px;" align="center">
          <tbody>

            <tr>
              <td style="text-align: right;"><b>Student Id</b></td>
              <td>:</td>
              <td><b><?php echo $student_id; ?></b></td>
            </tr>
             <?php 
            if($res_stud_details[Ref_Name1] != ' ' && $res_stud_details[Ref_Name1] != '-' && $res_stud_details[Ref_Name1] != '- -')  
            {
            ?>
            <tr>
              <td style="text-align: right;"><b>Ref1 Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left" colspan="4"><input value="<?php echo $res_stud_details[Ref_Name1];?>" size="45" name="ref1name" type="text">&nbsp;<i>* Lastname Firstname Format</i></td>
            </tr>
            <?php
            }
            else
            {    
            ?>
            <tr>
              <td style="text-align: right;" ><b>Ref1 LastName</b></td>
              <td>:</td>
              <td><input value="" name="ref1ln" type="text"></td>

              <td style="text-align: right; "><b>Ref1 Firstname</b></td>
              <td>:</td>
              <td><input value="" name="ref1fn" type="text"></td>
            </tr>
             <?php
            }
            ?>
            <tr>
              <td style="text-align: right; "><b>Contact No</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[Contact_No1];?>" name="ref1phn" type="text" title="Ref1 Conatact"></td>
              <td style="text-align: right; "><b>Address</b></td>
              <td>:</td>
              <td rowspan="2"><textarea rows="3" cols="23" name="ref1address"><?php echo $res_stud_details[Address1];?></textarea></td>
            </tr>

            <tr>
              <td style="text-align: right; "><b>Relationship with student</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[Relation1];?>" name="ref1relation" type="text"></td>
            </tr>
            <?php 
            if($res_stud_details[Ref_Name2] != ' ' && $res_stud_details[Ref_Name2] != '-' && $res_stud_details[Ref_Name2] != '- -')  
            {
            ?>
            <tr>
              <td style="text-align: right;"><b>Ref2 Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left" colspan="4"><input value="<?php echo $res_stud_details[Ref_Name2];?>" size="45" name="ref2name" type="text">&nbsp;<i>* Lastname Firstname Format</i></td>
            </tr>
            <?php
            }
            else
            {    
            ?>
            <tr>
              <td style="text-align: right; "><b>Ref2
LastName</b></td>
              <td>:</td>
              <td><input value="" name="ref2ln" type="text"></td>
              <td style="text-align: right; "><b>Ref2
Firstname</b></td>
              <td>:</td>
              <td><input value="" name="ref2fn" type="text"></td>
            </tr>
            <?php
            }
            ?>
            <tr>
              <td style="text-align: right; "><b>Contact No</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[Contact_No2];?>" name="ref2phn" type="text" title="Ref2 Contact"></td>
              <td style="text-align: right; "><b>Address</b></td>
              <td>:</td>
              <td rowspan="2"><textarea rows="3" cols="23" name="ref2address"><?php echo $res_stud_details[Address2];?></textarea></td>
            </tr>

            <tr>
              <td style="text-align: right; "><b>Relationship with student</b></td>
              <td>:</td>
              <td><input value="<?php echo $res_stud_details[Relation2];?>" name="ref2relation" type="text"></td>
            </tr>
            
            <tr>
                <td></td><td></td><td></td><td></td><td></td>
                <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#UF" >  NEXT >>  </a></td>
            </tr>
            
          </tbody>
        </table>
        </td>
      </tr>
    </tbody>
  </table>

  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>
  
   <a name="UF"></a>

  
  <h3>ColMation - College Automation System</h3>

  
   <h4>[ Create / Update Student Record ]</h4>

  
  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

    <tbody>

      <tr>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PerD">[Personal Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#AD" >[Academic Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#HD" >[Health Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ParD" >[Parent Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#RD" >[Reference Details]</a></td>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); text-align: center; font-weight: bold;"><a href="#UF" >
                [ &nbsp; Upload Files  &nbsp;]</a></td>
      </tr>

      <tr align="center">

        <td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
        
        <div style="text-align: right;"></div>
        
        <table style="width: 1000px; height: 500px;" align="center">
          <tbody>

            <tr>
              <td style="text-align: right;"><b>Student Id</b></td>
              <td>:</td>
              <td><b><?php echo $student_id; ?></b></td>
            </tr>
            <?php                
                $out = shell_exec("ls ../colmation/students_images/$student_id.jpg");

                if($out != "")	
                    $img_filename = "../colmation/students_images/$student_id.jpg";
                else
                    $img_filename = "images/no_image.jpg";                
                //----------------                
                $out = shell_exec("ls students_docs/$student_id/ssc.pdf");

                if($out != "")	
                    $ssc_filename = "images/ssc.jpg";
                else
                    $ssc_filename = "images/no_file.jpg";
                //----------------
                $out = shell_exec("ls students_docs/$student_id/hsc.pdf");

                if($out != "")	
                    $hsc_filename = "images/hsc.jpg";
                else
                    $hsc_filename = "images/no_file.jpg";
                //----------------
                $out = shell_exec("ls students_docs/$student_id/lc.pdf");

                if($out != "")	
                    $lc_filename = "images/lc.jpg";
                else
                    $lc_filename = "images/no_file.jpg";
                //----------------
                $out = shell_exec("ls students_docs/$student_id/cet.pdf");

                if($out != "")	
                    $cet_filename = "images/cet.jpg";
                else
                    $cet_filename = "images/no_file.jpg";
                //----------------
                $out = shell_exec("ls students_docs/$student_id/others.pdf");

                if($out != "")	
                    $others_filename = "images/others.jpg";
                else
                    $others_filename = "images/no_file.jpg";
                //----------------
                $out = shell_exec("ls students_docs/$student_id/sign.jpg");

                if($out != "")	
                    $sign_filename = "students_docs/$student_id/sign.jpg";
                else
                    $sign_filename = "images/no_image.jpg";
                //----------------                
                
            ?>
            <tr>
              <td style="text-align: right;" ><b>Photograph</b></td>
              <td>:</td>
              <?php
              echo "<td><img name='photo' src='$img_filename' width='90' height='100' ondblclick=\"w1=window.open('upload_files.php?Stud_ID=$student_id&type=photo','image_upload','width=400,height=600');\" /></td>";
              ?>
              <td style="text-align: right; "><b>SSC</b></td>
              <td>:</td>
              <?php
              echo "<td><img name='ssc' src='$ssc_filename' width='90' height='100' ondblclick=\"w1=window.open('upload_files.php?Stud_ID=$student_id&type=ssc','image_upload','width=400,height=600');\" /></td>";
              ?>
            </tr>
            
            <tr>
              <td style="text-align: right; "><b>HSC</b></td>
              <td>:</td>
              <?php
              echo "<td><img name='hsc' src='$hsc_filename' width='90' height='100' ondblclick=\"w1=window.open('upload_files.php?Stud_ID=$student_id&type=hsc','image_upload','width=400,height=600');\" /></td>";
              ?>
              <td style="text-align: right; "><b>LC</b></td>
              <td>:</td>
              <?php
              echo "<td><img name='lc' src='$lc_filename' width='90' height='100' ondblclick=\"w1=window.open('upload_files.php?Stud_ID=$student_id&type=lc','image_upload','width=400,height=600');\" /></td>";
              ?>
            </tr>

            <tr>
              <td style="text-align: right; "><b>CET</b></td>
              <td>:</td>
              <?php
              echo "<td><img name='cet' src='$cet_filename' width='90' height='100' ondblclick=\"w1=window.open('upload_files.php?Stud_ID=$student_id&type=cet','image_upload','width=400,height=600');\" /></td>";
              ?>
              <td style="text-align: right;"><b>Others</b></td>
              <td>:</td>
              <?php
              echo "<td><img name='others' src='$others_filename' width='90' height='100' ondblclick=\"w1=window.open('upload_files.php?Stud_ID=$student_id&type=others','image_upload','width=400,height=600');\" /></td>";
              ?>
            </tr>  
            <tr>
              <td style="text-align: right; "><b>Signature</b></td>
              <td>:</td>
              <?php
              echo "<td><img name='sign' src='$sign_filename' width='90' height='100' ondblclick=\"w1=window.open('upload_files.php?Stud_ID=$student_id&type=sign','image_upload','width=400,height=600');\" /></td>";
              ?>
              
            </tr>           
            
          </tbody>
        </table>
        </td>
      </tr>
    </tbody>
  </table>

  <br/><input value="Submit All Data" style="background-color: rgb(85, 85, 85); color: white;" type="submit">
  </div>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>


  <br>
  </form>
</body>
</html>
<?php
}
?>
