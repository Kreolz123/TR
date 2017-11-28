<?php
class Engine {
	
	private static $flagShow404	= false;
	private static $dft = array('content' => '', 'title' => '');
	
	public static function run() {

		$str = substr(ENGINE_PathFsRoot, strlen($_SERVER["DOCUMENT_ROOT"]) + 1 );
		if (strlen($str)) $str = "/{$str}";
		define('ENGINE_PathBrRoot', $str);

		Engine_DB::set_config( Config_Host::get('db') );
	
		try {
			$page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : '';
			
			switch ($page) {
				case '':
					self::set_dft('content', self::renderView('MainPage'));
					break;
				case 'books':
					Controller_Books::run();
					break;
				case 'authors':
					Controller_Authors::run();
					break;
				default:
					Engine::set_flagShow404();
			} //
		} catch (Exception $e) {
			echo $e->getMessage();
			exit;
		} //
		
		if (self::$flagShow404) {
			self::set_dft('content', self::renderView('404'));
		}
		
		echo self::renderView('Layout', self::$dft);
		
	}

	public static function renderView($view, $dft=null) {
		$result = '';
		
		$file = ENGINE_PathFsInclude . "/View/{$view}.php";
		
		if (is_file($file)) {
			ob_start();
			include $file;
			$result = ob_get_contents();
			ob_end_clean();
		} else {
			throw new Exception("File \"{$file}\" not found");
		}
		
		return $result;
	}

	public static function redirect($url) {
		header("Location: {$url}");
		echo "Переадресация отключена. <a href=\"{$url}\">Cсылка для перехода.</a>";
		exit;
	}
	
	public static function set_dft($key, $value) {
		self::$dft[$key] = $value;
	}
	
	public static function set_flagShow404() {
		self::$flagShow404 = true;
	}
	
}


spl_autoload_register(function ($class) {
	$pos = strpos($class, '_');
	if ($pos === false) {
		$file = ENGINE_PathFsInclude . "/{$class}/{$class}.php";
	} else {	
		$pref = substr($class, 0, $pos);
		$file = ENGINE_PathFsInclude . "/{$pref}/{$class}.php";
	}
	require_once($file);
});
