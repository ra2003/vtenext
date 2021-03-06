<?php
/*+*************************************************************************************
 * The contents of this file are subject to the VTECRM License Agreement
 * ("licenza.txt"); You may not use this file except in compliance with the License
 * The Original Code is: VTECRM
 * The Initial Developer of the Original Code is VTECRM LTD.
 * Portions created by VTECRM LTD are Copyright (C) VTECRM LTD.
 * All Rights Reserved.
 ***************************************************************************************/
/* crmv@112297 */

class PMActionDeleteConditionals extends SDKExtendableClass {
	
	function edit(&$smarty,$id,$elementid,$retrieve,$action_type,$action_id='') {
		// do the same of the class Delete
		$PMUtils = ProcessMakerUtils::getInstance();
		$actionType = $PMUtils->getActionTypes('Delete');
		require_once($actionType['php_file']);
		$action = new $actionType['class']();
		$action->edit($smarty,$id,$elementid,$retrieve,$action_type,$action_id);
	}
	
	function execute($engine,$actionid) {
		$action = $engine->vte_metadata['actions'][$actionid];
		list($metaid,$module) = explode(':',$action['record_involved']);
		$record = $engine->getCrmid($metaid);
		if ($record !== false) {
			$engine->log("Action {$action['action_type']}","action $actionid - {$action['action_title']}");
			
			global $adb, $table_prefix;
			$adb->pquery("delete from {$table_prefix}_processmaker_conditionals where running_process = ? and crmid = ?", array($engine->running_process,$record));
			
			//crmv@112539
			$engine->logElement($engine->elementid, array(
				'action_type'=>$action['action_type'],
				'action_title'=>$action['action_title'],
				'metaid'=>$metaid,
				'crmid'=>$record,
				'module'=>$module,
			));
			//crmv@112539e
		}
	}
}