<?
class Controller_Books {
	
	public static function run() {
		
		Engine::set_dft('title', 'Книги');
		
		if (!isset($_REQUEST['oper'])) {

			
			$dft['authors'] = array();
			$options = array();
			$authors = (isset($_REQUEST['authors']) and is_array($_REQUEST['authors'])) ? $_REQUEST['authors'] : array();
			if ($authors) {
				$options = array( 'authors' => $authors );
				$str = implode(', ', $authors);
				$dft['authors'] = Model_Author::getItems(array( 'where' => "id IN ({$str})"));
			}
				
			$dft['items'] = Model_Book::getItems($options);
			$dft['authorItems'] = Model_Author::getItems();
			Engine::set_dft('content', Engine::renderView('Books', $dft));
			
		} else {
			$oper = $_REQUEST['oper'];
			switch ($oper) {
				case 'add':
					self::add();
					break;
				case 'edit':
					$id = (isset($_REQUEST['id'])) ? intval($_REQUEST['id']) : 0;
					if (!$id) {
						Engine::set_flagShow404();
					} else {
						self::edit($id);
					}
					break;
				case 'remove':
					$id = (isset($_REQUEST['id'])) ? intval($_REQUEST['id']) : 0;
					if (!$id) {
						Engine::set_flagShow404();
					} else {
						Model_Book::remove($id);
						Engine::redirect('?page=books');
					}
					break;
				default:
					Engine::set_flagShow404();
			}
		}
		
	}
	
	private static function add() {
		$href_edit = '?page=books&oper=edit&id=';
		
		$msg = array();
		$formFields = self::formFields_getDefaults();
		

		if (isset($_REQUEST['submit'])) {

			$formFields = Engine_Misc::getFromRequest_formFields($formFields);

			$res = self::validate($formFields);

			if ($res['error']) {
				$msg = $res['errorMsg'];
			} else {

				$formFields['authors'] = (isset($_REQUEST['authors']) and is_array($_REQUEST['authors'])) ? $_REQUEST['authors'] : array();
				$id = Model_Book::save($formFields);

				$href_edit .= $id;
				Engine::redirect($href_edit);
			}
		}
		
		$dft['id'] = 0;
		$dft['formFields'] = $formFields;
		$dft['msg'] = $msg;
		$dft['authorItems'] = Model_Author::getItems();
		$dft['authors'] = array();
		
		Engine::set_dft('content', Engine::renderView('Books_Form', $dft));
	}

	private static function edit($id) {
		$msg = array();
		$formFields = self::formFields_getDefaults();
		

		$item = Model_Book::getItem($id);
		if (!$item) {
			Engine::set_flagShow404();
			return;
		}
		

		if (isset($_REQUEST['submit'])) {

			$formFields = Engine_Misc::getFromRequest_formFields($formFields);

			$res = self::validate($formFields);

			if ($res['error']) {
				$msg = $res['errorMsg'];
			} else {

				$formFields['authors'] = (isset($_REQUEST['authors']) and is_array($_REQUEST['authors'])) ? $_REQUEST['authors'] : array();
				Model_Book::save($formFields, $id);

				$item = Model_Book::getItem($id);
					if (!$item) throw new Exception(__LINE__);

				$formFields = Engine_Misc::fill_formFields($formFields, $item);
					if (!$formFields) throw new Exception(__LINE__);
			}
		} else {

			$formFields = Engine_Misc::fill_formFields($formFields, $item);
				if (!$formFields) throw new Exception(__LINE__);
		}
		
		$dft['id'] = $id;
		$dft['formFields'] = $formFields;
		$dft['msg'] = $msg;
		$dft['authorItems'] = Model_Author::getItems();
		$dft['authors'] = $item['authors'];
		
		Engine::set_dft('content', Engine::renderView('Books_Form', $dft));
	}
	
	private static function formFields_getDefaults() {
		$formFields = array(
			'title' => '',

			);
			
		return $formFields;
	}
	
	private static function validate($formFields) {
		$result = array(
			'error' => false,
			'errorMsg' => array(),
			);
		
		if (!strlen( $formFields['title'] )) {
			$result['errorMsg'][] = 'Не заполнено поле "Название книги"';
		}
		
		if ($result['errorMsg']) {
			$result['error'] = true;
		}
		
		return $result;
	}

}