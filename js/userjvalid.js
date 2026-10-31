// Check Field
// For Other Domain
 
var flag;
// Email Validation
function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

 		 return true					
	}


 

function isEmpty(field,fieldName)
{
	if(field.value.replace(/^\s+/,"")=="")
	{
		alert(fieldName+'Required');
		field.focus();
		return false;
	}
	else
		return true;
}
function isNotSelected(field,fieldName)
{
	if(field.value.replace(/^\s+/,"")=="none" || field.value.replace(/^\s+/,"")=="0")
	{
		alert(fieldName+' Required');
		field.focus();
		
		return false;
	}
	else
		return true;
}


// Check Field For Customer
 
function checkFieldUser()
{
	// check Login Name
	 
	 
	var user_loginname_vc=document.getElementById('user_loginname_vc');
	flag=isEmpty(user_loginname_vc,'Login Name');
	if(flag==false)	
		return false;
	
	// check Password
	if(document.getElementById('user_code_int').value=="")
	{
		 
		var user_pass_vc=document.getElementById('user_pass_vc');
		flag=isEmpty(user_pass_vc,'Password');
		if(flag==false)	
			return false;
	}
	 
	// check First Name
	var first_name_vc=document.getElementById('first_name_vc');
	flag=isEmpty(first_name_vc,'First Name');
	if(flag==false)	
		return false;
		// check Last Name
	var last_name_vc=document.getElementById('last_name_vc');
	flag=isEmpty(last_name_vc,'Last Name');
	if(flag==false)	
		return false;
	
	// check Country
	var selcountry=document.getElementById('selcountry');
	flag=isNotSelected(selcountry,'Country ');
	if(flag==false)	
		return false;
	
	// check State
	var selstate=document.getElementById('selstate');
	flag=isNotSelected(selstate,'State ');
	if(flag==false)	
		return false;	
	// check City
	var selcity=document.getElementById('selcity');
	flag=isNotSelected(selcity,'City ');
	if(flag==false)	
		return false;		
		
		// check Phone No
	var user_phone_vc=document.getElementById('user_phone_vc');
	 
	// check Direction
	var user_mobile_vc=document.getElementById('user_mobile_vc');
	 
	if(user_phone_vc.value=="" && user_mobile_vc.value=="" ) 
	{
		alert('Either Phone or Mobile No Require');
		return false;
	}
	// check Email
	var user_email_vc=document.getElementById('user_email_vc');
	flag=isEmpty(user_email_vc,'Email Id');
	if(flag==false)	
		return false;		
	if(echeck(user_email_vc.value)==false){
		user_email_vc.value=""
		user_email_vc.focus()
		return false
	}
	
	// Alt Email
	var user_altemail_vc=document.getElementById('user_altemail_vc');
	 
	if(user_altemail_vc.value!="")	
	{		
		if(echeck(user_altemail_vc.value)==false){
		user_altemail_vc.value=""
		user_altemail_vc.focus()
		return false
		}
	}
	 
	
}
 
