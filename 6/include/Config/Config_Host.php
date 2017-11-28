<?
class Config_Host {
	
	public static function get($name) {
		switch ($name) {
			case 'db':
				$res = array(
					'host' 			=> 'book',
					'user' 			=> 'root',
					'password' 		=> '',
					'base' 			=> 'books',
					'tablePrefix' 	=> 'books_',
					);
				break;
				
			default:
				throw new Exception($name);
		}
		
		return $res;
	}
	
}
