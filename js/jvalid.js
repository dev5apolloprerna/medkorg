function doEdit()
{
	 
		document.frm.txtMode.value="E";
		document.frm.submit();
	 
}
 
function doDelete(DCode)
{
 
	var blnConfirm = confirm("Do you want to delete?");
	if (blnConfirm)
	{
		document.frm.txtMode.value="D";
		document.frm.txtDCode.value=DCode;
		document.frm.submit();
	}
	else
	{
		document.frm.txtMode.value="X";
	}
}
function doPage(code)
{
	frmproductlist.txtpage.value=code;
	frmproductlist.submit();
}
 