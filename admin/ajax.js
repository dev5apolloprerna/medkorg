// get State
function getState(field,statecode)
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
	statecode=statecode;
	url="ajax.php?act=getstate&countrycode="+countrycode+"&statecode="+statecode;
	 
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

// get State
function getCity(field,citycode)
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
	citycode=citycode;
	url="ajax.php?act=getcity&statecode="+statecode+"&citycode="+citycode;
	 
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);

}

// get City
function getSubCat(field,subcode,cmbnm,divnm)
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
url="ajax.php?act=getsubcat&catcode="+catCode+"&subcode="+subcode+"&cmbnm="+cmbnm;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);

} 