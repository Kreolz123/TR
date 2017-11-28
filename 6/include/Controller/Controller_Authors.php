<?
class Controller_Authors {
	
	public static function run() {
		
		Engine::set_dft('title', 'Авторы');
		
		if (!isset($_REQUEST['oper'])) {
			// Список
			$dft['items'] = Model_Author::getItems();
			Engine::set_dft('content', Engine::renderView('Authors', $dft));
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
						Model_Author::remove($id);
						Engine::redirect('?page=authors');
					}
					break;
				default:
					Engine::set_flagShow404();
			}
		}
		
	}
	
	private static function add() {
		$href_edit = '?page=authors&oper=edit&id=';
		
		$msg = array();
		$formFields = self::formFields_getDefaults();

		if (isset($_REQUEST['submit'])) {

			$formFields = Engine_Misc::getFromRequest_formFields($formFields);

			$res = self::validate($formFields);

			if ($res['error']) {
				$msg = $res['errorMsg'];
			} else {

				$id = Model_Author::save($formFields);

				$href_edit .= $id;
				Engine::redirect($href_edit);
			}
		}
		
		$dft['id'] = 0;
		$dft['formFields'] = $formFields;
		$dft['msg'] = $msg;

		
		Engine::set_dft('content', Engine::renderView('Authors_Form', $dft));
	}

	private static function edit($id) {
		$msg = array();
		$formFields = self::formFields_getDefaults();
		

		$item = Model_Author::getItem($id);
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

				Model_Author::save($formFields, $id);

				$item = Model_Author::getItem($id);
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

		
		Engine::set_dft('content', Engine::renderView('Authors_Form', $dft));
	}
	
	private static function formFields_getDefaults() {
		$formFields = array(
			'name' => '',
			);
			
		return $formFields;
	}
	
	private static function validate($formFields) {
		$result = array(
			'error' => false,
			'errorMsg' => array(),
			);
		
		if (!strlen( $formFields['name'] )) {
			$result['errorMsg'][] = 'Не заполнено поле "ФИО автора"';
		}
		
		if ($result['errorMsg']) {
			$result['error'] = true;
		}
		
		return $result;
	}

}