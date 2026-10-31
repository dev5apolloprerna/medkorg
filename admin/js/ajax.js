 
// get City
function getSubCat(field,subcode,cmbnm,divnm,oldcode)
{
	 
	var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else if (window.ActiveXObject)
  {
  // code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
else
  {
  alert("Your browser does not support XMLHTTP!");
  }
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
     document.getElementById(divnm).innerHTML=xmlhttp.responseText;
  }
}
 catCode=field
url="ajax.php?act=getsubcat&catcode="+catCode+"&subcode="+subcode+"&cmbnm="+cmbnm+"&oldcode="+oldcode;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

} 

// get State
function getState(field,oldcode)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else if (window.ActiveXObject)
	  {
	  // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	else
	  {
	  alert("Your browser does not support XMLHTTP!");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		document.getElementById('tdstate').innerHTML=xmlhttp.responseText;
	  }
	}
	countrycode=field;
	statecode=oldcode;
	
	url="ajax.php?act=getstate&countrycode="+countrycode+"&statecode="+statecode;
	 
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

// get State
function getCity(field,oldcode)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else if (window.ActiveXObject)
	  {
	  // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	else
	  {
	  alert("Your browser does not support XMLHTTP!");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		document.getElementById('tdcity').innerHTML=xmlhttp.responseText;
	  }
	}
	
	statecode=field;
	citycode=oldcode;
	
	url="ajax.php?act=getcity&statecode="+statecode+"&citycode="+citycode;
	 
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

// get State
function getJobState(field,oldcode)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else if (window.ActiveXObject)
	  {
	  // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	else
	  {
	  alert("Your browser does not support XMLHTTP!");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		document.getElementById('tdjstate').innerHTML=xmlhttp.responseText;
	  }
	}
	countrycode=field;
	statecode=oldcode;
	
	url="ajax.php?act=getjstate&countrycode="+countrycode+"&statecode="+statecode;
	 
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

// get State
function getJobCity(field,oldcode)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else if (window.ActiveXObject)
	  {
	  // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	else
	  {
	  alert("Your browser does not support XMLHTTP!");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		document.getElementById('tdjcity').innerHTML=xmlhttp.responseText;
	  }
	}
	
	statecode=field;
	citycode=oldcode;
	
	url="ajax.php?act=getjcity&statecode="+statecode+"&citycode="+citycode;
	 
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

// get State
function getDet(val,divnm,txtnm)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else if (window.ActiveXObject)
	  {
	  // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	else
	  {
	  alert("Your browser does not support XMLHTTP!");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		if(xmlhttp.responseText == "1")
		{	
			document.getElementById(divnm).style.display="";
		}
		else
		{
			document.getElementById(divnm).style.display="none";
			document.getElementById(txtnm).value="";
		}
	  }
	}
	
	url="ajax.php?act=getedudet&val="+val;
	 
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

function checkUserExistenceinDB(fname,mname,lname,native,gotra,dob,email,mobile_home)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else if (window.ActiveXObject)
	  {
	  // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	else
	  {
	  alert("Your browser does not support XMLHTTP!");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		alert(xmlhttp.responseText);
		if(xmlhttp.responseText == "false")
		{	
			alert("USer already exists. Please contact Administrator of http://medk.org at bharatshah@raviplastic.com");
			document.getElementById("Form No.").focus();
			return false;
		}
		else
		{
			document.forms[0].submit();
		}
	  }
	}
	
	url="ajax.php?act=chkuserexistence&fname="+fname+"&mname="+mname+"&lname="+lname+"&native="+native+"&gotra="+gotra+"&dob="+dob+"&email="+email+"&mobile_home="+mobile_home;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
	
	return true;
}