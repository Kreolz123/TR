<?
class Engine_DB {
	
	private static $config = array();
	private static $mysqli = null;
	
	private static function get_mysqli() {
		if (self::$mysqli) return self::$mysqli;

		$config = self::$config;
		
		$mysqli = new mysqli($config['host'], $config['user'], $config['password'], $config['base']);
		if ($mysqli->connect_errno) {
			throw new Exception($mysqli->connect_error);
		}
		if (!$mysqli->set_charset("utf8")) {
			throw new Exception($mysqli->error);
		}
		self::$mysqli = $mysqli;
		
		return self::$mysqli;
	}

	public static function set_config($config) {
		self::$config = $config;
	}
	
	public static function query($query, $resultType='') {
		$mysqli = self::get_mysqli();
		
		$result = $mysqli->query($query);
		if (!$result) {
			throw new Exception("Error:" . $mysqli->error . "<br>{$query}");
		}
		
		switch ($resultType) {
			
			case '':
				break;
				
			case 'items':
				$items = array();
				while ($item = $result->fetch_assoc()) {
					$items[] = $item;
				}
				$result = $items;
				break;
				
			case 'item':
				$result = $result->fetch_assoc();
				break;
				
			default:
				throw new Exception("resultType: {$resultType}");
				
		}
		
		return $result;
	}

	public static function escapeString($value) {
		$mysqli = self::get_mysqli();
		
		return $mysqli->real_escape_string($value);
	}
	
	public static function get_fieldsAndValues($data) {
		$fieldsAndValues = '';
		foreach ($data as $name => $value) {
			$value = self::escapeString($value);
			$fieldsAndValues .= "`{$name}` = '{$value}', ";
		}
		$fieldsAndValues = substr($fieldsAndValues, 0, -2);
		
		return $fieldsAndValues;
	}

	function get_insertId() {
		$mysqli = self::get_mysqli();
		
		return $mysqli->insert_id;
	}
	
}
