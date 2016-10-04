<?php

/*
 * This Code has been created by Christopher Uzhuthuval
 * for the Project College Information System.
 */

/**
 * Description of Student
 *
 * 
 */


class Student {    
    private $Stud_ID;    
    private $ldap_username;
    private $Name;
    private $Sex;
    private $DOB;
    private $Local;
    private $Native;
    private $Contact_No;
    private $Nationality;
    private $Domicile;
    private $Religion;
    private $Category;
    private $POB;    
    private $Email;
    private $Form_No;
    private $prev_inst;
    private $doj;
//    private $dol;
    private $Blood_Grp;
    private $Allergies;
    private $Thalassemia;
    private $doc_name;
    private $doc_contact;
    private $doc_email;
    private $F_NAME;
    private $F_Occupation;
    private $F_Contact_No;
    private $F_Office_address;
    private $F_Annual_Income;
    private $F_Email_Id;
    private $M_Name;
    private $M_Occupation;
    private $M_Contact_No;
    private $M_Office_address;
    private $M_Annual_Income;
    private $M_Email_Id;
    private $Ref_Name1;
    private $Contact_No1;
    private $Address1;
    private $Relation1;
    private $Ref_Name2;
    private $Contact_No2;
    private $Address2;
    private $Relation2;    
    private $firstname;
    private $middlename;
    private $surname;
    private $mobile_no;
    private $phy_handicapped;
    private $eco_backward;
    private $f_mobile_no;
    private $m_mobile_no;
    private $att_def_hyp_dis;
    private $learn_disability;
    private $depression;
    private $other_diagnosis;
    private $psychiatric_medicine;
    private $cet_score;
    private $aieee_score;
    private $hsc_aggregate;
    private $hsc_outof;
    private $pcm_total;
    private $pcm_outof;
    private $ssc_aggregate;
    private $ssc_outof;
    private $diploma_aggregate;
    private $diploma_outof;
    private $prev_inst_name;
    private $prev_inst_address;    

    public function findStudID($ldap_username)
    {        
        $this->ldap_username = $ldap_username;
        $s_branch = substr($this->ldap_username, 0, 1);
        $s_year = '20'.substr($this->ldap_username, 1, 2);
        $s_registerno = substr($this->ldap_username, -4, 4);
        
        $tmp_studid[0] = $s_year.'1'.$s_branch.$s_registerno;
        $tmp_studid[1] = $s_year.'3'.$s_branch.$s_registerno;
        
        for ($i = 0; $i < 2; $i++)
        {            
            $sql_studid = mysql_query("SELECT * FROM student_details WHERE Stud_ID = '$tmp_studid[$i]'") 
            or die("Error : ".  mysql_error());
            if (mysql_num_rows($sql_studid) > 0)
            {                
                $this->Stud_ID = $tmp_studid[$i];
                break;
            }             
        }
        return $this->Stud_ID;        
    }
    