// Check Field For User Information
function checkToursField()
{
	
	 
	// check City
	var selcategory=document.getElementById('selcategory');
	flag=isNotSelected(selcategory,'Category ');
	if(flag==false)	
		return false;
	
	// check Blog Title 	  
	var tour_name=document.getElementById('tour_name');
	flag=isEmpty(tour_name,'Tour Name');
	if(flag==false)	
		return false;
	 
	// check blog Desc
	var tour_desc=document.getElementById('tour_desc');
	flag=isEmpty(tour_desc,'Tour Description');
	if(flag==false)	
		return false;
	
	// check Blog Title 	  
	var tour_cost=document.getElementById('tour_cost');
	flag=isEmpty(tour_cost,'Tour Cost');
	if(flag==false)	
		return false;
	 
	 // check Blog Title 	  
	var tour_cost_desc=document.getElementById('tour_cost_desc');
	flag=isEmpty(tour_cost_desc,'Tour Cost Description ');
	if(flag==false)	
		return false;
	 
	 // check Blog Title 	  
	if(document.getElementById('tour_id')=="")
	{ 
		var tour_image=document.getElementById('tour_image');
		flag=isEmpty(tour_image,'Tour Image ');
		if(flag==false)	
			return false; 
	}
	 return true;
	
}
// Check Iternary Field
function checkItenaryField()
{ 
	// check Blog Title 	  
	var itenary_day=document.getElementById('itenary_day');
	flag=isEmpty(itenary_day,'Itenary Day ');
	if(flag==false)	
		return false;
	 
	// check blog Desc
	var itenary_desc=document.getElementById('itenary_desc');
	flag=isEmpty(itenary_desc,'Itenary Description');
	if(flag==false)	
		return false;
	
	// check Blog Title 	  
	var itenary_order=document.getElementById('itenary_order');
	flag=isEmpty(itenary_order,'Itenary Order');
	if(flag==false)	
		return false;
	 
	 return true;
	
}
function checkOfferField()
{ 
	// check Blog Title 	  
	var offer_startdate=document.getElementById('offer_startdate');
	flag=isEmpty(offer_startdate,'Offer Start On ');
	if(flag==false)	
		return false;
	 
	// check blog Desc
	var offer_desc=document.getElementById('offer_desc');
	flag=isEmpty(offer_desc,'Offer Description');
	if(flag==false)	
		return false;
	 
	 
	 return true;
	
}
function checkFormElements(f)
{
  for (var n=0; n < f.elements.length; n++) {
    var formElement = "";
		formElement =  f.elements[n];
	 	//alert(formElement.className);
		cls=new Array();
		cls=formElement.className.split(' '); 
	  	 
	 
	// if Element is Text Box 
	if(cls[0]=="txtrequired")
	{ 
			if(formElement.id=='cont_phno' && formElement.value=='' && f.elements[n-1].value=='' )
			{
				alert('Either Mobile or Phone No Required')
				return false;
			}
			else if(formElement.id!='cont_phno') {
			fieldName=formElement.id.replace('_'," ") 
			flag=isEmpty(formElement,fieldName);
			 if(flag==false)	
				return false;
			}
		 
	} 
	if(cls[0]=="txtreqd")
	{ 
			fieldName=formElement.id.replace('_'," ") 
			flag=isEmpty(formElement,fieldName);
			 if(flag==false)	
				return false;
			
		 
	} 
	 
	if(cls[0]=="txtrequiredpass")
	{
 	 
			fieldName=formElement.id.replace('_'," ") 
			flag=isEmpty(formElement,fieldName);
			 if(flag==false)	
				return false;
		 
		 newpass =  f.elements[n-1];
		 if(newpass.value!=formElement.value)
		 {
			 alert("New Password and Cofirm Password does not match")
			 formElement.focus();
			 return false; 
		}
		 
		 
	} 
	else if(cls[0]=="txtrequiredsel") // If Element is Selected Box
	{
		 
		 
			fieldName=formElement.id.replace('_'," ")  
			flag=isNotSelected(formElement,fieldName);
			if(flag==false)	
			return false;
		 
			 
	} 
	else if(cls[0]=="txtrequiredemail") // If Element is Selected Box
	{
		 // check Field is Empty
		fieldName=formElement.id.replace('_'," ")  
		flag=isEmpty(formElement,fieldName);
		 if(flag==false)	
			return false;
		// check is Valid Email	
		if(echeck(formElement.value)==false){
			formElement.value=""
			formElement.focus()
			return false
		} 
	} // else if
	else if(cls[0]=="txtemail") // If Element is Selected Box
	{
		 // check Field is Empty 
		 if(formElement.value!="" && echeck(formElement.value)==false)
		 {
			formElement.value=""
			formElement.focus()
			return false
			 
		 }
	} // else if
	else if(cls[0]=="txtrequiredphone") // If Element is Selected Box
	{
		 // check Field is Empty
		fieldName=formElement.id.replace('_'," ")  
		flag=isEmpty(formElement,fieldName);
		 if(flag==false)	
			return false;
		// check is Valid Email	
		 if(formElement.value.length<10)
		 {
			alert(fieldName+" should be in 10 Digits")
			formElement.focus();
			return false;
			 
		 }
	} // else if
	else if(cls[0]=="txtphone") // If Element is Selected Box
	{
		 // check Field is Empty
		fieldName=formElement.id.replace('_'," ")   
		// check is Valid Email	
		 if(formElement.value!="" && formElement.value.length<10)
		 {
			alert(fieldName+" should be in 10 Digits")
			formElement.focus();
			return false;
			 
		 }
	} // else if 
	else if(cls[0]=="txtrequiredchk") // If Element is Selected Box
	{
		// alert(formElement 
		
		if(formElement.name=='existing_act_vc[]') // if formElement name is frame type
		{
				 
				chk=document.frm[formElement.name]	
				 
				fieldName=formElement.id;
				fieldName=fieldName.substr(0,fieldName.length-2);
				fieldName=fieldName.replace('_'," ")
				   
				 t=0;
				 for (counter = 0; counter < chk.length; counter++)
					{ 
						  
						if (chk[counter].checked==false)
							t++;
							 
					}
					 
					if(t==chk.length)
					{
						alert(fieldName+' required');
						return false;
					}
		}
		if(formElement.name=='chkterms') // if formElement name is frame type
		{
				
				if(!formElement.checked)
				{
					alert("Terms and Condition Required");
					return false;
					
				} 
		}
		 
	} // else if
	
  }	// end for loop
	 
return true;
}

