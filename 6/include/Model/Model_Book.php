<?
class Model_Book {

	private static $table = 'book';
	
	public static function getItems($options=array()) {
		$tb = Config::get_table(self::$table);
		$ta = Config::get_table('author');
		$tba = Config::get_table('book_nm_author');
		
		$where = (!empty($options['where'])) ? "WHERE {$options['where']}" : '';

		if (!empty($options['authors'])) {
			if (count( $options['authors'] ) == 1) {
				$where = "WHERE tb.id IN (SELECT `id_book` FROM `{$tba}` WHERE `id_author`={$options['authors'][0]})";
			} else {
				$in = implode(', ', $options['authors']);
				$count = count( $options['authors'] );
				$where = "WHERE tb.id IN (SELECT `id_book` FROM `{$tba}` WHERE `id_author` IN ({$in}) GROUP BY `id_book` HAVING COUNT(*)={$count})";
			}
			//print_r($options['authors']);
		}
		
		$query = "SELECT tb.*, ta.id AS author_id, ta.name AS author_name
			FROM `{$tb}` AS tb
			LEFT JOIN `{$tba}` AS tba
				ON tba.id_book = tb.id
			LEFT JOIN `{$ta}` AS ta
				ON tba.id_author = ta.id
			{$where}
			ORDER BY tb.title";
		//echo $query; //exit;
		$result = Engine_DB::query($query);
		
		$items = array();
		
		while ($item = $result->fetch_assoc()) {
			$id = $item['id'];
			
			if (!isset( $items[$id] )) {
				$items[$id] = array(
					'id' => $item['id'],
					'title' => $item['title'],
					'authors' => array(),
				);
			}
			
			if ($author_id = $item['author_id']) {
				$items[$id]['authors'][ $author_id ] = array(
					'id' => $author_id,
					'name' => $item['author_name'],
				);
			}
			
		} //
		
		//print_r($items); exit;

		return $items;
	} // function

	public static function getItem($id) {
		$res = self::getItems(array('where' => "tb.id = {$id}"));
		$item = current($res);
		/*
		$t = Config::get_table(self::$table);
		
		$id = intval($id);
		
		//$query = "SELECT * FROM `{$t}` WHERE id={$id}";
		$query = "SELECT * FROM `{$t}` WHERE id={$id}";
		$item = Engine_DB::query($query, 'item');
		*/

		return $item;
	} // function

	public static function save($data, $id=0) {
		$t = Config::get_table(self::$table);
		$tba = Config::get_table('book_nm_author');

		$authors = $data['authors'];
		unset( $data['authors'] );
		
		$id = intval($id);
		$fieldsAndValues = Engine_DB::get_fieldsAndValues($data);
		$itemsAuthor = array();
		
		if ($id) {
			// update
			$query = "UPDATE `{$t}` SET {$fieldsAndValues} WHERE `id`={$id}";
			Engine_DB::query($query);
			
			$query = "SELECT `id_author` FROM `{$tba}` WHERE `id_book`={$id}";
			$res = Engine_DB::query($query);
			while ($item = $res->fetch_assoc()) {
				$itemsAuthor[] = $item['id_author'];
			}
		} else {
			// insert
			$query = "INSERT INTO `{$t}` SET {$fieldsAndValues}";
			Engine_DB::query($query);
			$id = Engine_DB::get_insertId();
		}

		// authors
		$arrRemove = array_diff($itemsAuthor, $authors);
		if ($arrRemove) {
			// Лишнее удалим
			$strIdRemove = implode(', ', $arrRemove);
			$query = "DELETE FROM `{$tba}` WHERE (`id_book`={$id}) AND (`id_author` IN ({$strIdRemove}))";
			Engine_DB::query($query);
		}
		$arrInsert = array_diff($authors, $itemsAuthor);
		foreach ($arrInsert as $item) {
			// Добавим новые
			$query = "INSERT INTO `{$tba}` SET `id_book`={$id}, `id_author`={$item}";
			Engine_DB::query($query);
		}
		
		//print_r($arrRemove);
		//print_r($arrInsert);
		
		return $id;
	} // function

	public static function remove($id) {
		$t = Config::get_table(self::$table);
		
		$id = intval($id);
		
		$query = "DELETE FROM `{$t}` WHERE id={$id}";
		Engine_DB::query($query);
	} // function
	
} // class