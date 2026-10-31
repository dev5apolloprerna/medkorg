<?php

/*
	Class: CQueryGen
	Purpose:	generate queries so that we do not have to write the sql statements
*/

class CQueryGen {

	//variable declaration
	private $oTableFieldName;
	private $oTableFieldType;
	private $oTableFieldValue;
	private $oWhereFieldName;
	private $oWhereFieldType;
	private $oWhereFieldValue;
	private $m_TableName;
	
	function __construct()
	{
		//write the initialization code here
		 $this->oTableFieldName = array();
		 $this->oTableFieldType = array();
		 $this->oTableFieldValue = array();
		 $this->oWhereFieldName = array();
		 $this->oWhereFieldType = array();
		 $this->oWhereFieldValue = array();
	}

	function __destruct()
	{
		//write the uninitialization code here
		unset($this->oTableFieldName);
		unset($this->oTableFieldType);
		unset($this->oTableFieldValue);
		unset($this->oWhereFieldName);
		unset($this->oWhereFieldType);
		unset($this->oWhereFieldValue);
	}
	
	//set the name of the table
	function setTableName($tblname)
	{
		$this->m_TableName = $tblname;
	}
	
	//add the fields for which the operation is to be done
	function addFieldValue($fldName, $fldValue, $fldType)
	{
		$this->oTableFieldName[] = $fldName;
		$this->oTableFieldValue[] = $fldValue;
		$this->oTableFieldType[] = $fldType;
	}

	//add the condition fields for which the operation is to be done
	function addConditionFieldValue($fldName, $fldValue, $fldType)
	{
		$this->oWhereFieldName[] = $fldName;
		$this->oWhereFieldValue[] = $fldValue;
		$this->oWhereFieldType[] = $fldType;
	}


	function getInsert()
	{
		$i=0;
		$strFields = "";
		$strValues = "";
		$strSQL = "";

		if (count($this->oTableFieldName)>0)
		{
			for($i=0;$i<count($this->oTableFieldName);$i++)
			{
				if ($strFields != "") $strFields .= ",";
				if ($strValues!="") $strValues .= ",";

				$strFields = $strFields . $this->oTableFieldName[$i];

				if ($this->oTableFieldType[$i] == "C")
				{
 					$strValues = $strValues . "'" . $this->oTableFieldValue[$i] . "'";
				}
				else if($this->oTableFieldType[$i] == "D")
				{
					$strValues = $strValues . "'" . $this->oTableFieldValue[$i] . "'";
				}
				else
				{
					$strValues = $strValues . $this->oTableFieldValue[$i];
				}
			}
			$strSQL = "insert into " . $this->m_TableName . "(" . $strFields . ") values(" . $strValues . ")";
		}
		
		return $strSQL;
	 }


	 //function to generate update statement
	function getUpdate()
	{
	//echo '<pre>'	;
		$i = 0;
		$strTemp = "";
		$strSQL = "";
//print_r($this->oTableFieldName);		
//print_r($this->oTableFieldValue);
		if (count($this->oTableFieldName)>0)
		{
			for($i=0;$i<count($this->oTableFieldName);$i++)
			{
				if ($strTemp != "") $strTemp .= ",";

				if ($this->oTableFieldType[$i] == "C")
				{
 					$strTemp = $strTemp . $this->oTableFieldName[$i] . "='" . $this->oTableFieldValue[$i] . "'";
				}
				else if($this->oTableFieldType[$i] == "D")
				{
					$strTemp = $strTemp . $this->oTableFieldName[$i] . "='" . $this->oTableFieldValue[$i] . "'";
				}
				else
				{
					$strTemp = $strTemp . $this->oTableFieldName[$i] . "=" . $this->oTableFieldValue[$i];
				}

			}//end for
		}//end if

		$strSQL = "UPDATE " . $this->m_TableName . " SET " . $strTemp;

		$strTemp = "";
		if(count($this->oWhereFieldName)>0)
		{
			for($i=0;$i<count($this->oWhereFieldName);$i++)
			{
				if ($strTemp != "") $strTemp .= " and ";

				if ($this->oWhereFieldType[$i] == "C")
				{
 					$strTemp = $strTemp . $this->oWhereFieldName[$i] . "='" . $this->oWhereFieldValue[$i] . "'";
				}
				else if($this->oWhereFieldType[$i] == "D")
				{
					$strTemp = $strTemp . $this->oWhereFieldName[$i] . "='" . $this->oWhereFieldValue[$i] . "'";
				}
				else
				{
					$strTemp = $strTemp . $this->oWhereFieldName[$i] . "=" . $this->oWhereFieldValue[$i];
				}
			}
			
			$strSQL .= " Where " . $strTemp;

		}//end if
//echo $strSQL;
//exit;
		return $strSQL;
	}//end of function getUpdate


	function getDelete()
	{
		$strTemp = "";
		$strSQL = "";

		if(count($this->oWhereFieldName)>0)
		{
			for($i=0;$i<count($this->oWhereFieldName);$i++)
			{
				if ($strTemp != "") $strTemp .= " and ";

				if ($this->oWhereFieldType[$i] == "C")
				{
 					$strTemp = $strTemp . $this->oWhereFieldName[$i] . "='" . $this->oWhereFieldValue[$i] . "'";
				}
				else if($this->oWhereFieldType[$i] == "D")
				{
					$strTemp = $strTemp . $this->oWhereFieldName[$i] . "='" . $this->oWhereFieldValue[$i] . "'";
				}
				else
				{
					$strTemp = $strTemp . $this->oWhereFieldName[$i] . "=" . $this->oWhereFieldValue[$i];
				}
			}
			
			$strSQL .= "delete from " . $this->m_TableName . " where " . $strTemp;
		}//end if for where condition

		return $strSQL;
	}//end of function getDelete

}
?>