/*

This Script has been written by Christopher Uzhuthuval to Validate the Date Entry made in Staff Info System.

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
//      Modified the below Regular Expression below to allow Capital Letters. 
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
	if (document.form.permnt_address)
	{
		final_truth *= validate_text(document.form.permnt_address) ? 1 : 0;
	}
	else
	{
		final_truth *= validate_text(document.form.permnt_) ? 1 : 0;
		final_truth *= validate_text(document.form.permnt_city) ? 1 : 0;
		final_truth *= validate_text(document.form.permnt_state) ? 1 : 0;
	}
	
	final_truth *= validate_numbers(document.form.mobile) ? 1 : 0;
	final_truth *= validate_text(document.form.mobile) ? 1 : 0;
        final_truth *= validate_numbers(document.form.landline) ? 1 : 0;
	final_truth *= validate_text(document.form.landline) ? 1 : 0;
	final_truth *= validate_numbers(document.form.emergency) ? 1 : 0;
	final_truth *= validate_text(document.form.emergency) ? 1 : 0;	
        final_truth *= validate_radio(document.form.phy_hand) ? 1 : 0;
        final_truth *= validate_text(document.form.nationality) ? 1 : 0;
	
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
	

//	---------------- Work Details -----------------	

        final_truth *= validate_text(document.form.dept) ? 1 : 0;
        
        if (document.form.sel_desig)
        {           
            if (document.form.sel_desig.value == 'Others')
            {
                document.form.desig.value = document.form.tex_desig.value;
                final_truth *= validate_text(document.form.desig) ? 1 : 0;
            }
            else
            {
                final_truth *= validate_selectbox(document.form.sel_desig) ? 1 : 0;
                document.form.desig.value = document.form.sel_desig.value;                
            }
        }
        else
        {
            final_truth *= validate_text(document.form.desig) ? 1 : 0;
        }
        //alert(document.form.desig.value);
        final_truth *= validate_text(document.form.PAN) ? 1 : 0;        
        final_truth *= validate_text(document.form.b_name) ? 1 : 0;
	final_truth *= validate_numbers(document.form.accnt_num) ? 1 : 0;
        final_truth *= validate_text(document.form.accnt_num) ? 1 : 0;
	final_truth *= validate_date(document.form.doj) ? 1 : 0;
	final_truth *= validate_radio(document.form.fy_commsubteacher) ? 1 : 0;
	        
        if (document.form.fy_commsubteacher[0].checked == true)
        {
            final_truth *= validate_text(document.form.fy_commsubject) ? 1 : 0;
        }		

//	---------------- Experience Details -----------------	

        final_truth *= validate_radio(document.form.doctrate_deg) ? 1 : 0;
//      final_truth *= validate_text(document.form.ug_deg) ? 1 : 0;
//      final_truth *= validate_text(document.form.area_special) ? 1 : 0;
        final_truth *= validate_numbers(document.form.teach_years) ? 1 : 0;
//        final_truth *= validate_text(document.form.teach_years) ? 1 : 0;
	final_truth *= validate_numbers(document.form.research_years) ? 1 : 0;
//      final_truth *= validate_text(document.form.research_years) ? 1 : 0;
        final_truth *= validate_numbers(document.form.no_pg_proj) ? 1 : 0;
	final_truth *= validate_numbers(document.form.no_doc_proj) ? 1 : 0;
	
//	---------------- Family Details -----------------

        if (document.form.marital.value == 'married')
        {
            final_truth *= validate_text(document.form.spouse_name) ? 1 : 0;
        }

	if (document.form.fname)
	{
		final_truth *= validate_text(document.form.fname) ? 1 : 0;
	}
	else
	{
//		final_truth *= validate_text(document.form.fln) ? 1 : 0;
		final_truth *= validate_text(document.form.ffn) ? 1 : 0;
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
	
        final_truth *= validate_numbers(document.form.fmly_no) ? 1 : 0;
        final_truth *= validate_numbers(document.form.depndnt_no) ? 1 : 0;

//	---------------- Other Details -----------------

	final_truth *= validate_radio(document.form.aicte_expert) ? 1 : 0;
        final_truth *= validate_radio(document.form.aicte_grant) ? 1 : 0;
	
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

function dropbox_invisible()
{
        document.getElementById("textbox").style.display = "block";
        document.getElementById("dropbox").style.display = "none";	
}