    public function setStudentDetails($student_id,$ldap_username,$name,$gender,
            $dob,$local_address,$native_address,$telephone_number,$nationality,$domicile,
            $religion,$category,$place_of_birth,$email,$form_num,$prev_inst,$doj,
            $blood_grp,$allergies,$thal,$doc_name,$doc_contact,$doc_email,$fname,$foccupation,
            $fphn,$foff_address,$fannual_income,$femail,$mname,$moccupation,$mphn,$moff_address,
            $mannual_income,$memail,$ref1name,$ref1phn,$ref1address,$ref1relation,$ref2name,
            $ref2phn,$ref2address,$ref2relation)
    {
        $this->Stud_ID = $student_id;        
        $this->ldap_username = $ldap_username;
        $this->Name = $name;
        $this->Sex = $gender;
        $this->DOB = $dob;
        $this->Local = $local_address;
        $this->Native = $native_address;
        $this->Contact_No = $telephone_number;
        $this->Nationality = $nationality;
        $this->Domicile = $domicile;
        $this->Religion = $religion;
        $this->Category = $category;
        $this->POB = $place_of_birth;        
        $this->Email = $email;
        $this->Form_No = $form_num;
        $this->prev_inst = $prev_inst;
        $this->doj = $doj;
//        $this->dol = $dol;
        $this->Blood_Grp = $blood_grp;
        $this->Allergies = $allergies;
        $this->Thalassemia = $thal;
        $this->doc_name = $doc_name;
        $this->doc_contact = $doc_contact;
        $this->doc_email = $doc_email;
        $this->F_NAME = $fname;
        $this->F_Occupation = $foccupation;
        $this->F_Contact_No = $fphn;
        $this->F_Office_address = $foff_address;
        $this->F_Annual_Income = $fannual_income;
        $this->F_Email_Id = $femail;
        $this->M_Name = $mname;
        $this->M_Occupation = $moccupation;
        $this->M_Contact_No = $mphn;
        $this->M_Office_address = $moff_address;
        $this->M_Annual_Income = $mannual_income;
        $this->M_Email_Id = $memail;
        $this->Ref_Name1 = $ref1name;
        $this->Contact_No1 = $ref1phn;
        $this->Address1 = $ref1address;
        $this->Relation1 = $ref1relation;
        $this->Ref_Name2 = $ref2name;
        $this->Contact_No2 = $ref2phn;
        $this->Address2 = $ref2address;
        $this->Relation2 = $ref2relation;       
    }
    
    public function setMoreStudentDetails($firstname,$middlename,$surname,$mobile_no,
            $phy_hand,$eco_back,$f_mobileno,$m_mobileno,$att_def_hyp_dis,$learn_disability,
            $depression,$other_diagnosis,$psychiatric_medicine)
    {        
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->surname = $surname;
        $this->mobile_no = $mobile_no;
        $this->phy_handicapped = $phy_hand;
        $this->eco_backward = $eco_back;
        $this->f_mobile_no = $f_mobileno;
        $this->m_mobile_no = $m_mobileno;
        $this->att_def_hyp_dis = $att_def_hyp_dis;
        $this->learn_disability = $learn_disability;
        $this->depression = $depression;
        $this->other_diagnosis = $other_diagnosis;
        $this->psychiatric_medicine = $psychiatric_medicine;
    }
    
    public function setPrevStudentQual($aieee,$cet,$hsc_agg,$hsc_outof,$pcm_total,$pcm_outof,
            $ssc_agg,$ssc_outof,$dip_agg,$dip_outof)
    {        
        $this->cet_score = $cet;
        $this->aieee_score = $aieee;
        $this->hsc_aggregate = $hsc_agg;
        $this->hsc_outof = $hsc_outof;
        $this->pcm_total = $pcm_total;
        $this->pcm_outof = $pcm_outof;
        $this->ssc_aggregate = $ssc_agg;
        $this->ssc_outof = $ssc_outof;
        $this->diploma_aggregate = $dip_agg;
        $this->diploma_outof = $dip_outof;        
    }
    
    public function setPrevInstMaster($prev_inst_add)
    {
        $this->prev_inst_name = $this->prev_inst;
        $this->prev_inst_address = $prev_inst_add;
    }
    
