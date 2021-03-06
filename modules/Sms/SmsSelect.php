<?php
/*+********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: crmvillage.biz Open Source
* The Initial Developer of the Original Code is crmvillage.biz* 
* Portions created by crmvillage.biz are Copyright (C) crmvillage.biz*.
* *All Rights Reserved.
********************************************************************************/
require_once('include/database/PearDatabase.php');


global $app_strings,$mod_strings,$current_user,$theme,$adb,$table_prefix;
$image_path = 'themes/'.$theme.'/images/';
$idlist = $_REQUEST['idlist'];
$pmodule=$_REQUEST['return_module'];
$ids=explode(';',$idlist);
$single_record = false;
if(!strpos($idlist,','))
{
	$single_record = true;
}
$smarty = new VteSmarty();

$userid =  $current_user->id;

$querystr = "select fieldid, fieldname, fieldlabel, columnname from ".$table_prefix."_field where tabid=? and uitype=1014";
$res=$adb->pquery($querystr, array(getTabid($pmodule)));
$numrows = $adb->num_rows($res);
$returnvalue = Array();
for($i = 0; $i < $numrows; $i++)
{
	$value = Array();
	$fieldname = $adb->query_result($res,$i,"fieldname");
	$permit = getFieldVisibilityPermission($pmodule, $userid, $fieldname);
	if($permit == '0')
	{
		$temp=$adb->query_result($res,$i,'columnname');
		$columnlists [] = $temp;
		$fieldid=$adb->query_result($res,$i,'fieldid');
		$fieldlabel =$adb->query_result($res,$i,'fieldlabel');
		$value[] = getTranslatedString($fieldlabel);
		$returnvalue [$fieldid]= $value;
	}
}

if($single_record && count($columnlists) > 0)
{
	$count = 0;
	$val_cnt = 0;	
	switch($pmodule)
	{
		case 'Accounts':
			$query = 'select accountname,'.implode(",",$columnlists).' from '.$table_prefix.'_account left join '.$table_prefix.'_accountscf on '.$table_prefix.'_accountscf.accountid = '.$table_prefix.'_account.accountid where '.$table_prefix.'_account.accountid = ?';
			$result=$adb->pquery($query, array($idlist));
		        foreach($columnlists as $columnname)	
			{
				$acc_eval = $adb->query_result($result,0,$columnname);
				$field_value[$count++] = $acc_eval;
				if($acc_eval != "") $val_cnt++;
				
			}
			$entity_name = $adb->query_result($result,0,'accountname');
			break;
		case 'Leads':
			$query = 'select '.$adb->sql_concat(Array('firstname',"' '",'lastname')).' as leadname,'.implode(",",$columnlists).' from '.$table_prefix.'_leaddetails left join '.$table_prefix.'_leadscf on '.$table_prefix.'_leadscf.leadid = '.$table_prefix.'_leaddetails.leadid inner join '.$table_prefix.'_leadaddress on '.$table_prefix.'_leadaddress.leadaddressid = '.$table_prefix.'_leaddetails.leadid where '.$table_prefix.'_leaddetails.leadid = ?';
			$result=$adb->pquery($query, array($idlist));
		        foreach($columnlists as $columnname)	
			{
				$lead_eval = $adb->query_result($result,0,$columnname);
				$field_value[$count++] = $lead_eval;
				if($lead_eval != "") $val_cnt++;
			}
			$entity_name = $adb->query_result($result,0,'leadname');
			break;
		case 'Contacts':
			$query = 'SELECT '.$adb->sql_concat(Array('firstname',"' '",'lastname')).' as contactname,'.implode(",",$columnlists).' FROM '.$table_prefix.'_contactdetails
						LEFT JOIN '.$table_prefix.'_contactscf ON '.$table_prefix.'_contactscf.contactid = '.$table_prefix.'_contactdetails.contactid
						LEFT JOIN '.$table_prefix.'_contactsubdetails ON '.$table_prefix.'_contactsubdetails.contactsubscriptionid = '.$table_prefix.'_contactdetails.contactid
						WHERE '.$table_prefix.'_contactdetails.contactid = ?';
			$result=$adb->pquery($query, array($idlist));
	        foreach($columnlists as $columnname)	
			{
				$con_eval = $adb->query_result($result,0,$columnname);
				$field_value[$count++] = $con_eval;
				if($con_eval != "") $val_cnt++;
			}	
			$entity_name = $adb->query_result($result,0,'contactname');
			break;	
	}	
}
$smarty->assign('PERMIT',$permit);
$smarty->assign('ENTITY_NAME',$entity_name);
$smarty->assign('ONE_RECORD',$single_record);
$smarty->assign('SMSDATA',$field_value);
$smarty->assign('SMSINFO',$returnvalue);
$smarty->assign("MOD", $mod_strings);
$smarty->assign("IDLIST", $idlist);
$smarty->assign("APP", $app_strings);
$smarty->assign("FROM_MODULE", $pmodule);
$smarty->assign("IMAGE_PATH",$image_path);
if($single_record && count($columnlists) > 0 && $val_cnt > 0)
	$smarty->display("SelectSms.tpl");
else if(!$single_record && count($columnlists) > 0)
	$smarty->display("SelectSms.tpl");
else if($single_record && $val_cnt == 0)
	echo "No Sms Ids";	
else
	echo "Sms Ids not permitted";	
?>
