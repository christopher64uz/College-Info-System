<?php

/*
 * This Code has been created by Christopher Uzhuthuval
 * for the Project College Information System.
 */

/**
 * Description of Staff Info. 
 * It has been modified to include Service Book Info.
 * 
 */


class Staff {
    private $empid;
    private $ldap_username;
    private $password;
    private $ename;
    private $currnt_addr;
    private $prmnt_addr;
    private $nationality;
    private $religion;
    private $category;
    private $dob;
    private $gender;
    private $mobile_no;
    private $landln_no;
    private $email;
    private $emrgncy_no;
    private $marital_status;
    private $passport_no;
    private $passport_issue_dt;
    private $passport_expiry_dt;
    private $spouse_name;    
    private $joining_date;
    private $department;
    private $designation;
    private $PAN_no;
    private $PF_accnt_no;
    private $bank_accnt_no;
    private $bank_name;
    private $no_of_fmly_membrs;
    private $no_depndnt_membrs;
    private $firstname;
    private $middlename;
    private $surname;
    private $mothersname;
    private $fathersname;
    private $domicile;
    private $phy_handicapped;
    private $fax_phone;
    private $bank_branch;
    private $iifc_code;
    private $fy_commsubteacher;
    private $fy_commsubject;
    private $aicte_expert;
    private $aicte_grant;    
    private $doctrate_deg;
    private $pg_deg;
    private $ug_deg;
    private $diploma;
    private $other_qual;
    private $area_special;
    private $teach_years;
    private $research_years;
    private $total_work_years;
    private $nat_public;
    private $patents;
    private $no_pg_proj;
    private $no_doc_proj;
    private $inter_public;
    private $books_pub;
    //  Service Book Specific
    private $guardian_address;
    private $birth_place;
    private $mother_tongue;
    private $medical_examination_date;
    private $medical_examination_result;
    private $height;
    private $personal_marks_of_identification;
    private $medical_certification_number;
    private $medical_certification_date;
    private $medical_authority_name;
    private $medical_authority_designation;
    private $q_id;
    private $q_exam_cert;
    private $q_sp_sub;
    private $q_univ_name;
    private $q_pass_year;
    private $q_class;
    private $q_distinction;
    private $sp_id;
    private $sp_exam_cert;
    private $sp_univ_name; 
    private $sp_pass_year; 
    private $sp_class; 
    private $sp_distinction;
    private $si_id;
    private $si_inst_name; 
    private $si_serv_from; 
    private $si_serv_to; 
    private $si_leave_from; 
    private $si_leave_to;
    private $si_basic_pay;

    public function findEmpId($ldap_username)
    {
        $this->ldap_username = $ldap_username;
        
        $sql_getempid = mysql_query("SELECT empid FROM staff_personal_details WHERE ldap_username = '$this->ldap_username'") 
            or die("Error : ".  mysql_error());
        
        $res_getempid = mysql_fetch_array($sql_getempid);        
        $this->empid = $res_getempid[empid];
                
        return $this->empid;
    }
    
    public function setStaffPersonalDetails($empid,$ldap_username,$ename,$gender,$dob,$email,$local_address,
            $permnt_address,$mobile_no,$landln_no,$emrgncy_no,$nationality,$religion,$category,$password,
            $passport_no,$passport_issuedate,$passport_expirydate,$marital,$spouse_name)
    {
        $this->empid = $empid;
        $this->ldap_username = $ldap_username;
        $this->ename = $ename;
        $this->gender = $gender;
        $this->dob = $dob;
        $this->email = $email;
        $this->currnt_addr = $local_address;
        $this->prmnt_addr = $permnt_address;
        $this->mobile_no = $mobile_no;
        $this->landln_no = $landln_no;
        $this->emrgncy_no = $emrgncy_no;
        $this->nationality = $nationality;
        $this->religion = $religion;
        $this->category = $category;
        $this->password = $password;
        $this->passport_no = $passport_no;
        $this->passport_issue_dt = $passport_issuedate;
        $this->passport_expiry_dt = $passport_expirydate;
        $this->marital_status = $marital;
        $this->spouse_name = $spouse_name;
    }
    
