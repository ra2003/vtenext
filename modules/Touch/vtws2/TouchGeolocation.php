<?php
/* crmv@59610 */

require_once('include/utils/GeolocationUtils.php');

class TouchGeolocation extends TouchWSClass {

	function process(&$request) {
		global $touchInst, $touchCache;
		
		$subaction = $request['subaction'];

		if ($subaction == 'record') {
			$r = $this->recordPosition($request);
		} else {
			return $this->error('Wrong subaction specified');
		}

		
		return $r;
	}
	
	function recordPosition(&$request) {
		global $current_user;
				
		$coords = Zend_Json::decode($request['coords']);
		if (empty($coords)) return $this->error('Invalid geolocation data provided');
		
		$lat = $coords['latitude'];
		$lon = $coords['longitude'];
		$ts = date('Y-m-d H:i:s', $coords['timestamp'] ?: time());
		
		$data = $coords;
		unset($data['latitude'], $data['longitude'], $data['timestamp']);
		
		$geo = GeolocationUtils::getInstance();
		$geo->updateUserLocation($current_user->id, $lat, $lon, $ts, $data);
		
		return $this->success();
	}

}

 
