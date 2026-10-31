<?php

	include_once "noentry.php";
	include_once "admin/connection/conn.php";

	// Query for Village data //
	$sql_vill = "select * from village_m order by village_name";
	$chk_vill = mysqli_query($cn,$sql_vill);
	
	// Query for Village gotra //
	$sql_gotra = "select * from gotra_m order by gotra_name";
	$chk_gotra = mysqli_query($cn,$sql_gotra);
	
	// Query for Vasti Patrak Data //
	$where = " and ";
	$cond = "";
	if($_POST)
	{
		if(isset($_POST['pagenum']))
		{
			$where_cnd = stripslashes($_POST['cond']);
		}
		else{
		$where = " and ";
		// Search By Professional Details //
		
		// if(isset($_POST['country']) && $_POST['country']!="" && $_POST['country']!="0")
		// {
		// 	$cond .= $where . "(vasti.country = '".$_POST['country']."' or v1.country = '".$_POST['country']."')";
		// }

		if (isset($_POST['countryType'])) {
			if ($_POST['countryType'] == 'in') {
				$cond .= $where . "(vasti.country = '10' or v1.country = '10')";
			} else {
				if (isset($_POST['country']) && $_POST['country'] != "" && $_POST['country'] != "0") {
					$cond .= $where . "(vasti.country = '" . $_POST['country'] . "' or v1.country = '" . $_POST['country'] . "')";
				}else{
					$cond .= $where . "((vasti.country != '10' or v1.country != '10') and (vasti.country != '' or v1.country != ''))";
				}
			}
		}
		if(isset($_POST['state']) && $_POST['state']!="" && $_POST['state']!="")
		{
			$cond .= $where . "(vasti.state = '".$_POST['state']."' or v1.state = '".$_POST['state']."')";
		}
		if(isset($_POST['city']) && $_POST['city']!="" && $_POST['city']!="0")
		{
			$cond .= $where . "(vasti.city = '".$_POST['city']."' or v1.city = '".$_POST['city']."')";
		}
		
		if(isset($_POST['village_id']))
		{
			$vid = implode(",",$_POST['village_id']);
			if($vid != "")
				$cond .= $where . "(vasti.village_id in (". implode(",",$_POST['village_id']) . ") or v1.village_id in (". implode(",",$_POST['village_id']) . "))";
		}	
		if(isset($_POST['gotra_id']))
		{
			$pid = implode(",",$_POST['gotra_id']);
			if ($pid != "")
				$cond .= $where . "(vasti.gotra_id in (".implode(",",$_POST['gotra_id']) . ") or v1.gotra_id in (".implode(",",$_POST['gotra_id']) . "))";
		}	
		if($_POST['fname_vc']!="")
		{
			$cond .= $where . "vasti.fname_vc like '%".$_POST['fname_vc']."%'";
		}	
		if($_POST['lname_vc']!="")
		{
			$cond .= $where . "vasti.lname_vc like '%".$_POST['lname_vc']."%'";
		}	
		if($_POST['email']!="")
		{
			$cond .= $where . "vasti.email like '%".$_POST['email']."%'";
		}	
		if($_POST['blood_group']!="")
		{
			$cond .= $where . "vasti.blood_group='".$_POST['blood_group']."'";
		}	
		if($_POST['gender_c']!="")
		{
			$cond .= $where . "vasti.gender_c='".$_POST['gender_c']."'";
		}
		if($_POST['marital_id']!="")
		{
			$cond .= $where . "vasti.marital_id='".$_POST['marital_id']."'";
		}
		if($_POST['pincode']!="")
		{
			$cond .= $where . "vasti.pincode='".$_POST['pincode']."'";
		}
		
		if($_POST['age_from']!="0" || $_POST['age_to']!="100")
		{
			if($_POST['age_from']!="")
				$age_from = $_POST['age_from'];
			else
				$age_from = "1";
			
			if($_POST['age_to']!="")
				$age_to = $_POST['age_to'];
			else
				$age_to = "200";
				
			$cond .= $where . "(DATEDIFF(NOW(),vasti.birth_date)/365) between ".$age_from." and ".$age_to;
		}
		
		if($_POST['basic_qual']!="")
		{
			$cond .= $where . "vasti.basic_qual ='".$_POST['basic_qual']."'";
		}
		if($_POST['pg_qual']!="")
		{
			$cond .= $where . "vasti.pg_qual ='".$_POST['pg_qual']."'";
		}
		if($_POST['doc_qual']!="")
		{
			$cond .= $where . "vasti.doc_qual ='".$_POST['doc_qual']."'";
		}
		
		
		// Search By Professional Details //
		
		if($_POST['prof_type']!="")
		{
			$cond .= $where . "bdir.prof_type like '%".$_POST['prof_type']."%'";
		}
		// Business //
		if($_POST['bness_cat_id']!="")
		{
			$cond .= $where . "bdir.bness_cat_id = '".$_POST['bness_cat_id']."'";
		}
		if($_POST['bness_subcat_id']!="")
		{
			$cond .= $where . "bdir.bness_subcat_id = '".$_POST['bness_subcat_id']."'";
		}
		if($_POST['bness_name']!="")
		{
			$cond .= $where . "bdir.bness_name = '".$_POST['bness_name']."'";
		}
		// Profession //
		if($_POST['prof_cat_id']!="")
		{
			$cond .= $where . "bdir.prof_cat_id = '".$_POST['prof_cat_id']."'";
		}
		if($_POST['prof_subcat_id']!="0")
		{
			$cond .= $where . "bdir.prof_subcat_id = '".$_POST['prof_subcat_id']."'";
		}
		// Business //
		if($_POST['job_type']!="")
		{
			$cond .= $where . "bdir.job_type = '".$_POST['job_type']."'";
		}
		if($_POST['job_ind_id']!="")
		{
			$cond .= $where . "bdir.job_ind_id = '".$_POST['job_ind_id']."'";
		}
		if($_POST['comp_name']!="")
		{
			$cond .= $where . "bdir.comp_name = '".$_POST['comp_name']."'";
		}
		
		if($_POST['selSearchType']!='IS')
			$where_cnd = "where vasti.vasti_id not in (select vasti_id from user_directory_records where dir_id='".$_GET['dirid']."') and vasti.lineage=0 and vasti.status in (0,1) and vasti.parent_id=0 ". $cond;
		else
		{
			$where_cnd = "where vasti.vasti_id not in (select vasti_id from user_directory_records where dir_id='".$_GET['dirid']."') and vasti.lineage=0 and vasti.status in (0,1) ". $cond;	
		}	 
	}
		//$where_cnd = $where_cnd . " and lineage=0 ";
		
		if(isset($_POST['selPagesNum']))
			$numpages = $_POST['selPagesNum'];
		else
			$numpages = "100";	
		
		if(isset($_POST['selPagesNum']))
		{
			//  PAGING	//
			$sql_string="select count(*) as totrec
								 from vastipatrak_m vasti
									left outer join vastipatrak_m v1 on vasti.parent_id = v1.vasti_id
									left outer join village_m v on vasti.village_id = v.village_id
									left outer join gotra_m g on vasti.gotra_id = g.gotra_id
									left outer join marital_m m on vasti.marital_id = m.marital_id 
									left outer join businessdir_m bdir on vasti.vasti_id = bdir.vasti_id
									left outer join country_m country on vasti.country = country.country_id
									left outer join state_m state on vasti.state = state.state_id
									left outer join city_m city on vasti.city = city.city_id
										
										$where_cnd ";
						 
			$result=mysqli_query($cn,$sql_string);
			$tmp=mysqli_fetch_assoc($result);
			$totrecord=$tmp['totrec'];
			$num_vastipatrak = $totrecord;
			$recperpage=$numpages;
			
			$maxpage=(int)($totrecord/$recperpage);
		 
			$rem=$totrecord%$recperpage;
			if($rem>0)
				$maxpage++;
			
			$pageNum=1;
			 
			if(isset($_POST['pagenum']))
				$pageNum=$_POST['pagenum'];	
			
			if($pageNum == "" || $pageNum=="undefined")
			{
				$pageNum = 1;
			}
				
			$offset = ($pageNum - 1) * $recperpage;
			$limit="LIMIT $offset,$recperpage";
		}
		else
		{
			//  PAGING	//
			$sql_string="select count(*) as totrec
								 from vastipatrak_m vasti
									left outer join vastipatrak_m v1 on vasti.parent_id = v1.vasti_id
									left outer join village_m v on vasti.village_id = v.village_id
									left outer join gotra_m g on vasti.gotra_id = g.gotra_id
									left outer join marital_m m on vasti.marital_id = m.marital_id 
									left outer join businessdir_m bdir on vasti.vasti_id = bdir.vasti_id
									left outer join country_m country on vasti.country = country.country_id
									left outer join state_m state on vasti.state = state.state_id
									left outer join city_m city on vasti.city = city.city_id
										
										$where_cnd ";
						 
			$result=mysqli_query($cn,$sql_string);
			$tmp=mysqli_fetch_assoc($result);
			$totrecord=$tmp['totrec'];
			$num_vastipatrak = $totrecord;
			
			$limit = "";
		}	
		
		$sql_vastipatrak = "select distinct vasti.*,
								v.village_name,g.gotra_name,m.marital_name,
								v1.gotra_id as pargotra,v1.village_id as parvillage, 
								bdir.prof_type,bness_cat_id,bness_subcat_id,bness_name,prof_cat_id,prof_subcat_id,comp_name, 
								country.country_name,state.state_name,city.city_name
								 
								from vastipatrak_m vasti
									left outer join vastipatrak_m v1 on vasti.parent_id = v1.vasti_id
									left outer join village_m v on vasti.village_id = v.village_id
									left outer join gotra_m g on vasti.gotra_id = g.gotra_id
									left outer join marital_m m on vasti.marital_id = m.marital_id 
									left outer join businessdir_m bdir on vasti.vasti_id = bdir.vasti_id
									left outer join country_m country on vasti.country = country.country_id
									left outer join state_m state on vasti.state = state.state_id
									left outer join city_m city on vasti.city = city.city_id
										
										$where_cnd order by vasti.fname_vc $limit";
										
		$chk_vastipatrak = mysqli_query($cn,$sql_vastipatrak);
		//$num_vastipatrak = mysql_num_rows($chk_vastipatrak);
		
		
		if($_POST['txtMode'] == "A")
		{
			$sql_ins = "insert into user_directory_records (dir_id,vasti_id) values";
			foreach($_POST['chk'] as $v)
			{
				$sql_ins .= "('".$_POST['dirid']."','".$v."'),";
			}
	
			$sql_ins = substr($sql_ins,0,strlen($sql_ins)-1);
			$sql_ins;
			$chk_ins = mysqli_query($cn,$sql_ins);
			
			header("Location: user-directory-records-list.php?dirid=".$_POST['dirid']."&dirnm=".$_POST['dirnm']);
			exit;	
		}
		
		if($_POST['txtMode'] == "AL")
		{
			$sql_ins = "insert into user_directory_records (dir_id,vasti_id) values";
			while($rec_all = mysqli_fetch_array($chk_vastipatrak))
			{
				$sql_ins .= "('".$_POST['dirid']."','".$rec_all['vasti_id']."'),";
			}
	
			$sql_ins = substr($sql_ins,0,strlen($sql_ins)-1);
			$sql_ins;
			$chk_ins = mysqli_query($cn,$sql_ins);
			
			header("Location: user-directory-records-list.php?dirid=".$_POST['dirid']."&dirnm=".$_POST['dirnm']);
			exit;	
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::: Shree Modasa Akeda Dasha Khadayat :::</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 13px}
.style3 {color: #222222}
-->
</style>
<script language="javascript" type="text/javascript">
function checkall(field)
{
	chk=document.frmSearchBox['chk[]'];
	alert(chk);
	
	if(typeof(chk.length)=="undefined")
		chk.checked=field.checked?true:false;
	
	for(i=0;i<chk.length;i++)
	 	chk[i].checked=field.checked?true:false; 
}

function doAction(act,action)
 {
 	var chk=document.frmSearchBox['chk[]'];
	
	var t=0;
	if(act != "AL")
	{
		if(typeof(chk.length)=="undefined")
		{	 
			if(window.confirm('Are you sure to '+action+' the Selected Records?'))
			{
				document.frmSearchBox.txtMode.value=act;
				document.frmSearchBox.submit(); 
				return;
			}	
		}
		for(i=0;i<chk.length;i++)
		{
			chk[i].checked?t++:null;
		}
		if(t==0)
		{
			alert('No Records are Selected');
			return;
		}
		if(window.confirm('Are you sure to '+action+' the Selected Records?'))
		{
			 document.frmSearchBox.txtMode.value=act;
			document.frmSearchBox.submit(); 
		}	
	}
	else
	{
		if(window.confirm('Are you sure to Add All the Records to Directory?'))
		{
			document.frmSearchBox.txtMode.value=act;
			document.frmSearchBox.submit(); 
			return;
		}	
	}	
 }
 
 function doSubmit(pgnum)
 {
 	document.getElementById("pagenum").value = pgnum;
	document.frmSearchBox.submit();
 }
//-->
</script>
<script>
function switchMenu(tag)
{
	 
	var e1 = document.getElementById(tag);
	if (e1.style.display=="none")
		e1.style.display="";
	else
		e1.style.display="none";
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<script type="text/javascript">

/***********************************************
* Disable Text Selection script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

function disableSelection(target){
if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	target.style.MozUserSelect="none"
else //All other route (ie: Opera)
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}

//Sample usages
//disableSelection(document.body) //Disable text selection on entire body
//disableSelection(document.getElementById("mydiv")) //Disable text selection on element with id="mydiv"

</script>

</head>

<body>
<script language=JavaScript>
<!--

//Disable right click script III- By Renigade (renigade@mediaone.net)
//For full source code, visit http://www.dynamicdrive.com

var message="";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}

document.oncontextmenu=new Function("return false")
// --> 
</script>
<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" bgcolor="#ffffff"><table width="1003" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="right" valign="top" background="images/top_bg.jpg" style="background-position:top; background-repeat:no-repeat;"><table width="500" border="0" cellspacing="0" cellpadding="0">

          <tr>
            <td height="99" align="left" valign="top"><a href="index.html"><img src="images/spacer.gif" alt="" width="484" height="99" /></a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="34">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr height="59">
            <td><table width="475" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2"><?php include "advt_incl.php"; ?></td>
                </tr>
              <tr>
                <td height="7"></td>
                <td></td>
              </tr>
            </table></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="41" align="center" valign="middle" background="images/menu_bg.jpg" style="background-repeat:repeat-x">
		<?php include_once "menu.php"; ?></td>
      </tr>
      <tr>
        <td align="center" valign="top"><table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="22" background="images/welcome_top_bg.jpg" style="background-repeat:repeat-x;">&nbsp;</td>
          </tr>
          <tr>
            <td align="center" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" class="border1"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <tr>
                    <td align="left" class="border1">
					<form action="user-dirsearch-result.php?dirid=<?php echo $_GET['dirid']; ?>&dirnm=<?php echo $_GET['dirnm']; ?>" method="post" name="frmSearchBox" id="frmSearchBox">
                     <input type="hidden" name="txtMode">
					 <input type="hidden" name="dirid" value="<?php echo $_GET['dirid']; ?>"> 
					 <input type="hidden" name="dirnm" value="<?php echo $_GET['dirnm']; ?>">
					 <input type="hidden" name="pagenum" id="pagenum" value="<?php echo $pageNum; ?>">
					 <input type="hidden" name="cond" id="cond" value="<?php echo $where_cnd; ?>">
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td colspan="8"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                          <tr bgcolor="#FFFFFF">
                            <td colspan="3">&nbsp;</td>
                            </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="67%" height="30" align="left" valign="middle" bgcolor="#F8F8F8" class="text4_user style1" style="padding-left:3px;"> DIRECTORY SEARCH RESULT </td>
                          <td width="23%" align="right" valign="middle" bgcolor="#F8F8F8" class="text4 style1" style="padding-right:10px;"><?php echo $num_vastipatrak; ?> RECORDS </td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td colspan="7" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="30" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td colspan="7" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="30" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td colspan="3" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="title1">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="2%" align="left" valign="middle" bgcolor="#ffffff" class="text1"><div align="center"><strong>                        </strong></div></td>
                        <td width="3%" align="left" valign="middle" bgcolor="#ffffff" class="text1"><div align="center"><strong>
                          <input type="checkbox" name="chkall" onChange="checkall(this);">
                        </strong></div></td>
                        <td width="9%" align="left" valign="middle" bgcolor="#ffffff" class="text1"><strong>Select All</strong></td>
                        <td width="14%" align="left" valign="middle" bgcolor="#ffffff" class="text1"><div align="right"><!--Records Per Page-->
                          </div>                          <div align="center"></div></td>
                        <td style="padding-left:05px;" width="12%" align="left" valign="middle" bgcolor="#ffffff" class="text1">
							<!--<select name="selPagesNum" onchange="doSubmit(<?php echo $pageNum; ?>);">
								<option value="5" <?php echo ($numpages=="5")?"selected":""; ?>> 5 </option>
								<option value="10" <?php echo ($numpages=="10")?"selected":""; ?>> 10 </option>
								<option value="20" <?php echo ($numpages=="20")?"selected":""; ?>> 20 </option>
								<option value="50" <?php echo ($numpages=="50")?"selected":""; ?>> 50 </option>
								<option value="100" <?php echo ($numpages=="100")?"selected":""; ?> > 100 </option>
								<option value="" <?php echo ($numpages=="")?"selected":""; ?> > All Records </option>
							</select>-->
						</td>
                        <td width="26%" align="left" valign="middle" bgcolor="#ffffff" class="text1">&nbsp;</td>
                        <td width="18%"><span class="title1"><strong><a href="#" class="title1" onclick="javascript:doAction('AL','AddAll');">Import all members to Directory</a></strong></span></td>
                        <td width="16%" class="title1"><strong><a href="#" class="title1" onClick="javascript:doAction('A','Add');">Add selected members to Directory</a></strong></td>
                      </tr>
                      <tr>
                        <td colspan="8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr bgcolor="#f2f2f2">
                             <td bgcolor="#FFFFFF"></td>
                             <td height="15" colspan="5" align="left" valign="middle" bgcolor="#ffffff"></td>
                           </tr>
                           <tr bgcolor="#f2f2f2">
                            <td width="2%" height="30" bgcolor="#FFFFFF">&nbsp;</td>
                            <td width="98%" colspan="5" align="left" valign="middle" bgcolor="#ffffff">
							 <?php 
								$ctr=1;
								while($dt_vastipatrak = mysqli_fetch_array($chk_vastipatrak))
								{
 							 ?>
							  <table width="98%"  border="0" cellspacing="0" bgcolor="#fbfbfb">
                                <tr>
                                  <td width="3%" class="text4_user"><div align="center"><input type="checkbox" name="chk[]" value="<?php echo $dt_vastipatrak['vasti_id']; ?>"></div></td>
                                  <td width="33%" class="text4_user"><?php echo $dt_vastipatrak['fname_vc'] . " " . $dt_vastipatrak['mname_vc'] . " " . $dt_vastipatrak['lname_vc']; ?></td>
                                  <td width="33%" rowspan="4" class="text_user"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                      <?php if($dt_vastipatrak['addr1']!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $dt_vastipatrak['addr1']; ?> </td>
                                      </tr>
                                      <?php } ?>
                                      <?php if($dt_vastipatrak['addr2']!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $dt_vastipatrak['addr2']; ?></td>
                                      </tr>
                                      <?php } ?>
                                      <?php if($dt_vastipatrak['addr3']!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $dt_vastipatrak['addr3']; ?></td>
                                      </tr>
                                      <?php } ?>
                                      <?php if($dt_vastipatrak['city']!="" || $dt_vastipatrak['state']!="" || $dt_vastipatrak['pincode']!=""){ ?>
                                      <tr bgcolor="#fbfbfb" class="text">
                                        <td class="text_user"><?php echo $dt_vastipatrak['city_name']; ?>, <?php echo $dt_vastipatrak['state_name']; ?> - <?php echo $dt_vastipatrak['pincode']; ?>.</td>
                                      </tr>
                                      <?php } ?>
                                  </table></td>
                                  <td width="33%" rowspan="8" valign="top" style="padding-top:20px;"><table width="60%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="#" class="title1" onClick="javascript:doAction('A','Add');">Add  Record to Directory </a></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="user-full-profile.php?VId=<?php echo $dt_vastipatrak['vasti_id']; ?>" target="_blank">View Profile </a></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><a href="user-familytree.php?id=<?php echo $dt_vastipatrak['vasti_id'];?>" target="_blank">View Family Tree </a></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                      <tr>
                                        <td height="25" class="text_user" style="padding-left:3px;"><b>Last Updated On: <?php echo date('d-m-Y',strtotime($dt_vastipatrak['reg_date'])); ?> </b></td>
                                      </tr>
                                      <tr>
                                        <td height="1" bgcolor="#ac2615"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><?php echo $dt_vastipatrak['gender_c']; ?>, <?php echo (date('Y') - date('Y', strtotime($dt_vastipatrak['birth_date'])) ." yrs"); ?> </td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><?php echo $dt_vastipatrak['city_name']; ?>.</td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><?php echo $dt_vastipatrak['marital_name']; ?></td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user">&nbsp;</td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><span class="text4_user"><strong>M</strong>.</span> <?php 
										$extr = "";
										
										if($dt_vastipatrak['mobile_home']!="" || $dt_vastipatrak['alt_mobile']!="")
										{
											if($dt_vastipatrak['mobile_home']!="")
											{
												$mobno = $dt_vastipatrak['mobile_home'];
												$extr = " / ";
											}
											if($dt_vastipatrak['alt_mobile']!="") 
												$mobno .= $extr . $dt_vastipatrak['alt_mobile'];	
										}
										else
											$mobno = "-";
										
										echo $mobno; 
									?></td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><span class="text4_user">Native</span>: <?php echo $dt_vastipatrak['village_name']; ?></td>
                                  <td class="text_user"><span class="text4_user">Ph.</span> <?php 
										$extr = "";
										
										if($dt_vastipatrak['phone_number']!="" || $dt_vastipatrak['alt_number']!="")
										{
											if($dt_vastipatrak['phone_number']!="")
											{
												if($dt_vastipatrak['code_phone_number'] != "")
													$mobno1 = $dt_vastipatrak['code_phone_number'] . "-" . $dt_vastipatrak['phone_number'];
												else
													$mobno1 = $dt_vastipatrak['phone_number'];
												
												$extr = " / ";
											}
											if($dt_vastipatrak['alt_number']!="")
											{ 
												if($dt_vastipatrak['code_alt_number']!="")
													$mobno1 .= $extr . $dt_vastipatrak['code_alt_number'] . "-" . $dt_vastipatrak['alt_number'];	
												else
													$mobno1 .= $extr . $dt_vastipatrak['alt_number'];	
											}
										}
										else
											$mobno1 = "-";
										
										echo $mobno1; 
									?></td>
                                </tr>
                                <tr class="text">
                                  <td class="text_user">&nbsp;</td>
                                  <td class="text_user"><span class="text4_user">Gotra</span>: <?php echo $dt_vastipatrak['gotra_name']; ?></td>
                                  <td class="text_user"><span class="text4_user"><strong>Email</strong></span>: 
								  	<?php if($dt_vastipatrak['email']!=""){ ?>
										<a href="mailto:<?php echo $dt_vastipatrak['email']; ?>"><?php echo $dt_vastipatrak['email']; ?></a>
									<?php }else{ echo "-"; } ?>
								  </td>
                                </tr>
                                <tr class="text">
                                  <td height="8" colspan="4" class="text_user"></td>
                                </tr>
                                <tr class="text" >
                                  <td colspan="4" class="text_user" background="images/line_user_list.jpg" style="background-repeat:repeat-x;"><img src="images/line_user_list.jpg" width="25" height="3" /></td>
                                </tr>
								<tr bgcolor="#f2f2f2">
								  <td bgcolor="#FFFFFF">&nbsp;</td>
								  <td height="30" bgcolor="#FFFFFF">&nbsp;</td>
								  <td align="left" colspan="2" valign="middle" bgcolor="#ffffff">&nbsp;</td>
								</tr>
                              </table>
							  <?php } ?>
							</td>
                          </tr>
						  
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="8"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="right" valign="top" class="text4_user">
                              <?php if($maxpage>1) { ?>
                              <div class="next">
                                <?php if($pageNum!=1) { ?>
                                <a href="#" onclick="doSubmit(<?php echo $pageNum-1; ?>,'');">
                                <?php } ?>
                                <font color="#000000" class="text4_user"><b>&lt;&lt;</b></font> Prev...                                <?php if($pageNum!=1) { ?>
                                </a>
                                <?php } ?>
                                <?php for($i=1;$i<=$maxpage;$i++) { ?>
                                <a href="#" onclick="doSubmit(<?php echo $i; ?>,'');" class="text1" style="text-decoration:none;"><?php echo $i;?></a> |
                                <?php } ?>
                                <?php if($pageNum!=$maxpage) { ?>
                                <a href="#" onclick="doSubmit(<?php echo $pageNum+1; ?>,'');">
                                <?php }?>
                                      ....Next <font color="#000000" class="text4_user"><b>&gt;&gt;</b></font>
                                <?php if($pageNum!=$maxpage) { ?>
                                </a>
                                <?php } ?>
                              </div>
                              <?php } ?></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
					</form>
					</td>
                  </tr>
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="38" align="center" valign="middle" bgcolor="#834153"><table width="96%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="20" align="center" valign="middle" class="footer">All Rights Reserved. Shree Modasa Ekda Dasha Khadayata Vastiptrak Samiti<span class="style2"></span></td>
            </tr>
            <tr>
              <td height="20" align="center" valign="middle" class="footer">Website Design By:<a href="https://apolloinfotech.com/" target="_blank"> Apollo Infotech</a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<script>
	function showadvert()
	{
		var obj = document.getElementById("advtid");
		obj.style.display="block";
	}

	window.onload=showadvert;
</script>
<script type="text/javascript">
disableSelection(document.body) //disable text selection on entire body of page
</script><script type="text/javascript">
var somediv=document.getElementById("mydiv")
disableSelection(somediv) //disable text selection within DIV with id="mydiv"
</script><script type="text/javascript">
var alltables=document.getElementsByTagName("table")
for (var i=0; i<alltables.length; i++)
disableSelection(alltables[i]) //disable text selection within all tables on the page
</script>

</body>


</html>