    public function setStaffWorkDetails($doj,$department,$designation,$pan,$pf,$bank_name,$bank_accntno)
    {
        $this->joining_date = $doj;
        $this->department = $department;
        $this->designation = $designation;
        $this->PAN_no = $pan;
        $this->PF_accnt_no = $pf;
        $this->bank_name = $bank_name;
        $this->bank_accnt_no = $bank_accntno;
    }
    
    public function setFamilyDetails($fmly_no,$depndnt_no)
    {
        $this->no_of_fmly_membrs = $fmly_no;
        $this->no_depndnt_membrs = $depndnt_no;        
    }
    
    public function setStaffOtherDetails($firstname,$middlename,$surname,$mname,$fname,$domicile,$phy_hand,
            $fax_phone,$bank_branch,$iifc_code,$fy_commsubteacher,$fy_commsubject,$aicte_expert,$aicte_grant)
    {
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->surname = $surname;
        $this->mothersname = $mname;
        $this->fathersname = $fname;
        $this->domicile = $domicile;
        $this->phy_handicapped = $phy_hand;
        $this->fax_phone = $fax_phone;
        $this->bank_branch = $bank_branch;
        $this->iifc_code = $iifc_code;
        $this->fy_commsubteacher = $fy_commsubteacher;
        $this->fy_commsubject = $fy_commsubject;
        $this->aicte_expert = $aicte_expert;
        $this->aicte_grant = $aicte_grant;
    }
    
    public function setStaffHighEducDetails($doctrate_deg,$pg_deg,$ug_deg,$diploma,$other_qual,$area_special,$teach_years,
            $research_years,$total_work_years,$nat_public,$patents,$no_pg_proj,$no_doc_proj,$inter_public,$books_pub)
    {
        $this->doctrate_deg = $doctrate_deg;
        $this->pg_deg = $pg_deg;
        $this->ug_deg = $ug_deg;
        $this->diploma = $diploma;
        $this->other_qual = $other_qual;
        $this->area_special = $area_special;
        $this->teach_years = $teach_years;
        $this->research_years = $research_years;
        $this->total_work_years = $total_work_years;
        $this->nat_public = $nat_public;
        $this->patents = $patents;
        $this->no_pg_proj = $no_pg_proj;
        $this->no_doc_proj = $no_doc_proj;
        $this->inter_public = $inter_public;
        $this->books_pub = $books_pub;        
    }
    
    public function setStaffServiceBookRecord($guardian_address,$birth_place,$mother_tongue,$medical_examination_date,
            $medical_examination_result,$height,$personal_marks_of_identification,$medical_certification_number,
            $medical_certification_date,$medical_authority_name,$medical_authority_designation)
    {
        $this->guardian_address = $guardian_address;
        $this->birth_place = $birth_place;
        $this->mother_tongue = $mother_tongue;
        $this->medical_examination_date = $medical_examination_date;
        $this->medical_examination_result = $medical_examination_result;
        $this->height = $height;
        $this->personal_marks_of_identification = $personal_marks_of_identification;
        $this->medical_certification_number = $medical_certification_number;
        $this->medical_certification_date = $medical_certification_date;
        $this->medical_authority_name = $medical_authority_name;
        $this->medical_authority_designation = $medical_authority_designation;
    }
    
    public function setStaffQualification($q_id,$q_exam_cert,$q_sp_sub,$q_univ_name,$q_pass_year,$q_class,$q_distinction)
    {
        $this->q_id = $q_id;
        $this->q_exam_cert = $q_exam_cert;
        $this->q_sp_sub = $q_sp_sub;
        $this->q_univ_name = $q_univ_name;
        $this->q_pass_year = $q_pass_year;
        $this->q_class = $q_class;
        $this->q_distinction = $q_distinction;
    }
    