function checkFormElements1(f)
{
  for (var n=0; n < f.elements.length; n++) {
    var formElement = "";
		formElement =  f.elements[n];
	 	//alert(formElement.className);
		cls=new Array();
		cls=formElement.className.split(' '); 
	  	 
	 
	// if Element is Text Box 
	if(cls[0]=="txtrequired")
	{ 
			if(formElement.id=='cont_phno' && formElement.value=='' && f.elements[n-1].value=='' )
			{
				alert('Either Mobile or Phone No Required')
				return false;
			}
			else if(formElement.id!='cont_phno') {
			fieldName=formElement.id.replace('_'," ") 
			flag=isEmpty(formElement,fieldName);
			 if(flag==false)	
				return false;
			}
		 
	} 
	if(cls[0]=="txtreqd")
	{ 
		fieldName=formElement.id.replace('_'," ") 
		flag=isEmpty(formElement,fieldName);
		 if(flag==false)	
			return false;
	} 
	 
	if(cls[0]=="txtrequiredpass")
	{
 	 
			fieldName=formElement.id.replace('_'," ") 
			flag=isEmpty(formElement,fieldName);
			 if(flag==false)	
				return false;
		 
		 newpass =  f.elements[n-1];
		 if(newpass.value!=formElement.value)
		 {
			 alert("New Password and Cofirm Password does not match")
			 formElement.focus();
			 return false; 
		}
		 
		 
	} 
	else if(cls[0]=="txtrequiredsel") // If Element is Selected Box
	{
		 
		 
			fieldName=formElement.id.replace('_'," ")  
			flag=isNotSelected(formElement,fieldName);
			if(flag==false)	
			return false;
		 
			 
	} 
	else if(cls[0]=="txtrequiredemail") // If Element is Selected Box
	{
		 // check Field is Empty
		fieldName=formElement.id.replace('_'," ")  
		flag=isEmpty(formElement,fieldName);
		 if(flag==false)	
			return false;
		// check is Valid Email	
		if(echeck(formElement.value)==false){
			formElement.value=""
			formElement.focus()
			return false
		} 
	} // else if
	else if(cls[0]=="txtemail") // If Element is Selected Box
	{
		 // check Field is Empty 
		 if(formElement.value!="" && echeck(formElement.value)==false)
		 {
			formElement.value=""
			formElement.focus()
			return false
			 
		 }
	} // else if
	else if(cls[0]=="txtrequiredphone") // If Element is Selected Box
	{
		 // check Field is Empty
		fieldName=formElement.id.replace('_'," ")  
		flag=isEmpty(formElement,fieldName);
		 if(flag==false)	
			return false;
		// check is Valid Email	
		 if(formElement.value.length<10)
		 {
			alert(fieldName+" should be in 10 Digits")
			formElement.focus();
			return false;
			 
		 }
	} // else if
	else if(cls[0]=="txtphone") // If Element is Selected Box
	{
		 // check Field is Empty
		fieldName=formElement.id.replace('_'," ")   
		// check is Valid Email	
		 if(formElement.value!="" && formElement.value.length<10)
		 {
			alert(fieldName+" should be in 10 Digits")
			formElement.focus();
			return false;
			 
		 }
	} // else if 
	else if(cls[0]=="txtrequiredchk") // If Element is Selected Box
	{
		// alert(formElement 
		
		fieldName=formElement.id.replace('_'," ")  
		flag=isNotChecked(formElement,fieldName);
		if(flag==false)	
		return false;
		
		if(formElement.name=='chkterms') // if formElement name is frame type
		{
				
				if(!formElement.checked)
				{
					alert("Terms and Condition Required");
					return false;
					
				} 
		}
		 
	} // else if
	
  }	// end for loop

	var fname = f.fname_vc.value;
	var mname = f.mname_vc.value;
	var lname = f.lname_vc.value;

	var native = f.village_id.value;
	var gotra = f.gotra_id.value;

	var dob = f.birth_date.value;

	var email = f.email.value;

	var mobile_home = f.mobile_home.value;

	if (f.txtMode.value=="A")
	{
		ret1 = checkUserExistenceinDB(fname,mname,lname,native,gotra,dob,email,mobile_home);
		return false;	
	}
	else
	{
		return true;
	}
}
