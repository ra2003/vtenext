<?php
/***************************************************************************************
 * The contents of this file are subject to the CRMVILLAGE.BIZ VTECRM License Agreement
 * ("licenza.txt"); You may not use this file except in compliance with the License
 * The Original Code is:  CRMVILLAGE.BIZ VTECRM
 * The Initial Developer of the Original Code is CRMVILLAGE.BIZ.
 * Portions created by CRMVILLAGE.BIZ are Copyright (C) CRMVILLAGE.BIZ.
 * All Rights Reserved.
 ***************************************************************************************/
require_once('include/utils/utils.php');
global $adb;
$local_log =& LoggerManager::getLogger('Transitions');
$ajaxaction = $_REQUEST["ajax"];
if($ajaxaction == "true")
{
	$module = $_REQUEST['source_module'];
	$source_roleid = $_REQUEST['source_roleid'];
	$obj = CRMEntity::getInstance('Transitions');
	$obj->Initialize($module,$source_roleid);
	if($_REQUEST['subaction'] == "copy") {
		$destination_roleid = $_REQUEST['destination_roleid'];
		$roleid = $destination_roleid;
		$obj->copy($destination_roleid);
	} else {
		foreach($_REQUEST as $req=>$value) {
			if(strpos($req,'st_ruleid_') !== false) {
				//save rules
				$ruleid = str_replace('st_ruleid_','',$req);
				$query = "update tbl_s_transitions set enable = ? where ruleid = ?";
				$params = Array($value,$ruleid);
				$adb->pquery($query,$params);				
			} 
		}
		$roleid = $source_roleid;
		//set initial_value
		$field_status = $_REQUEST['status_field'];
		$field_status_value = $_REQUEST['status_field_value'];
		$obj->save_initial_status($field_status,$field_status_value);
	}
}
die();
?>