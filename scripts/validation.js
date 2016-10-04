/*
This Script has been written by Christopher Uzhuthuval to Validate the Data Entry made in Student Info System.

*/

return_str = "The following fields are invalid : \n\n";

function validate_text(obj)
{	
	if(obj.value != "")
		return true;
	else
	{
		return_str += "* " + obj.title + " cannot be empty!\n";
		return false;
	}
}

function validate_text_no(obj)
{	
	if(obj.value != "")
		return true;
	else
	{
//		return_str += "* " + obj.title + " cannot be empty!\n";
		return false;
	}
}

function validate_numbers(obj)
{
	if(isNaN(obj.value))
	{
		return_str += "* " + obj.title + " should contain only numbers!\n";
		return false;
	}
	else
		return true;
}

//--------------- Old Email ---------------- 
//function validate_email(str)
//{
//	at = "@";
//	dot = ".";
//        var lat=str.indexOf("@");
//        var lstr=str.length;
//        var ldot=str.indexOf(".");
//	
//	truth_value = 1;
//	//if(str == "") truth_value *= 0;
//	if(str != "")
//	{
//        if (str.indexOf(at)==-1) truth_value *= 0;
//        if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr) truth_value *= 0;
//        if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr) truth_value *= 0;
//        if (str.indexOf(at,(lat+1))!=-1) truth_value *= 0;
//        if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot) truth_value *= 0;
//        if (str.indexOf(dot,(lat+2))==-1)  truth_value *= 0;
//        if (str.indexOf(" ")!=-1) truth_value *= 0;
//	}
//	if(truth_value == 0)
//	{
//		return_str += "* Invalid email address : " + str + "\n";
//		return false;
//	}
//	return true;
//}

function validate_radio(obj)
{
	if(obj[0].checked == true || obj[1].checked == true)
		return true;
	else
	{
		return_str += "* " + obj[0].title + " not checked!\n";
		return false;
	}
}

function validate_date(obj)
{
        objv = obj.value;
	if (objv.match(/^(19|20)\d\d([- /])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/))
		return true;
	else
	{
		return_str += "* " + obj.title + " format incorrect!\n";
		return false;
	}
}

function validate_selectbox(obj)
{	
	if(obj.selectedIndex == 0)
	{		
		return_str += "* " + obj.title + " not selected!\n";
		return false;
	}	
	else
		return true;
}

