<?php
class Engine_Misc {

	public static function getFromRequest($name) {
		
		$result = false;
		if (isset($_REQUEST[$name])) {
			$result = htmlspecialchars_decode( trim($_REQUEST[$name]) );
		}
		
		return $result;
	}
	
	public static function getFromRequest_formFields($formFields) {
		
		foreach ($formFields as $name => $value) {
			if (isset($_REQUEST[$name])) {
				$formFields[$name] = htmlspecialchars_decode( trim($_REQUEST[$name]) );
			}
		}
		
		return $formFields;
	}

	public static function fill_formFields($formFields, $values) {
		
		foreach ($formFields as $name => $value) {
			if (isset($values[$name])) {
				$formFields[$name] = $values[$name];
			} else {
				return false;
			}
		}
		
		return $formFields;
	}
	
}