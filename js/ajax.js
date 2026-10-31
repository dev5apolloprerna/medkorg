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


// getState function to fetch states
function getState(field, oldcode) {
    var xmlhttp;
    
    // Create the XMLHttpRequest object
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();  // Modern browsers
    } else if (window.ActiveXObject) {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); // Older IE versions
    } else {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    // Set up the callback function
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var targetElement = document.getElementById('tdstate');
            if (targetElement) {
                targetElement.innerHTML = "";  // Clear existing content
                
                // Create a new div for the state select options
                var newSelect = document.createElement('div');
                newSelect.innerHTML = xmlhttp.responseText.trim();
                targetElement.appendChild(newSelect.firstChild);  // Append the first child from the new HTML
            }

            // Reinitialize Select2
            // if (typeof $ !== "undefined" && $('.select2').length) {
            //     $('.select2').select2({
            //         width: '100%'  // Set Select2 to 100% width
            //     });
            // }
        }
    };

    // Define the parameters for the request
    var countrycode = field;
    var statecode = oldcode;
    var url = "ajax.php?act=getstate&countrycode=" + countrycode + "&statecode=" + statecode;

    // Send the GET request
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
}

// getCity function to fetch cities
function getCity(field, oldcode) {
    var xmlhttp;
    
    // Create the XMLHttpRequest object
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();  // Modern browsers
    } else if (window.ActiveXObject) {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); // Older IE versions
    } else {
        alert("Your browser does not support XMLHTTP!");
        return;
    }

    // Set up the callback function
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var targetElement = document.getElementById('tdcity');
            if (targetElement) {
                targetElement.innerHTML = "";  // Clear existing content
                
                // Create a new div for the city select options
                var newSelect = document.createElement('div');
                newSelect.innerHTML = xmlhttp.responseText.trim();
                targetElement.appendChild(newSelect.firstChild);  // Append the first child from the new HTML
            }

            // Reinitialize Select2
            // if (typeof $ !== "undefined" && $('.select2').length) {
            //     $('.select2').select2({
            //         width: '100%'  // Set Select2 to 100% width
            //     });
            // }
        }
    };

    // Define the parameters for the request
    var statecode = field;
    var citycode = oldcode;
    var url = "ajax.php?act=getcity&statecode=" + statecode + "&citycode=" + citycode;

    // Send the GET request
    xmlhttp.open("GET", url, true);
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
		if(xmlhttp.responseText == "false")
		{	
			alert("User already exists. Please contact Administrator of http://medk.org at bharatshah@raviplastic.com");
			document.getElementById("First Name ").focus();
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