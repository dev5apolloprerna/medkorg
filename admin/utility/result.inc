<?php

/*
	Class: CResultSet
	Purpose:	generate recordsets which will represent the query sets and pages
	Usage: 

	$o = new CResultSet();
	$o->setConnection($con);
	$o->setSQLBase("select * from country_m");
	$o->setOrderClause(" country_name_vc");
	$o->setCurrentPage(1);
	$o->setPageSize(5);
	$o->startPaging();
	$o->addConditionFieldValue("country_code_int", "1", "N" , ">=");
	$o->addConditionFieldValue("country_name_vc", "In", "C" , "Like");
	echo(count($o->getResultset()));
	echo($o->getPages());
	unset($o);
*/
class CResultSet {

	//variable declaration
	private $str_sql_base;
	private $orderclause;
	private $pagesize;
	private $currentpage;
	private $oParamsFieldName;
	private $oParamsFieldType;
	private $oParamsFieldValue;
	private $oParamsFieldOperator;
	private $totalpages; //read only
	private $recordcount;
	private $con;
	private $blnpaging;
	
	function __construct()
	{
		//write the initialization code here
		 $this->oParamsFieldName = array();
		 $this->oParamsFieldType = array();
		 $this->oParamsFieldValue = array();
		 $this->oParamsFieldOperator = array();
		 $this->str_sql_base = "";
		 $this->pagesize = -1;
		 $this->totalpages = -1;
		 $this->recordcount = -1;
		 $this->blnpaging = 0;
	}

	function __destruct()
	{
		//write the uninitialization code here
		unset($this->oParamsFieldName);
		unset($this->oParamsFieldType);
		unset($this->oParamsFieldValue);
		unset($this->oParamsFieldOperator);
	}

	function setConnection($con)
	{
		$this->con = $con;
	}

	//set the name of the table
	function setSQLBase($strSQL)
	{
		$this->str_sql_base = $strSQL;
	}

	function setOrderClause($fieldlist)
	{
		$this->orderclause = $fieldlist;
	}

	function setCurrentPage($varpage)
	{
		$this->currentpage = $varpage;
	}

	function setPageSize($pagesize = 10)
	{
		$this->pagesize = $pagesize;
	}

	function getPages()
	{
		return $this->totalpages;
	}
	
	function getCount()
	{
		return $this->recordcount;
	}

	function startPaging()
	{
		$this->blnpaging = 1;
	}
	
	//add the fields for which the operation is to be done
	function addConditionFieldValue($fldName, $fldValue, $fldType,$fldOperator)
	{
		$this->oParamsFieldName[] = $fldName;
		$this->oParamsFieldValue[] = $fldValue;
		$this->oParamsFieldType[] = $fldType;
		$this->oParamsFieldOperator[] = $fldOperator;
	}

	 //function to generate update statement
	function getResultset()
	{
		$i = 0;
		$strTemp = "";
		$strSQL = "";
		$strWhere = "";
		$rs = null;
		$rscnt = null;

		if(count($this->oParamsFieldName)>0)
		{
			for($i=0;$i<count($this->oParamsFieldName);$i++)
			{
				if ($this->oParamsFieldValue[$i] != "" && $this->oParamsFieldValue[$i] != "0")
				{
					if ($strTemp != "") $strTemp .= " and ";

					if ($this->oParamsFieldType[$i] == "C")
					{
						if ($this->oParamsFieldOperator[$i] == "like")
						{
							$strTemp = $strTemp . $this->oParamsFieldName[$i] . " " . $this->oParamsFieldOperator[$i] . " '" . $this->oParamsFieldValue[$i] . "'";
						}
						else
						{
							$strTemp = $strTemp . $this->oParamsFieldName[$i] . " " . $this->oParamsFieldOperator[$i] . " '" . $this->oParamsFieldValue[$i] . "'";
						}
						
					}
					else if($this->oParamsFieldType[$i] == "D")
					{
						$strTemp = $strTemp . $this->oParamsFieldName[$i] . " " . $this->oParamsFieldOperator[$i] . " '" . $this->oParamsFieldValue[$i] . "'";
					}
					else
					{
						$strTemp = $strTemp . $this->oParamsFieldName[$i] . " " . $this->oParamsFieldOperator[$i] . " " . $this->oParamsFieldValue[$i];
					}
				}//end if for checking if the parameter value is blank or not
			}
			
			if ($strTemp != "")
				$strWhere .= " Where " . $strTemp;

		}//end if
		

		$strSQL = $this->str_sql_base . $strWhere . " order by " . $this->orderclause;
		
		if ($this->blnpaging == 1)
		{
			$strSQL .= " limit " . (($this->currentpage -1) * $this->pagesize) . "," . $this->pagesize;
		}
		
		$rscnt = db_get_all($this->str_sql_base . $strWhere);

		//there is another technique to get the recordcount.  we will implement it later on
		$this->recordcount = count($rscnt);
		
		if ($this->recordcount % $this->pagesize > 0)
			$this->totalpages = floor($this->recordcount/$this->pagesize) + 1;
		else
			$this->totalpages = floor((int)$this->recordcount/$this->pagesize);

		unset($rscnt);
		
		$rs = db_get_all($strSQL);

		return $rs;
	}//end of function getResultset

}
?>