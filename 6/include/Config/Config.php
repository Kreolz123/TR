<?
class Config {
	
	private static $tables = array();
	
	public static function get($name) {
		
		switch ($name) {
			
			case 'tables':
				if (!self::$tables) {
					$arr = array(
						'book',
						'author',
						'book_nm_author',
						);
					self::$tables = array_combine($arr, $arr);
					$config_db = Config_Host::get('db');
					if (strlen($config_db['tablePrefix'])) {
						foreach (self::$tables as $key => $value) {
							self::$tables[$key] = $config_db['tablePrefix'] . $value;
						}
					}
				}
				$res = self::$tables;
				break;
				
			default:
				throw new Exception($name);
				
		}
		
		return $res;
	}
	
	public static function get_table($name) {
		$tables = self::get('tables');
		if (isset($tables[$name])) {
			return $tables[$name];
		} else {
			throw new Exception($name);
		}
	}
	
}
