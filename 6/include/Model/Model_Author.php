<?
class Model_Author {
	private static $table = 'author';
	
	public static function getItems($options=array()) {
		$t = Config::get_table(self::$table);

		$where = (!empty($options['where'])) ? "WHERE {$options['where']}" : '';
		
		$query = "SELECT * 
			FROM `{$t}`
			{$where}
			ORDER BY `name`";
		$items = Engine_DB::query($query, 'items');


		return $items;
	}

	public static function getItem($id) {
		$t = Config::get_table(self::$table);
		
		$id = intval($id);
		
		$query = "SELECT * FROM `{$t}` WHERE id={$id}";
		$item = Engine_DB::query($query, 'item');

		return $item;
	}

	public static function save($data, $id=0) {
		$t = Config::get_table(self::$table);

		$id = intval($id);
		$fieldsAndValues = Engine_DB::get_fieldsAndValues($data);
		
		if ($id) {

			$query = "UPDATE `{$t}` SET {$fieldsAndValues} WHERE `id`={$id}";
			Engine_DB::query($query);
		} else {

			$query = "INSERT INTO `{$t}` SET {$fieldsAndValues}";
			Engine_DB::query($query);
			return Engine_DB::get_insertId();
		}
	}
	public static function remove($id) {
		$t = Config::get_table(self::$table);
		
		$id = intval($id);
		
		$query = "DELETE FROM `{$t}` WHERE id={$id}";
		Engine_DB::query($query);
	}
	
}