<?php
//crmv@195073
namespace VteSyncLib\Connector\HubSpot\Model;

class Account extends GenericHSRecord {

	protected static $staticModule = 'Accounts';
	
	protected static $fieldMap = array(
		// HS => CommonRecord
		'name' => 'name',
		'phone' => 'phone',
		'industry' => 'industry',		
		'type' => 'accounttype',
		'city' => 'billingcity',
		'zip' => 'billingpostalcode',
		'annualrevenue' => 'annualrevenue',
		'numberofemployees' => 'employees',
		'description' => 'description',
	);

	public static function extractId($data) {
		return $data['properties']['hs_object_id']['value'];
	}
	
	public static function extractOwner($data) {
		return $data['properties']['hubspot_owner_id']['value'];
	}

	public static function extractCreatedTime($data) {
		$cDate = $data['properties']['createdate']['value'];
		$creationTime = new \DateTime();
		$creationTime->format('U = Y-m-d H:i:s.u');
		$creationTime->setTimestamp($cDate/1000);
		return $creationTime;
	}
	
	public static function extractModifiedTime($data) {
		$date_data = $data['properties']['hs_lastmodifieddate']['value'];
		$modTime = new \DateTime();
		$modTime->format('U = Y-m-d H:i:s.u');
		$modTime->setTimestamp($date_data/1000);
		return $modTime;
	}
	
	public static function extractEtag($data) {
		$lastmod = static::extractModifiedTime($data);
		$etag = strval($lastmod->getTimestamp().$lastmod->format('u'));
		return $etag;
	}
	
	public static function fromRawData($data) {
		$id = static::extractId($data);
		$ownerid = static::extractOwner($data);
		$creatTime = static::extractCreatedTime($data);
		$modTime = static::extractModifiedTime($data);
		$etag = static::extractEtag($data);		
		$arr_keys = [];
		foreach ($data['properties'] as $key => $value)
		{
			$arr_keys[$key] = $value['value'];
		}
		$fields = array_intersect_key($arr_keys, static::$fieldMap);	
		$record = new static(static::$staticModule, $id, $etag, $fields);
		$record->owner = $ownerid;
		$record->rawData = $data;
		$record->createdTime = $creatTime;
		$record->modifiedTime = $modTime;
		return $record;
	}
	
}

