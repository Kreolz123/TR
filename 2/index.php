<?
class MainClass {
	
	public static function run() {
		
		$resStr = file_get_contents('http://redlg.ru/projects.json');
		$resArr = json_decode($resStr, true);
		
		$content = '';
		
		if (!$resArr) {
			$content = "Error: #{$resStr}#";
		} else {
			
			$search = '';
			
			if (!isset($_REQUEST['search']) or !strlen($_REQUEST['search'])) {
				$items = $resArr['items'];
			} else {
				$search = $_REQUEST['search'];
				
				foreach ($resArr['items'] as $key => $item) {
					$items[$key] = array();
					foreach ($item as $item2) {
						if ((strpos($item2['name'], $search) !== false) or 
							(strpos($item2['phone'], $search) !== false)) {
							$items[$key][] = $item2;
						}
					}
				}

			}
			

	
		}
		
		if (empty( $_REQUEST['ajax'] )) {
			require 'main.php';
		} else {
			echo $content;
		}
	}

}

MainClass::run();