function validate_email(obj)
{
        objv = obj.value;
//      Modified the below Regualar Expression below to allow Capital Letters. 
        if (objv.match(/^[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/)) 
		return true;
	else
	{
		return_str += "* Invalid email address : " + obj.title + "\n";
		return false;
	}	
}

function validate_all()
{

	return_str = "The following fields are invalid : \n\n";
	final_truth = 1;

//	---------------- Personal Details -----------------
	final_truth *= validate_text(document.form.ln) ? 1 : 0;
 	final_truth *= validate_text(document.form.fn) ? 1 : 0;
//	final_truth *= validate_text(document.form.mn) ? 1 : 0;
//	final_truth *= validate_text(document.form.sn) ? 1 : 0;
	final_truth *= validate_radio(document.form.gender) ? 1 : 0;
	final_truth *= validate_date(document.form.dob) ? 1 : 0;
	final_truth *= validate_email(document.form.email) ? 1: 0;
	if (document.form.local_address)
	{
		final_truth *= validate_text(document.form.local_address) ? 1 : 0;
	}
	else
	{
		final_truth *= validate_text(document.form.local_) ? 1 : 0;
		final_truth *= validate_text(document.form.local_city) ? 1 : 0;
		final_truth *= validate_text(document.form.local_state) ? 1 : 0;
	}
	if (document.form.native_address)
	{
		final_truth *= validate_text(document.form.native_address) ? 1 : 0;
	}
	else
	{
		final_truth *= validate_text(document.form.native_) ? 1 : 0;
		final_truth *= validate_text(document.form.native_city) ? 1 : 0;
		final_truth *= validate_text(document.form.native_state) ? 1 : 0;
	}
	
	final_truth *= validate_numbers(document.form.phn) ? 1 : 0;
	final_truth *= validate_text(document.form.phn) ? 1 : 0;
	final_truth *= validate_numbers(document.form.mob_no) ? 1 : 0;
	final_truth *= validate_text(document.form.mob_no) ? 1 : 0;
	final_truth *= validate_text(document.form.Nation) ? 1 : 0;
	
	if (document.form.n_domicile)
	{
		final_truth *= validate_text(document.form.n_domicile) ? 1 : 0;
	}
	else
	{
		if(document.form.domicile1.disabled)
			document.form.domicile.value = document.form.domicile2.value;
		else if(document.form.domicile2.disabled)
			document.form.domicile.value = document.form.domicile1.value;
		final_truth *= validate_text(document.form.domicile) ? 1 : 0;		
	}	
	
	if (document.form.o_Religion.value.length < 4)
	{
		final_truth *= validate_selectbox(document.form.Religion) ? 1: 0;
	}
	
	if (document.form.o_Category.value.length < 3)
	{
		final_truth *= validate_selectbox(document.form.Category) ? 1: 0;
	}
	
	final_truth *= validate_radio(document.form.phy_hand) ? 1 : 0;
	final_truth *= validate_radio(document.form.eco_back) ? 1 : 0;
	final_truth *= validate_text(document.form.POB) ? 1: 0;

//	---------------- Academic Details -----------------	
//	final_truth *= validate_numbers(document.form.form_num) ? 1 : 0;
	final_truth *= validate_date(document.form.doj) ? 1 : 0;
//	final_truth *= validate_date(document.form.dol) ? 1 : 0;
	
	if (document.form.o_prev_inst.value.length < 3)
	{
		final_truth *= validate_text(document.form.prev_inst) ? 1: 0;
	}
	
	final_truth *= validate_numbers(document.form.aieee) ? 1 : 0;	
	final_truth *= validate_numbers(document.form.cet) ? 1 : 0;

        aieee_sc = validate_text_no(document.form.aieee) ? 1 : 0; 
        cet_sc = validate_text_no(document.form.cet) ? 1 : 0;
        
        if (aieee_sc == 0 && cet_sc == 0 && document.form.dip_agg.value == 'If Applicable')
        {   
            return_str += "* Either CET OR AIEEE OR Diploma need to be Entered\n";
            final_truth *= 0;            
        }
        
	final_truth *= validate_numbers(document.form.hsc_agg) ? 1 : 0;
	final_truth *= validate_numbers(document.form.hsc_outof) ? 1 : 0;
	final_truth *= validate_numbers(document.form.pcm_total) ? 1 : 0;
	final_truth *= validate_numbers(document.form.pcm_outof) ? 1 : 0;
	final_truth *= validate_numbers(document.form.ssc_agg) ? 1 : 0;
	final_truth *= validate_text(document.form.ssc_agg) ? 1 : 0;
	final_truth *= validate_numbers(document.form.ssc_outof) ? 1 : 0;
	final_truth *= validate_text(document.form.ssc_outof) ? 1 : 0;
	
	if (document.form.dip_agg.value != 'If Applicable')
	{
		final_truth *= validate_numbers(document.form.dip_agg) ? 1 : 0;
	}
	if (document.form.dip_outof.value != 'If Applicable')
	{
		final_truth *= validate_numbers(document.form.dip_outof) ? 1 : 0;
	}	

//	---------------- Health Details -----------------	
	final_truth *= validate_numbers(document.form.doc_contact) ? 1 : 0;
	
	if (document.form.doc_email.value != "")
	{
		final_truth *= validate_email(document.form.doc_email) ? 1: 0;
	}
	
//	---------------- Parents Details -----------------	
	if (document.form.fname)
	{
		final_truth *= validate_text(document.form.fname) ? 1 : 0;
	}
	else
	{
//		final_truth *= validate_text(document.form.fln) ? 1 : 0;
		final_truth *= validate_text(document.form.ffn) ? 1 : 0;
	}
	
	final_truth *= validate_text(document.form.foccupation) ? 1 : 0;
	final_truth *= validate_text(document.form.foff_address) ? 1: 0;
	final_truth *= validate_numbers(document.form.fphn) ? 1 : 0;
	final_truth *= validate_numbers(document.form.f_mobileno) ? 1 : 0;
	final_truth *= validate_text(document.form.f_mobileno) ? 1: 0;
	final_truth *= validate_numbers(document.form.fannual_income) ? 1: 0;

	if (document.form.femail.value != "")
	{
		final_truth *= validate_email(document.form.femail) ? 1: 0;
	}

	if (document.form.mname)
	{
		final_truth *= validate_text(document.form.mname) ? 1 : 0;
	}
	else
	{
//		final_truth *= validate_text(document.form.mln) ? 1 : 0;
		final_truth *= validate_text(document.form.mfn) ? 1 : 0;
	}
	
	final_truth *= validate_text(document.form.moccupation) ? 1 : 0;
//	final_truth *= validate_text(document.form.moff_address) ? 1: 0;
	final_truth *= validate_numbers(document.form.mphn) ? 1 : 0;
	final_truth *= validate_numbers(document.form.m_mobileno) ? 1 : 0;
	final_truth *= validate_text(document.form.m_mobileno) ? 1: 0;
	final_truth *= validate_numbers(document.form.mannual_income) ? 1: 0;

	if (document.form.memail.value != "")
	{
		final_truth *= validate_email(document.form.memail) ? 1: 0;
	}

//	---------------- Reference Details -----------------
	final_truth *= validate_numbers(document.form.ref1phn) ? 1 : 0;
	final_truth *= validate_numbers(document.form.ref2phn) ? 1 : 0;
	
	if(final_truth == 1)
	{		
		return true;
	}
	else
	{
		alert(return_str);
		return false;
	}
}