    public function InsertUpdateStudentDetails()
    {
        $sql_studdetails_checkrow = mysql_query("SELECT * FROM student_details WHERE Stud_ID = '$this->Stud_ID'") 
        or die ("Error : ".mysql_error());
        
        if (mysql_num_rows($sql_studdetails_checkrow) > 0)
        {
            mysql_query("UPDATE student_details SET ldap_username = '$this->ldap_username', Name = '$this->Name', 
                    Sex = '$this->Sex', DOB = '$this->DOB', Local = '$this->Local', Native = '$this->Native', 
                    Contact_No = '$this->Contact_No', Nationality = '$this->Nationality', Domicile = '$this->Domicile', 
                    Religion = '$this->Religion', Category = '$this->Category', POB = '$this->POB', Email = '$this->Email', 
                    Form_No = '$this->Form_No', prev_inst = '$this->prev_inst', doj = '$this->doj',  
                    Blood_Grp = '$this->Blood_Grp', Allergies = '$this->Allergies', Thalassemia = '$this->Thalassemia', 
                    doc_name = '$this->doc_name', doc_contact = '$this->doc_contact', doc_email = '$this->doc_email', 
                    F_NAME = '$this->F_NAME', F_Occupation = '$this->F_Occupation', F_Contact_No = '$this->F_Contact_No', 
                    F_Office_address = '$this->F_Office_address', F_Annual_Income = '$this->F_Annual_Income', 
                    F_Email_Id= '$this->F_Email_Id', M_Name = '$this->M_Name', M_Occupation = '$this->M_Occupation', 
                    M_Contact_No = '$this->M_Contact_No', M_Office_address = '$this->M_Office_address', 
                    M_Annual_Income = '$this->M_Annual_Income', M_Email_Id = '$this->M_Email_Id', Ref_Name1 = '$this->Ref_Name1', 
                    Contact_No1 = '$this->Contact_No1', Address1 = '$this->Address1', Relation1 = '$this->Relation1', 
                    Ref_Name2 = '$this->Ref_Name2', Contact_No2 = '$this->Contact_No2', Address2 = '$this->Address2', 
                    Relation2 = '$this->Relation2' WHERE Stud_ID ='$this->Stud_ID'") or die ("Error1 : ".mysql_error());
        }
        else
        {            
            mysql_query("INSERT INTO student_details (Stud_ID, ldap_username, Name, Sex, DOB, Local, Native, Contact_No,
                    Nationality, Domicile, Religion, Category, POB, Email, Form_No, prev_inst, doj, Blood_Grp, Allergies,
                    Thalassemia, doc_name, doc_contact, doc_email, F_NAME, F_Occupation, F_Contact_No, F_Office_address, 
                    F_Annual_Income, F_Email_Id, M_Name, M_Occupation, M_Contact_No, M_Office_address, M_Annual_Income, M_Email_Id,
                    Ref_Name1, Contact_No1, Address1, Relation1, Ref_Name2, Contact_No2, Address2, Relation2) VALUES 
                    ('$this->Stud_ID', '$this->ldap_username', '$this->Name', '$this->Sex', '$this->DOB', '$this->Local', 
                    '$this->Native', '$this->Contact_No', '$this->Nationality', '$this->Domicile', '$this->Religion', 
                    '$this->Category', '$this->POB', '$this->Email', '$this->Form_No', '$this->prev_inst', '$this->doj', 
                    '$this->Blood_Grp', '$this->Allergies', '$this->Thalassemia', '$this->doc_name', '$this->doc_contact',
                    '$this->doc_email', '$this->F_NAME', '$this->F_Occupation', '$this->F_Contact_No', '$this->F_Office_address', 
                    '$this->F_Annual_Income', '$this->F_Email_Id', '$this->M_Name', '$this->M_Occupation', '$this->M_Contact_No', 
                    '$this->M_Office_address', '$this->M_Annual_Income', '$this->M_Email_Id', '$this->Ref_Name1', '$this->Contact_No1', 
                    '$this->Address1', '$this->Relation1', '$this->Ref_Name2', '$this->Contact_No2', '$this->Address2', 
                    '$this->Relation2')") or die ("Error1 : ".mysql_error());
        }
    }
    
    public function InsertUpdateMoreStudentDetails()
    {
        $sql_studmoredetails_checkrow = mysql_query("SELECT * FROM student_more_details WHERE Stud_ID = '$this->Stud_ID'") 
        or die ("Error : ".mysql_error());
        
        if (mysql_num_rows($sql_studmoredetails_checkrow) > 0)
        {
            mysql_query("UPDATE student_more_details SET firstname = '$this->firstname', 
                    middlename = '$this->middlename', surname = '$this->surname', mobile_no = '$this->mobile_no',
                    phy_handicapped = '$this->phy_handicapped', eco_backward = '$this->eco_backward',
                    f_mobile_no = '$this->f_mobile_no', m_mobile_no = '$this->m_mobile_no', 
                    att_def_hyp_dis = '$this->att_def_hyp_dis', learn_disability = '$this->learn_disability',
                    depression = '$this->depression', other_diagnosis = '$this->other_diagnosis', 
                    psychiatric_medicine = '$this->psychiatric_medicine' WHERE Stud_ID = '$this->Stud_ID'") 
                    or die ("Error2 : ".mysql_error());
        }
        else
        {
            mysql_query("INSERT INTO student_more_details (Stud_ID, firstname, middlename, surname, mobile_no, 
                    phy_handicapped, eco_backward, f_mobile_no, m_mobile_no, att_def_hyp_dis, learn_disability, 
                    depression, other_diagnosis, psychiatric_medicine) VALUES ('$this->Stud_ID', '$this->firstname',
                    '$this->middlename', '$this->surname', '$this->mobile_no', '$this->phy_handicapped', 
                    '$this->eco_backward', '$this->f_mobile_no', '$this->m_mobile_no', '$this->att_def_hyp_dis',
                    '$this->learn_disability', '$this->depression', '$this->other_diagnosis', '$this->psychiatric_medicine')") 
                    or die ("Error2 : ".mysql_error());
        }
    }
    
    public function InsertUpdatePrevStudentQual()
    {
        $sql_prevqual_checkrow = mysql_query("SELECT * FROM student_prev_qual WHERE Stud_ID = '$this->Stud_ID'") 
        or die ("Error : ".mysql_error()); 
        
        if (mysql_num_rows($sql_prevqual_checkrow) > 0)
        {
            mysql_query("UPDATE student_prev_qual SET cet_score = '$this->cet_score', 
                    aieee_score = '$this->aieee_score', hsc_aggregate = '$this->hsc_aggregate', 
                    hsc_outof = '$this->hsc_outof', pcm_total = '$this->pcm_total', pcm_outof = '$this->pcm_outof',
                    ssc_aggregate = '$this->ssc_aggregate', ssc_outof = '$this->ssc_outof', 
                    diploma_aggregate = '$this->diploma_aggregate', diploma_outof = '$this->diploma_outof'
                    WHERE Stud_ID = '$this->Stud_ID'") or die ("Error3 : ".mysql_error());
        }
        else
        {
            mysql_query("INSERT INTO student_prev_qual (Stud_ID, cet_score, aieee_score, hsc_aggregate, hsc_outof,
                    pcm_total, pcm_outof, ssc_aggregate, ssc_outof, diploma_aggregate, diploma_outof) VALUES 
                    ('$this->Stud_ID', '$this->cet_score', '$this->aieee_score', '$this->hsc_aggregate', 
                    '$this->hsc_outof', '$this->pcm_total', '$this->pcm_outof', '$this->ssc_aggregate', 
                    '$this->ssc_outof', '$this->diploma_aggregate', '$this->diploma_outof')") 
                    or die ("Error3 : ".mysql_error());
        }
    }
    
    public function InsertUpdatePrevInstMaster()
    {
        $sql_previnstmaster = mysql_query("SELECT * FROM prev_inst_master WHERE prev_inst_name = '$this->prev_inst_name'")
        or die ("Error : ".mysql_error());
        
        if (mysql_num_rows($sql_previnstmaster) > 0)
        {
            mysql_query("UPDATE prev_inst_master SET prev_inst_address = '$this->prev_inst_address' WHERE 
                    prev_inst_name = '$this->prev_inst_name'") or die ("Error4 : ".mysql_error());
        }
        else
        {       
            mysql_query("INSERT INTO prev_inst_master (prev_inst_name, prev_inst_address) VALUES ('$this->prev_inst_name',
                    '$this->prev_inst_address')") or die ("Error4 : ".mysql_error());
        }
    }
    
}

?>