    public function setStaffSpecialQualification($sp_id,$sp_exam_cert,$sp_univ_name,$sp_pass_year,$sp_class,$sp_distinction)
    {
        $this->sp_id = $sp_id;
        $this->sp_exam_cert = $sp_exam_cert;
        $this->sp_univ_name = $sp_univ_name;
        $this->sp_pass_year = $sp_pass_year;
        $this->sp_class = $sp_class;
        $this->sp_distinction = $sp_distinction;
    }

    public function setStaffInstituteExperience($si_id,$si_inst_name,$si_serv_from,$si_serv_to,$si_leave_from,$si_leave_to,$si_basic_pay)
    {
        $this->si_id = $si_id;
        $this->si_inst_name = $si_inst_name; 
        $this->si_serv_from = $si_serv_from; 
        $this->si_serv_to = $si_serv_to; 
        $this->si_leave_from = $si_leave_from; 
        $this->si_leave_to = $si_leave_to;
        $this->si_basic_pay = $si_basic_pay;        
    }
    
    public function UpdateStaffPersonalDetails()
    {
        mysql_query("UPDATE staff_personal_details SET ldap_username = '$this->ldap_username', ename = '$this->ename', 
                gender = '$this->gender', dob = '$this->dob', email = '$this->email', currnt_addr = '$this->currnt_addr', 
                prmnt_addr = '$this->prmnt_addr', mobile_no = '$this->mobile_no', landln_no = '$this->landln_no', 
                emrgncy_no = '$this->emrgncy_no', nationality = '$this->nationality', religion = '$this->religion', 
                category = '$this->category', password = '$this->password', passport_no = '$this->passport_no', 
                passport_issue_dt = '$this->passport_issue_dt', passport_expiry_dt = '$this->passport_expiry_dt', 
                marital_status = '$this->marital_status', spouse_name = '$this->spouse_name' WHERE empid = '$this->empid'") 
                or die ("Error : " . mysql_error());
    }
    
    public function InsertUpdateStaffWorkDetails()
    {
        $sql_staffworkdetails_checkrow = mysql_query("SELECT * FROM staff_work_details WHERE empid = '$this->empid'") 
        or die ("Error : ".mysql_error());
        
        if (mysql_num_rows($sql_staffworkdetails_checkrow) > 0)
        {
            mysql_query("UPDATE staff_work_details SET joining_date = '$this->joining_date', department = '$this->department',
                    designation = '$this->designation', PAN_no = '$this->PAN_no', PF_accnt_no = '$this->PF_accnt_no',
                    bank_name = '$this->bank_name', bank_accnt_no = '$this->bank_accnt_no' WHERE empid = '$this->empid'") 
                    or die ("Error : ".mysql_error());
        }
        else
        {
            mysql_query("INSERT INTO staff_work_details (empid, joining_date, department, designation, PAN_no, PF_accnt_no, 
                    bank_name, bank_accnt_no) VALUES ('$this->empid','$this->joining_date', '$this->department', 
                    '$this->designation', '$this->PAN_no', '$this->PF_accnt_no', '$this->bank_name', '$this->bank_accnt_no')")
                    or die ("Error : ".mysql_error());
        }
    }
    
    public function InsertUpdateStaffFamilyDetails()
    {
        $sql_stafffamilydetails_checkrow = mysql_query("SELECT * FROM staff_family_details WHERE empid = '$this->empid'") 
        or die ("Error : ".mysql_error());
        
        if (mysql_num_rows($sql_stafffamilydetails_checkrow) > 0)
        {
            mysql_query("UPDATE staff_family_details SET no_of_fmly_membrs = '$this->no_of_fmly_membrs', 
                    no_depndnt_membrs = '$this->no_depndnt_membrs' WHERE empid = '$this->empid'") or die ("Error : ".mysql_error());
        }
        else 
        {
            mysql_query("INSERT INTO staff_family_details (empid, no_of_fmly_membrs, no_depndnt_membrs) VALUES ('$this->empid',
                    '$this->no_of_fmly_membrs','$this->no_depndnt_membrs')") or die ("Error : ".mysql_error());
        }        
    }
    
    public function InsertUpdateStaffOtherDetails()
    {
        $sql_staffotherdetails_checkrow = mysql_query("SELECT * FROM staff_other_details WHERE empid = '$this->empid'") 
        or die ("Error : ".mysql_error());
        
        if (mysql_num_rows($sql_staffotherdetails_checkrow) > 0)
        {
            mysql_query("UPDATE staff_other_details SET firstname = '$this->firstname', middlename = '$this->middlename',
                    surname = '$this->surname', mothersname = '$this->mothersname', fathersname = '$this->fathersname', 
                    domicile = '$this->domicile', phy_handicapped = '$this->phy_handicapped', fax_phone = '$this->fax_phone', 
                    bank_branch = '$this->bank_branch', iifc_code = '$this->iifc_code', fy_commsubteacher = '$this->fy_commsubteacher',
                    fy_commsubject = '$this->fy_commsubject', aicte_expert = '$this->aicte_expert', aicte_grant = '$this->aicte_grant'
                    WHERE empid = '$this->empid'") or die ("Error : ".mysql_error());
        }
        else 
        {
            mysql_query("INSERT INTO staff_other_details (empid, firstname, middlename, surname, mothersname, fathersname, domicile, 
                    phy_handicapped, fax_phone, bank_branch, iifc_code, fy_commsubteacher, fy_commsubject, aicte_expert, aicte_grant) 
                    VALUES ('$this->empid', '$this->firstname','$this->middlename', '$this->surname', '$this->mothersname', 
                    '$this->fathersname', '$this->domicile', '$this->phy_handicapped', '$this->fax_phone', '$this->bank_branch', 
                    '$this->iifc_code', '$this->fy_commsubteacher', '$this->fy_commsubject', '$this->aicte_expert', '$this->aicte_grant')") 
                    or die ("Error : ".mysql_error());
        } 
    }
    
    public function InsertUpdateStaffHighEducDetails()
    {
        $sql_staffhigheducdetails_checkrow = mysql_query("SELECT * FROM staff_higheduc_details WHERE empid = '$this->empid'") 
        or die ("Error : ".mysql_error());
        
        if (mysql_num_rows($sql_staffhigheducdetails_checkrow) > 0)
        {
            mysql_query("UPDATE staff_higheduc_details SET doctrate_deg = '$this->doctrate_deg', pg_deg = '$this->pg_deg', 
                    ug_deg = '$this->ug_deg', diploma = '$this->diploma', other_qual = '$this->other_qual', area_special = '$this->area_special', 
                    teach_years = '$this->teach_years', research_years = '$this->research_years', total_work_years = '$this->total_work_years', 
                    nat_public = '$this->nat_public', patents = '$this->patents', no_pg_proj = '$this->no_pg_proj', no_doc_proj = '$this->no_doc_proj',
                    inter_public = '$this->inter_public', books_pub = '$this->books_pub' WHERE empid = '$this->empid'") 
                    or die ("Error : ".mysql_error());
        }
        else 
        {
            mysql_query("INSERT INTO staff_higheduc_details (empid, doctrate_deg, pg_deg, ug_deg, diploma, other_qual, area_special, teach_years,
                    research_years, total_work_years, nat_public, patents, no_pg_proj, no_doc_proj, inter_public, books_pub) VALUES ('$this->empid',
                    '$this->doctrate_deg', '$this->pg_deg', '$this->ug_deg', '$this->diploma', '$this->other_qual', '$this->area_special', 
                    '$this->teach_years', '$this->research_years', '$this->total_work_years', '$this->nat_public', '$this->patents', '$this->no_pg_proj', 
                    '$this->no_doc_proj', '$this->inter_public', '$this->books_pub')") or die ("Error : ".mysql_error());
        } 
    }

    public function InsertUpdateStaffServiceBookRecord()
    {
        $sql_staffservicebookrecord_checkrow = mysql_query("SELECT * FROM staff_service_book_record WHERE empid = '$this->empid'") 
        or die ("Error : ".mysql_error()); 
        
        if (mysql_num_rows($sql_staffservicebookrecord_checkrow) > 0)
        {
            mysql_query("UPDATE staff_service_book_record SET guardian_address = '$this->guardian_address', birth_place ='$this->birth_place',
                    mother_tongue = '$this->mother_tongue', medical_examination_date = '$this->medical_examination_date',  height = '$this->height',
                    medical_examination_result = '$this->medical_examination_result', personal_marks_of_identification = '$this->personal_marks_of_identification', 
                    medical_certification_number = '$this->medical_certification_number', medical_certification_date = '$this->medical_certification_date',
                    medical_authority_name = '$this->medical_authority_name', medical_authority_designation = '$this->medical_authority_designation' 
                    WHERE empid = '$this->empid'") or die ("Error : ".mysql_error());
        }
        else
        {
            mysql_query("INSERT INTO staff_service_book_record (empid, guardian_address, birth_place, mother_tongue, medical_examination_date, 
                    medical_examination_result, height, personal_marks_of_identification, medical_certification_number, medical_certification_date,
                    medical_authority_name, medical_authority_designation) VALUES ('$this->empid', '$this->guardian_address', '$this->birth_place',
                    '$this->mother_tongue', '$this->medical_examination_date', '$this->medical_examination_result', '$this->height',
                    '$this->personal_marks_of_identification', '$this->medical_certification_number', '$this->medical_certification_date',
                    '$this->medical_authority_name', '$this->medical_authority_designation')") or die ("Error : ".mysql_error());             
        }        
    }
    
    public function InsertStaffQualification()
    {        
            mysql_query("INSERT INTO staff_qualification (empid, examination_certification, special_subject, university, year_passing, class, 
                    distinction) VALUES ('$this->empid', '$this->q_exam_cert', '$this->q_sp_sub', '$this->q_univ_name', '$this->q_pass_year',
                    '$this->q_class', '$this->q_distinction')") or die ("Error : ".mysql_error());        
    }
    
    public function UpdateStaffQualification()
    {        
            mysql_query("UPDATE staff_qualification SET examination_certification = '$this->q_exam_cert', special_subject = '$this->q_sp_sub', 
                    university = '$this->q_univ_name', year_passing = '$this->q_pass_year', class = '$this->q_class', distinction = '$this->q_distinction'
                    WHERE id = '$this->q_id'") or die ("Error : ".mysql_error());        
    }
    
    public function InsertStaffSpecialQualification()
    {        
            mysql_query("INSERT INTO staff_special_qualification (empid, examination, university, year_pass, class, distinction) VALUES 
                    ('$this->empid', '$this->sp_exam_cert', '$this->sp_univ_name', '$this->sp_pass_year',
                    '$this->sp_class', '$this->sp_distinction')") or die ("Error : ".mysql_error());        
    }
    
    public function UpdateStaffSpecialQualification()
    {        
            mysql_query("UPDATE staff_special_qualification SET examination = '$this->sp_exam_cert', university = '$this->sp_univ_name', 
                    year_pass ='$this->sp_pass_year', class = '$this->sp_class', distinction = '$this->sp_distinction' WHERE id = '$this->sp_id'") 
                    or die ("Error : ".mysql_error());        
    }
    
    public function InsertStaffInstituteExperience()
    {        
            mysql_query("INSERT INTO staff_institute_experience (empid, institute_name, service_from, service_to, leave_from, leave_to, basic_pay) 
                    VALUES ('$this->empid', '$this->si_inst_name', '$this->si_serv_from', '$this->si_serv_to', '$this->si_leave_from', 
                    '$this->si_leave_to', '$this->si_basic_pay')") or die ("Error : ".mysql_error());        
    }
    
    public function UpdateStaffInstituteExperience()
    {        
            mysql_query("UPDATE staff_institute_experience SET institute_name = '$this->si_inst_name', service_from = '$this->si_serv_from', 
                    service_to = '$this->si_serv_to', leave_from = '$this->si_leave_from', leave_to = '$this->si_leave_to', 
                    basic_pay = '$this->si_basic_pay' WHERE id = '$this->si_id'") or die ("Error : ".mysql_error());        
    }
}

?>
