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
    header("Pragma: no-cache");
    header("Cache: no-cache");
?>
<!-- Written By Christopher Uzhuthuval using OO PHP -->
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">-->
<html>
<head>
<script language='JavaScript' src='scripts/calendar/calendar_db.js'></script>
<link rel='stylesheet' href='scripts/calendar/calendar.css'>

<script language='javascript' src='scripts/validation_staff.js'></script>
<script language='javascript' src='scripts/servicebook_ajax.js'></script>
<link rel='stylesheet' type='text/css' href='css/colmation.css' />

<title>ColMation - Update Staff Details</title>

</head>

<body style="background-image: url('images/numbers.png');">

<?php
    include_once 'conf/DB.php';
    include_once 'classes/Staff.php';
      
    $connDB = new DB();
    $connDB->connectDB();
    
    $staffObj = new Staff();
    $empid = $staffObj->findEmpId($_SESSION[user]);
    
    if ($empid == '') 
    {
        echo "<body style=\"background-image: url('images/numbers.png');\" ><br /><br /><center><h3>The LDAP Username : <font color='red'>$_SESSION[user]</font> does not exist in DB.<br /> Please Contact Office.</h3></center></body>";
    }
    else
    {
        $sql_staff_perdetails = mysql_query("SELECT * FROM staff_personal_details WHERE empid = '$empid'") 
            or die("Error : ".  mysql_error());
        $res_staff_perdetails = mysql_fetch_array($sql_staff_perdetails);

        $sql_staff_workdetails = mysql_query("SELECT * FROM staff_work_details WHERE empid = '$empid'") 
            or die("Error : ".  mysql_error());
        $res_staff_workdetails = mysql_fetch_array($sql_staff_workdetails);

        $sql_staff_otherdetails = mysql_query("SELECT * FROM staff_other_details WHERE empid = '$empid'") 
            or die("Error : ".  mysql_error());
        $res_staff_otherdetails = mysql_fetch_array($sql_staff_otherdetails);

        $sql_staff_famdetails = mysql_query("SELECT * FROM staff_family_details WHERE empid = '$empid'") 
            or die("Error : ".  mysql_error());
        $res_staff_famdetails = mysql_fetch_array($sql_staff_famdetails);
        
        $sql_staff_higheducdetails = mysql_query("SELECT * FROM staff_higheduc_details WHERE empid = '$empid'") 
            or die("Error : ".  mysql_error());
        $res_staff_higheducdetails = mysql_fetch_array($sql_staff_higheducdetails);
        
        $sql_staff_servicebookrecord = mysql_query("SELECT * FROM staff_service_book_record WHERE empid = '$empid'") 
            or die("Error : ".  mysql_error());
        $res_staff_servicebookrecord = mysql_fetch_array($sql_staff_servicebookrecord);
        
        $sql_staff_qualification = mysql_query("SELECT * FROM staff_qualification WHERE empid = '$empid'")
            or die("Error : ".  mysql_error());        
        
        $sql_staff_specialqualification = mysql_query("SELECT * FROM staff_special_qualification WHERE empid = '$empid'")
            or die("Error : ".  mysql_error());        
        
        $sql_staff_instituteexperience = mysql_query("SELECT * FROM staff_institute_experience WHERE empid = '$empid'")
            or die("Error : ".  mysql_error());
        
?>    
    <form name='form' method='post' enctype="multipart/form-data" action='colmation_staff_update.php' onsubmit="return validate_all()" > 

    <div style="text-align: center;"><a name="PD"></a>

<h3>ColMation - College Automation System</h3>

<h4>[ Updating Staff Record ]</h4>

  <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

    <tbody>

      <tr>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); font-weight: bold; background-color: rgb(255, 255, 255); text-align: center;" padding="7px"><a href="#PD">[&nbsp;&nbsp;Personal Details&nbsp;&nbsp;]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#WD" >[Work Details]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ED" >[Education Details]</a></td>        

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#FD" >[Family Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#OD" >[Other Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#SB" >[Service Book Details]</a></td>
      </tr>

      <tr align="center">
        <td colspan="6" rowspan="1" class="one">
        <table style="width: 1050px; height: 540px;">
          <tbody style="text-align: center;">
            <tr>
              <td style="text-align: right;"><b>Emp ID</b></td>
              <td>:</td>
              <td style="text-align: left;"><b><?php echo $empid;?></b><input type="hidden" name="empid" value="<?php echo $empid;?>" /></td>
              <td style="text-align: right"><b>LDAP (Y: Drive) Username </b>:</td>
              <td style="text-align: left"><b><?php echo $_SESSION[user];?></b><input type="hidden" name="ldap_username" value="<?php echo $_SESSION[user];?>" /></td>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left" colspan="5"><input size="50" name="ln" type="text" title="Name" value="<?php echo $res_staff_perdetails[ename]; ?>"> <i>* Firstname Middlename Lastname </i></td>
            </tr>
            <tr>               
              <td style="text-align: right;"><b>First Name</b></td>
              <td>:</td>
              <td style="color:red; text-align:left"><input name="fn" type="text" title="First Name" value="<?php echo $res_staff_otherdetails[firstname]; ?>"></td>
              <td style="text-align: right;"><b>Middle Name</b> : </td>              
              <td style="color:red; text-align:left"><input name="mn" type="text" title="Middle Name" value="<?php echo $res_staff_otherdetails[middlename]; ?>"></td>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Surname</b></td>
              <td>:</td>
              <td style="color:red; text-align:left"><input name="sn" type="text" title="Surname" value="<?php echo $res_staff_otherdetails[surname]; ?>"></td>
              <td style="text-align: right;"><b>Gender</b> : </td>
              <td style="text-align: left">
		Male <input name="gender" value="Male" title="Gender" type="radio" <?php if ($res_staff_perdetails[gender] == 'M' || $res_staff_perdetails[gender] == 'Male') echo "checked = checked" ?>>
		Female <input name="gender" value="Female" title="Gender" type="radio" <?php if ($res_staff_perdetails[gender] == 'F' || $res_staff_perdetails[gender] == 'Female') echo "checked = checked" ?>>
	     </td>    
            </tr>
            <tr>
              <td style="text-align: right;"><b>Date of Birth</b></td>
              <td>:</td>
              <td align='left'><input type='text' size='9' title="Date of Birth" name='dob' value='<?php if ($res_staff_perdetails[dob] != '0000-00-00') echo $res_staff_perdetails[dob]; else echo date('Y-m-d'); ?>' />
              	<script language='Javascript'>
		new tcal({'formname': 'form', 'controlname': 'dob'});
		</script>
              </td>
              <td style="text-align: right;"><b>Email Address </b>:</td>
              <td align='left'><input value="<?php echo $res_staff_perdetails[email]; ?>" name="email" type="text" title="E-Mail"></td>
            </tr>           
            <tr align="right">
              <td style="background-color: rgb(245, 245, 245); text-align: right;"><b>[ ADDRESS ]<br></b></td>
            </tr>        
        <?php 
            if ($res_staff_perdetails[currnt_addr] != " " && $res_staff_perdetails[currnt_addr] != "-, -, -" && $res_staff_perdetails[currnt_addr] != "")
            {
        ?>        
                <tr>
                <td style="text-align: right; background-color: rgb(245, 245, 245);"><b>Local</b></td>
                <td style="background-color: rgb(245, 245, 245);">:</td>
                <td style="background-color: rgb(245, 245, 245);" colspan="3" align="left"><input value="<?php echo $res_staff_perdetails[currnt_addr]; ?>" size="85" name="local_address" type="text" title="Local Address"></td>
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
            if ($res_staff_perdetails[prmnt_addr] != " " && $res_staff_perdetails[prmnt_addr] != "-, -, -" && $res_staff_perdetails[prmnt_addr] != "")
            {
        ?>        
                <tr>
                <td style="text-align: right; background-color: rgb(245, 245, 245);"><b>Permanent</b></td>
                <td style="background-color: rgb(245, 245, 245);">:</td>
                <td style="background-color: rgb(245, 245, 245);" colspan="3" align="left"><input value="<?php echo $res_staff_perdetails[prmnt_addr]; ?>" size="85" name="permnt_address" type="text" title="Permanent Address"></td>
                </tr>
        <?php
            }
            else {            
        ?>            
              <tr>
              <td style="text-align: right; background-color: rgb(245, 245, 245);"><b>Permanent</b></td>
              <td style="background-color: rgb(245, 245, 245);">:</td>
              <td style="background-color: rgb(245, 245, 245);"><input value="" name="permnt_" type="text" title="Permanent Address"></td>
              <td style="background-color: rgb(245, 245, 245);">
		City : <input value="" type="text" name="permnt_city" title="Permanent Place/City">
              </td>
              <td style="background-color: rgb(245, 245, 245);">
              <select name="permnt_state" title="Permanent State">
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
              <td style="text-align: right;"><b>Mobile No</b></td>
              <td>:</td>
              <td align='left'><input value="<?php echo $res_staff_perdetails[mobile_no];?>" name="mobile" type="text" title="Mobile Number"></td>
              <td style="text-align: right;"><b>Landline No </b>:</td>
              <td align='left'><input value="<?php echo $res_staff_perdetails[landln_no];?>" name="landline" type="text" title="Landline Number"></td>
              </tr>
              <tr>
              <td style="text-align: right;"><b>Emergency No</b></td>
              <td>:</td>
              <td align='left'><input value="<?php echo $res_staff_perdetails[emrgncy_no];?>" name="emergency" type="text" title="Emergency Number"></td>
              <td align='right'><b>Physical Handicap </b> : </td>
              <td align="left">                
		&nbsp; Yes <input name="phy_hand" title="Physical Handicap" value="Yes" type="radio" <?php if ($res_staff_otherdetails[phy_handicapped] == 'Yes') echo "checked = checked"; ?>>
                &nbsp; No  <input name="phy_hand" title="Physical Handicap" value="No" type="radio" <?php if ($res_staff_otherdetails[phy_handicapped] == 'No') echo "checked = checked"; ?>>
              </td>              
              </tr>
              <tr>
              <td style="text-align: right;"><b>Nationality</b></td>
              <td>:</td>
              <td align='left'><input value="<?php echo $res_staff_perdetails[nationality];?>" name="nationality" type="text" title="Nationality"></td>              
              <?php 
                    if ($res_staff_otherdetails[domicile] == " " || $res_staff_otherdetails[domicile] == "-" || $res_staff_otherdetails[domicile] == "")
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
              <td align='left'><input value="<?php echo $res_staff_otherdetails[domicile];?>" name="n_domicile" type="text" title="Domicile State"></td>
              <?php
                }
              ?>
            </tr>
            <tr>
              <td style="text-align: right;"><b>Religion</b></td>
              <td>:</td>
              <td align="left">
                <?php echo $res_staff_perdetails[religion];?>
                <input value="<?php echo $res_staff_perdetails[religion];?>" name="o_Religion" type="hidden" title="Religion">
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
                <?php echo $res_staff_perdetails[category];?>
                <input value="<?php echo $res_staff_perdetails[category];?>" name="o_Category" type="hidden" title="Category">  
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
                <td style="text-align: right;"><b>Fax Phone #</b></td>
                <td>:</td>
                <td align="left"><input value="<?php echo $res_staff_otherdetails[fax_phone];?>" name="fax" type="text" title="Fax Phone Number" /></td>
      		<td></td><td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#WD" >  NEXT >>  </a></td>		
            </tr>      
 </tbody>
</table> 
</td>
</tr>
</tbody>
</table>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<a name="WD"></a>

<h3>ColMation - College Automation System</h3>

<h4>[ Updating Staff Record ]</h4>

<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

<tbody>

<tr>  

    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PD">[Personal Details]</a></td>

    <td style="border-style: solid; border-color: rgb(229, 229, 229); font-weight: bold; background-color: rgb(255, 255, 255); text-align: center;" padding="7px"><a href="#WD" >[&nbsp;&nbsp;Work Details&nbsp;&nbsp;]</a></td>
        
    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ED" >[Education Details]</a></td>
 
    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#FD" >[Family Details]</a></td>

    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#OD" >[Other Details]</a></td>
    
    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#SB" >[Service Book Details]</a></td>

</tr>    
<tr align="center">
   <td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
   <table style="width: 974px; height: 350px;" align="center">
   <tbody>
      <tr>
        <td style="text-align: right;"><b>Emp Id</b></td><td> : </td>      
        <td style="text-align: left;"><b><?php echo $empid; ?></b></td>
        <td style="text-align: right;"><b>Password</b></td><td> : <input value="<?php echo $res_staff_perdetails[password];?>" name="old_pwd" type="hidden" /></td>        
        <td><input type='text' name='pwd' title='Password' value="Change Log IN Password" onblur="if(this.value.length == 0) { this.type='text'; this.value='Change Log IN Password';}" onclick="if(this.value == 'Change Log IN Password') {this.value=''; this.type='password'}"></td>
      </tr>
      <tr>
	<td style="text-align: right;"><b>Department</b></td><td> : </td>
	<td style="text-align: left;"><input type="text" name="dept" value="<?php echo $res_staff_workdetails[department];?>" title="Department"></td>
	<td style="text-align: right;"><b>Designation</b></td><td> : </td>
        <?php 
        if ($res_staff_workdetails[designation] != ' ' && $res_staff_workdetails[designation] != '')
        {
        ?>        
            <td style="text-align: left;"><input type="text" name="desig" value="<?php echo $res_staff_workdetails[designation];?>" title="Designation"></td>
        <?php
        }
        else
        {
        ?>            
            <td style="text-align: left;"  >
                <select id ="dropbox" name="sel_desig" title="Designation" >
                    <option value="-">Select</option>
                    <option value="Professor">Professor</option>
                    <option value="Assistant Professor">Assistant Professor</option>
                    <option value="Lecturer">Lecturer</option>
                    <option value="Teaching Assistant">Teaching Assistant</option>
                    <option value="Research Associate">Research Associate</option>
                    <option value="Others" onclick ="dropbox_invisible()">Others</option>
                </select>
                <input id="textbox" style="display:none;" type="text" name="tex_desig" value="<?php echo $res_staff_workdetails[designation];?>" title="Designation">
                <input type="hidden" name="desig"  title="Designation" > 
            </td>
        <?php
        }
        ?>
      </tr> 
      <tr>
        <td style="text-align: right;"><b>PAN Number</b></td><td> : </td>
        <td align='left'><input type="text" name="PAN" value='<?php echo $res_staff_workdetails[PAN_no];?>' title="PAN Number"></td>             
        <td style="text-align: right;"><b>PF Number</b></td><td> : </td>        
        <td align='left'><input type="text" name="PF" value='<?php echo $res_staff_workdetails[PF_accnt_no];?>' title="PF Number"></td>
      </tr>      
    <tr>
	<td style="text-align: right;"><b>Bank Name</b></td><td> : </td>
	<td align='left'><input type="text" name="b_name" value='<?php echo $res_staff_workdetails[bank_name];?>' title='Bank Name' /></td>
	<td style="text-align: right;"><b>Bank Branch</b></td><td> : </td>
	<td align='left'><input type="text" name="b_branch" value='<?php echo $res_staff_otherdetails[bank_branch];?>' title='Bank Branch Name' /></td>
    </tr>
    <tr>
	<td style="text-align: right;"><b>Bank Account Number</b></td><td> : </td>
	<td align='left'><input type="text" name="accnt_num" value='<?php echo $res_staff_workdetails[bank_accnt_no];?>' title='Bank Account number' /></td>
	<td style="text-align: right;"><b>IIFC Code</b></td><td> : </td>
	<td align='left'><input type="text" name="iifc" value='<?php echo $res_staff_otherdetails[iifc_code];?>' title='Bank IIFC code' /></td>
    </tr>
    <tr>
        <td style="text-align: right;"><b>Date of Joining</b></td><td> : </td>
        <td align='left'><input type='text' size='9' title="Date of Joining" name='doj' value='<?php  if ($res_staff_workdetails[joining_date] != '0000-00-00') echo $res_staff_workdetails[joining_date]; else echo date('Y-m-d'); ?>' />
        <script language='Javascript'>
        new tcal({'formname': 'form', 'controlname': 'doj'});
        </script>
        </td>  
        <td style="text-align:right;"><b>Passport Number</b></td><td> : </td>        
        <td style="text-align:left;"><input type="text" name="passport" title="Passport Number" value='<?php echo $res_staff_perdetails[passport_no];?>' ></td>			
        
    </tr>
    <tr>
        <td style="text-align:right;"><b>Passport Issue Date</b></td><td> : </td>
        <td style="text-align:left;"><input name="issdt" size="9" title="Passport Issue Date" type="text" value='<?php  if ($res_staff_perdetails[passport_issue_dt] != '0000-00-00') echo $res_staff_perdetails[passport_issue_dt]; ?>' />
        <script language='Javascript'>
        new tcal({'formname': 'form', 'controlname': 'issdt'});
        </script>
        </td>  
        <td style="text-align:right;"><b>Passport Expiry Date</b></td><td> : </td>
        <td style="text-align:left;"><input type="text" size="9" name="expdt" value='<?php  if ($res_staff_perdetails[passport_expiry_dt] != '0000-00-00') echo $res_staff_perdetails[passport_expiry_dt]; ?>' />
        <script language='Javascript'>
        new tcal({'formname': 'form', 'controlname': 'expdt'});
        </script>
        </td>
    </tr>
    <tr>
        <td align='right'><b>FY/Common <br/>Subject Teacher</b></td><td> : </td>
        <td align="left">                
            &nbsp; Yes <input name="fy_commsubteacher" title="FY/Common Subject Teacher" value="Yes" type="radio" <?php if ($res_staff_otherdetails[fy_commsubteacher] == 'Yes') echo "checked = checked"; ?> onclick="document.form.fy_commsubject.disabled=false;">
            &nbsp; No  <input name="fy_commsubteacher" title="FY/Common Subject Teacher" value="No" type="radio" <?php if ($res_staff_otherdetails[fy_commsubteacher] == 'No') echo "checked = checked"; ?> onclick="document.form.fy_commsubject.disabled=true;document.form.fy_commsubject.value=''">
        </td>              
         <td style="text-align: right;"><b>FY/Common Subject</b></td><td> : </td>
        <td style="text-align: left;"><textarea rows="3" cols="23" name="fy_commsubject"  title="FY/Common Subject"><?php echo $res_staff_otherdetails[fy_commsubject];?></textarea></td>
     </tr>
     <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ED" >  NEXT >>  </a></td>		
     </tr>

</tbody>
</table> 
</td>
</tr>
</tbody>
</table>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<a name="ED"></a>

<h3>ColMation - College Automation System</h3>

<h4>[ Updating Staff Record ]</h4>

<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

<tbody>

<tr>  

    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PD">[Personal Details]</a></td>

    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#WD" >[Work Details]</a></td>
        
    <td style="border-style: solid; border-color: rgb(229, 229, 229); font-weight: bold; background-color: rgb(255, 255, 255); text-align: center;" padding="7px"><a href="#ED" >[&nbsp;&nbsp;Education Details&nbsp;&nbsp;]</a></td>
 
    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#FD" >[Family Details]</a></td>

    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#OD" >[Other Details]</a></td>
    
    <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#SB" >[Service Book Details]</a></td>

</tr>    
<tr align="center">
   <td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
   <table style="width: 1074px; height: 440px;" align="center">
   <tbody>
      <tr>
        <td style="text-align: right;"><b>Emp Id</b> : </td>        
        <td style="text-align: left;"><b><?php echo $empid; ?></b></td>
        <td align='right'><b>Doctrate Degree</b> : </td>
        <td align="left">                
            &nbsp; Yes <input name="doctrate_deg" title="Doctrate Degree" value="Yes" type="radio" <?php if ($res_staff_higheducdetails[doctrate_deg] == 'Yes') echo "checked = checked"; ?>>
            &nbsp; No  <input name="doctrate_deg" title="Doctrate Degree" value="No" type="radio" <?php if ($res_staff_higheducdetails[doctrate_deg] == 'No') echo "checked = checked"; ?>>
        </td>
      </tr>
      <tr>
	<td style="text-align: right;"><b>PG Degree & (%)</b> : </td>
        <td style="text-align: left;"><textarea rows="3" cols="23" name="pg_deg"  title="PG Degree"><?php echo $res_staff_higheducdetails[pg_deg];?></textarea></td>
	<td style="text-align: right;"><b>UG Degree & (%)</b> : </td>
	<td style="text-align: left;"><textarea rows="3" cols="23" name="ug_deg"  title="UG Degree"><?php echo $res_staff_higheducdetails[ug_deg];?></textarea></td>
      </tr>
      <tr>
	<td style="text-align: right;"><b>Other Qualifications</b> : </td>
        <td style="text-align: left;"><textarea rows="3" cols="23" name="other_qual"  title="Other Qualifications"><?php echo $res_staff_higheducdetails[other_qual];?></textarea></td>
	<td style="text-align: right;"><b>Area of Specialization</b> : </td>
	<td style="text-align: left;"><textarea rows="3" cols="23" name="area_special"  title="Area of Specialization"><?php echo $res_staff_higheducdetails[area_special];?></textarea></td>
      </tr> 
      <tr>
	<td style="text-align: right;"><b>Diploma & (%)</b> : </td>
	<td style="text-align: left;"><input type="text" name="diploma" value="<?php echo $res_staff_higheducdetails[diploma];?>" title="Diploma"></td>
	<td style="text-align: right;"><b>Total Work Experience (Years)</b> : </td>
	<td style="text-align: left;"><input type="text" name="work_years" value="<?php if ($res_staff_higheducdetails[total_work_years] != ' ' && $res_staff_higheducdetails[total_work_years] != '') echo $res_staff_higheducdetails[total_work_years]; else echo 0; ?>" title="Total Work Experience"></td>
      </tr>
      <tr>
	<td style="text-align: right;"><b>Teaching Experience (Years)</b> : </td>
	<td style="text-align: left;"><input type="text" name="teach_years" value="<?php if ($res_staff_higheducdetails[teach_years] != ' ' && $res_staff_higheducdetails[teach_years] != '') echo $res_staff_higheducdetails[teach_years]; else echo 0; ?>" title="Teaching Experience"></td>
	<td style="text-align: right;"><b>Research Experience (Years)</b> : </td>
	<td style="text-align: left;"><input type="text" name="research_years" value="<?php if ($res_staff_higheducdetails[research_years] != ' ' && $res_staff_higheducdetails[research_years] != '') echo $res_staff_higheducdetails[research_years]; else echo 0; ?>" title="Research Experience"></td>
      </tr> 
      <tr>
        <td style="text-align: right;"><b>National Publications</b> : </td>
        <td align='left'><textarea rows="3" cols="23" name="nat_public" title="National Publications"><?php echo $res_staff_higheducdetails[nat_public];?></textarea></td>             
        <td style="text-align: right;"><b>Patents</b> : </td>        
        <td align='left'><textarea rows="3" cols="23" name="patents" title="Patents"><?php echo $res_staff_higheducdetails[patents];?></textarea></td>
      </tr>
      <tr>
	<td style="text-align: right;"><b>PG Projects Guided</b> : </td>
	<td style="text-align: left;"><input type="text" name="no_pg_proj" value="<?php if ($res_staff_higheducdetails[no_pg_proj] != ' ' && $res_staff_higheducdetails[no_pg_proj] != '') echo $res_staff_higheducdetails[no_pg_proj]; else echo 0; ?>" title="PG Projects Guided"></td>
	<td style="text-align: right;"><b>Doctrate Students Guided</b> : </td>
	<td style="text-align: left;"><input type="text" name="no_doc_proj" value="<?php if ($res_staff_higheducdetails[no_doc_proj] != ' ' && $res_staff_higheducdetails[no_doc_proj] != '') echo $res_staff_higheducdetails[no_doc_proj]; else echo 0; ?>" title="Doctrate Students Guided"></td>
      </tr>
      <tr>
        <td style="text-align: right;"><b>International Publications</b> : </td>
        <td align='left'><textarea rows="3" cols="23" name="inter_public" title="International Publications"><?php echo $res_staff_higheducdetails[inter_public];?></textarea></td>             
        <td style="text-align: right;"><b>Books Published</b> : </td>        
        <td align='left'><textarea rows="3" cols="23" name="books_pub" title="Books Published"><?php echo $res_staff_higheducdetails[books_pub];?></textarea></td>
      </tr>
      <tr>        
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#FD" >  NEXT >>  </a></td>		
     </tr>
   </tbody>
</table> 
</td>
</tr>
</tbody>
</table>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<a name="FD"></a>

<h3>ColMation - College Automation System</h3>

<h4>[ Updating Staff Record ]</h4>

<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

<tbody>

<tr>
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PD">[Personal Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#WD" >[Work Details]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ED" >[Education Details]</a></td>        

        <td style="border-style: solid; border-color: rgb(229, 229, 229); font-weight: bold; background-color: rgb(255, 255, 255); text-align: center;" padding="7px"><a href="#FD" >[&nbsp;&nbsp;Family Details&nbsp;&nbsp;]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#OD" >[Other Details]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#SB" >[Service Book Details]</a></td>

</tr>
<tr align="center">
<td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
<table style="width: 1100px; height: 300px;" align="center">
<tbody>
  <tr>
    <td style="text-align: right;"><b>Emp Id</b> </td> <td> : </td>        
    <td style="text-align: left;"><b><?php echo $empid; ?></b></td>        
  </tr>
  <tr>
    <td style="text-align: right;"><b>Mother Tongue</b> </td> <td>:</td>
    <td style="text-align: left;"><input type="text" name="mother_tongue" value="<?php echo $res_staff_servicebookrecord[mother_tongue];?>" title="Mother Tongue" /></td>
    <td style="text-align: right;"><b>Birth Place</b> : </td>
    <td style="text-align: left;"><input type="text" name="birth_place" value="<?php echo $res_staff_servicebookrecord[birth_place];?>" title="Birth Place" /></td>
  </tr>
  <tr>
    <td style="text-align: right;"><b>Marital Status</b> </td><td>:</td>    
    <td align='left' >
    <select name="marital" title="Marital Status">
        <option value="unmarried" <?php if($res_staff_perdetails[marital_status] == 'unmarried') echo "selected=selected"; ?> onclick="document.form.spouse_name.disabled=true;document.form.spouse_name.value=''">&nbsp;&nbsp;Unmarried&nbsp;&nbsp;</option>        
        <option value="married" <?php if($res_staff_perdetails[marital_status] == 'married') echo "selected=selected"; ?> onclick="document.form.spouse_name.disabled=false;">&nbsp;&nbsp;Married</option>        
    </select>
    </td>
    <td style="text-align:right;"><b>Spouse's Name</b> : </td>
    <td style="text-align:left;"><input name="spouse_name" title='Spouse Name' type="text" value='<?php echo $res_staff_perdetails[spouse_name];?>' ></td>
  </tr>
    <?php 
    if($res_staff_otherdetails[fathersname] != ' ' && $res_staff_otherdetails[fathersname] != '-' && $res_staff_otherdetails[fathersname] != '')  
    {
    ?>
    <tr>
      <td style="text-align: right;"><b>Father's Name</b></td><td>:</td>      
      <td style="color:red; text-align:left" colspan="3"><input value="<?php echo $res_staff_otherdetails[fathersname];?>" title="Father's Name" size="45" name="fname" type="text">&nbsp;<i>* Lastname Firstname Format</i></td>
    </tr>
    <?php
    }
    else
    {    
    ?>
    <tr>
      <td style="text-align: right;"><b>Father's Lastname</b> </td><td>:</td>
      <td><input name="fln" type="text" title="Father's Lastname"></td>
      <td style="text-align: right;"><b>Father's Firstname</b> : </td>
      <td><input name="ffn" type="text" title="Father's Firstname"></td>
    </tr>
    <?php
    }
    ?>
     <?php 
    if($res_staff_otherdetails[mothersname] != ' ' && $res_staff_otherdetails[mothersname] != '-' && $res_staff_otherdetails[mothersname] != '')  
    {
    ?>
    <tr>
      <td style="text-align: right;"><b>Mother's Name</b></td><td>:</td>      
      <td style="color:red; text-align:left" colspan="3"><input value="<?php echo $res_staff_otherdetails[mothersname];?>" title="Mother's Name" size="45" name="mname" type="text">&nbsp;<i>* Lastname Firstname Format</i></td>
    </tr>
    <?php
    }
    else
    {    
    ?>
    <tr>
      <td style="text-align: right;"><b>Mother's Lastname</b> </td><td>:</td>
      <td><input name="mln" type="text" title="Mother's Lastname"></td>
      <td style="text-align: right;"><b>Mother's Firstname</b> : </td>
      <td><input name="mfn" type="text" title="Mother's Firstname"></td>
    </tr>
    <?php
    }
    ?>
    <?php 
    if ($res_staff_servicebookrecord[guardian_address] != " " && $res_staff_servicebookrecord[guardian_address] != "-, -, -" && $res_staff_servicebookrecord[guardian_address] != "")
    {
?>        
        <tr>
        <td style="text-align: right;"><b>Father's/Husband's Residence</b> </td><td>:</td>        
        <td colspan="3" align="left"><input value="<?php echo $res_staff_servicebookrecord[guardian_address]; ?>" size="80" name="guardian_residence" type="text" title="Father's/Husband's Residence" /></td>
        </tr>
<?php
    }
    else {            
?>
      <tr>
      <td style="text-align: right;"><b>Father's/Husband's Residence</b> </td><td>:</td>
      <td ><input value="" name="guardian_" type="text" title="Father's/Husband's Residence" /></td>
      <td>
        City : <input value="" type="text" name="guardian_city" title="Parents City" />
      </td>
      <td>

      <select name="guardian_state" title="Parents State">
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
    </tr>
     <?php
    }
    ?>    
  <tr>
    <td style="text-align: right;"><b>No of Family Members</b> </td><td>:</td>
    <td style="text-align: left;"><input type="text" name="fmly_no" value="<?php echo $res_staff_famdetails[no_of_fmly_membrs];?>" title="No. of Family members"></td>
    <td style="text-align: right;"><b>No of Dependent Members</b> : </td>
    <td style="text-align: left;"><input type="text" name="depndnt_no" value="<?php echo $res_staff_famdetails[no_depndnt_membrs];?>" title="No. of Dependent members"></td>
  </tr>
  <tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#OD" >  NEXT >>  </a></td>    
  </tr>
  </tbody>
</table> 
</td>
</tr>
</tbody>
</table>
<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<a name="OD"></a>

<h3>ColMation - College Automation System</h3>

<h4>[ Updating Staff Record ]</h4>

<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

<tbody>

<tr>
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PD">[Personal Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#WD" >[Work Details]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ED" >[Education Details]</a></td>        

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#FD" >[Family Details]</a></td>

        <td style="border-style: solid; border-color: rgb(229, 229, 229); font-weight: bold; background-color: rgb(255, 255, 255); text-align: center;" padding="7px"><a href="#OD" >[&nbsp;&nbsp;Other Details&nbsp;&nbsp;]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#SB" >[Service Book Details]</a></td>

</tr>
<tr align="center">
<td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
<table style="width: 1050px; height: 225px;" align="center" >
<tbody>
  <tr>
    <td style="text-align: right;"><b>Emp Id</b> : </td>        
    <td style="text-align: left;"><b><?php echo $empid; ?></b></td>        
  </tr>
  <tr>
    <td style="text-align: right;"><b>Height (cm)</b> : </td>
    <td style="text-align: left;"><input type="text" name="height" value="<?php echo $res_staff_servicebookrecord[height];?>" title="Height" /></td>
    <td style="text-align: right;"><b>Mark of Identification</b> : </td>
    <td style="text-align: left;"><input type="text" name="mark_identify" value="<?php echo $res_staff_servicebookrecord[personal_marks_of_identification];?>" title="Personal marks of identification" /></td>
  </tr>
  <tr>
    <td style="text-align: right;"><b>Medical Examination Date</b> : </td>
    <td style="text-align: left;"><input type="text" size="9" name="med_exam_date" title="Medical Examination Date" value="<?php if ($res_staff_servicebookrecord[medical_examination_date] != '0000-00-00') 
        echo $res_staff_servicebookrecord[medical_examination_date]; else echo date('Y-m-d');?>" />
    <script language='Javascript'>
        new tcal({'formname': 'form', 'controlname': 'med_exam_date'});
    </script>
    </td>
    <td style="text-align: right;"><b>Medical Examination Result</b> : </td>
    <td style="text-align: left;"><input type="text" name="med_exam_result" value="<?php echo $res_staff_servicebookrecord[medical_examination_result];?>" title="Medical Examination Result" /></td>
  </tr>  
  <tr>
    <td style="text-align: right;"><b>Medical Certificate Date</b> : </td>
    <td style="text-align: left;"><input type="text" size="9" name="med_cert_date" title="Medical Certificate Date" value="<?php if ($res_staff_servicebookrecord[medical_certification_date] != '0000-00-00') 
        echo $res_staff_servicebookrecord[medical_certification_date]; else echo date('Y-m-d');?>" />
    <script language='Javascript'>
        new tcal({'formname': 'form', 'controlname': 'med_cert_date'});
    </script>
    </td>
    <td style="text-align: right;"><b>Medical Certificate No</b> : </td>
    <td style="text-align: left;"><input type="text" name="med_cert_no" value="<?php echo $res_staff_servicebookrecord[medical_certification_number];?>" title="Medical Certificate No" /></td>    
  </tr>
  <tr>
    <td style="text-align: right;"><b>Medical Authority Name</b> : </td>
    <td style="text-align: left;"><input type="text" name="med_auth_name" value="<?php echo $res_staff_servicebookrecord[medical_authority_name];?>" title="Medical Authority Name" /></td>
    <td style="text-align: right;"><b>Medical Authority Designation</b> : </td>
    <td style="text-align: left;"><input type="text" name="med_auth_desig" value="<?php echo $res_staff_servicebookrecord[medical_authority_designation];?>" title="Medical Authority Designation" /></td>
  </tr>
  <tr>
    <td style="text-align: right;" colspan ="3"><b>Upload Photograph</b> : <input type="file" name="file" title='Photograph' id="file"></td>
    <td border="1" align="left">
        <?php
        $output = shell_exec('ls staff_images/'.$empid.'* | wc -l');
        if($output > 0)
	{
            echo "<img src='staff_images/$empid' alt='image' height='120px' width='100px' align='left' style='padding-left:10px'>";
        } 
        else
        {
            echo "<img src='staff_images/nophoto.jpg' alt='image' height='120px' width='100px' align='left' style='padding-left:10px'>";
        }    
        ?>    
        </td>
  </tr>      
  <tr>
    <td style="text-align: right;" colspan="3" ><b>Would you like to work as Expert Member for various committees of AICTE</b> : </td>
    <td align="left">                
        &nbsp; Yes <input name="aicte_expert" title="Expert for AICTE" value="Yes" type="radio" <?php if ($res_staff_otherdetails[aicte_expert] == 'Yes') echo "checked = checked"; ?>>
        &nbsp; No  <input name="aicte_expert" title="Expert for AICTE" value="No" type="radio" <?php if ($res_staff_otherdetails[aicte_expert] == 'No') echo "checked = checked"; ?>>
    </td>
  </tr>
  <tr>
    <td style="text-align: right;" colspan="3" ><b>Have you ever applied to AICTE for any Grants/Assistance</b> : </td>
    <td align="left">                
        &nbsp; Yes <input name="aicte_grant" title="AICTE for Grants/Assistance" value="Yes" type="radio" <?php if ($res_staff_otherdetails[aicte_grant] == 'Yes') echo "checked = checked"; ?>>
        &nbsp; No  <input name="aicte_grant" title="AICTE for Grants/Assistance" value="No" type="radio" <?php if ($res_staff_otherdetails[aicte_grant] == 'No') echo "checked = checked"; ?>>
    </td>
  </tr>
</tbody>
</table> 
</td>
</tr>
</tbody>
</table>
<br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<a name="SB" />

<h3>ColMation - College Automation System</h3>

<h4>[ Updating Staff Record ]</h4>

<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="0">

<tbody>

<tr>
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#PD">[Personal Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#WD" >[Work Details]</a></td>
        
        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#ED" >[Education Details]</a></td>        

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#FD" >[Family Details]</a></td>

        <td style="text-align: center; background-color: rgb(229, 229, 229);"><a href="#OD" >[Other Details]</a></td>
        
        <td style="border-style: solid; border-color: rgb(229, 229, 229); font-weight: bold; background-color: rgb(255, 255, 255); text-align: center;" padding="7px"><a href="#SB" >[&nbsp;&nbsp;Service Book Details&nbsp;&nbsp;]</a></td>

</tr>
<tr align="center">
<td style="border-style: solid; border-color: rgb(229, 229, 229);" colspan="6" rowspan="1">
<table style="width: 1050px; height: 490px;" align="center" >
<tbody>
<tr><td align ="center">

<!--    Qualification Code Begins   -->        
<span style ="font-size:18px; font-weight: bold;" >Qualification (Academic & Professional)</span>
<table border="1" align="center" cellpadding ="3" cellspacing ="0">
<tr>
    <th>Examination Certificate</th>
    <th>Special Subject</th>
    <th>University Name</th>
    <th>Passing Year</th>
    <th>Class</th>
    <th>Distinction</th>
    <th><img src='images/add.png' style ="height:25px" onclick = "add_qual();" /></th>
</tr>
<?php
$a = 1;
while($res_staff_qualification = mysql_fetch_array($sql_staff_qualification))
{    
    echo "<tr id='oq_tr$a'>
    <input type='hidden' name='oq_id$a' value='$res_staff_qualification[id]' />
    <td><input name='oq_exam_cert$a' type='text' size='15' value='$res_staff_qualification[examination_certification]' title='Examination Certificate' /></td>
    <td><input name='oq_sp_sub$a' type='text' size='7' value='$res_staff_qualification[special_subject]' title='Special Subject'></td>
    <td><input name='oq_univ_name$a' type='text' size='9' value='$res_staff_qualification[university]' title='University Name'></td>
    <td><input name='oq_pass_year$a' type='text' size='5' value='$res_staff_qualification[year_passing]' title='Passing Year'></td>
    <td><input name='oq_class$a' type='text' size='1' value='$res_staff_qualification[class]' title='Class'></td>";
    ?>                    
    <td>Yes<input name='oq_distinction<?php echo$a?>' type='radio' title='Distinction' value='1' <?php if ($res_staff_qualification[distinction] == '1') echo 'checked = checked'; ?>  />
        No<input name='oq_distinction<?php echo$a?>' type='radio' title='Distinction' value='0' <?php if ($res_staff_qualification[distinction] == '0') echo 'checked = checked'; ?> /></td>    
    <?php
    echo "<td><img src='images/drop.png' style ='height:25px' onclick = \"delete_row('$res_staff_qualification[id]','oq_tr$a','qual');\" /></td>
    </tr>";
    $a++;
}
echo "<input type='hidden' name='q_no' value='$a' />";
?>
<tbody id ='addqual'>
</tbody>
</table>
<!--    Qualification Code Ends     -->  
<br />
<!--    Special Qualification Code Begins   -->
<span style ="font-size:18px; font-weight: bold;" >Special Qualification if any</span>
<table border="1" align="center" cellpadding ="3" cellspacing ="0">
<tr>
    <th>Examination Certificate</th>    
    <th>University Name</th>
    <th>Passing Year</th>
    <th>Class</th>
    <th>Distinction</th>
    <th><img src='images/add.png' style ="height:25px" onclick = "add_spqual();" /></th>
</tr>
<?php
$b = 1;
while($res_staff_specialqualification = mysql_fetch_array($sql_staff_specialqualification))
{
    echo "<tr id='osp_tr$b'>
    <input type='hidden' name='osp_id$b' value='$res_staff_specialqualification[id]' />
    <td><input name='osp_exam_cert$b' type='text' size='15' value='$res_staff_specialqualification[examination]' title='Examination Certificate'></td> 
    <td><input name='osp_univ_name$b' type='text' size='9' value='$res_staff_specialqualification[university]' title='University Name'></td>
    <td><input name='osp_pass_year$b' type='text' size='5' value='$res_staff_specialqualification[year_pass]' title='Passing Year'></td>
    <td><input name='osp_class$b' type='text' size='1' value='$res_staff_specialqualification[class]' title='Class'></td>";
    ?>
    <td>Yes<input name='osp_distinction<?php echo$b?>' type='radio' title='Distinction' value='1' <?php if ($res_staff_specialqualification[distinction] == '1') echo 'checked = checked'; ?> />
         No<input name='osp_distinction<?php echo$b?>' type='radio' title='Distinction' value='0' <?php if ($res_staff_specialqualification[distinction] == '0') echo 'checked = checked'; ?> /></td>
    <?php
    echo "<td><img src='images/drop.png' style ='height:25px' onclick = \"delete_row('$res_staff_specialqualification[id]','osp_tr$b','spqual');\" ></td>
    </tr>";
    $b++;
}
echo "<input type='hidden' name='sp_no' value='$b' />";
?>
<tbody id ='addspqual'>
</tbody>
</table>
<!--    Special Qualification Code Ends     -->

<br />
<!--    Service Institution Code Begins   -->  
<span style ="font-size:18px; font-weight: bold;" >Service in other Institutions</span>
<table border="1" align="center" cellpadding ="3" cellspacing ="0">
<tr>
    <th rowspan ="2">Name of Institution</th>
    <th colspan ="2">Period of Service</th>
    <th colspan ="2">Leave without Pay if any</th>
    <th rowspan ="2">Basic Pay with Scale</th>
    <th rowspan ="2"><img src='images/add.png' style ="height:25px" onclick = "add_serv();" /></th>
</tr>
<tr>   
    <th>From</th>
    <th>To</th>
    <th>From</th>
    <th>To</th>    
</tr>
<?php
$c = 1; 
while($res_staff_instituteexperience = mysql_fetch_array($sql_staff_instituteexperience))
{       
    echo "<tr id='osi_tr$c'>
    <input type='hidden' name='osi_id$c' value='$res_staff_instituteexperience[id]' />
    <td><input name='osi_inst_name$c' type='text' size='13' value='$res_staff_instituteexperience[institute_name]' title='Name of Institution'></td>
    <td><input name='osi_serv_from$c' type='text' size='4' value='$res_staff_instituteexperience[service_from]' title='Service From'></td>
    <td><input name='osi_serv_to$c' type='text' size='4' value='$res_staff_instituteexperience[service_to]' title='Service To'></td>
    <td><input name='osi_leave_from$c' type='text' size='4' value='$res_staff_instituteexperience[leave_from]' title='Leave From'></td>
    <td><input name='osi_leave_to$c' type='text' size='4' value='$res_staff_instituteexperience[leave_to]' title='Leave To'></td>
    <td><input name='osi_basic_pay$c' type='text' size='20' value='$res_staff_instituteexperience[basic_pay]' title='Basic Pay with Scale'></td>            
    <td><img src='images/drop.png' style ='height:25px' onclick = \"delete_row('$res_staff_instituteexperience[id]','osi_tr$c','serv');\" ></td>
    </tr>";
    $c++;
}
echo "<input type='hidden' name='si_no' value='$c' />";
?>
<tbody id ='addserv'>
</tbody>
</table>
<!--    Service Institution Code Ends   -->  
</td></tr>
</tbody>   
</table> 
</td>
</tr>
</tbody>
</table>

<center>
<input style="background-color: rgb(85, 85, 85); color: white;" type="submit" value="Submit All Data" >
</center>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</form>

</body>
</html>

<?php 
}
}
?>
