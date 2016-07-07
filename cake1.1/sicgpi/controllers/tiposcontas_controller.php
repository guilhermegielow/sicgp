<?php
class TiposcontasController extends AppController {

	var $name = 'Tiposcontas';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposconta->recursive = 0;
		$this->set('tiposcontas', $this->Tiposconta->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposconta.');
			$this->redirect('/tiposcontas/index');
		}
		$this->set('tiposcontas', $this->Tiposconta->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposconta->save($this->data)) {
				$this->Session->setFlash('Tipo de conta inserida com sucesso.');
				$this->redirect('/tiposcontas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Tiposconta');
				$this->redirect('/tiposcontas/index');
			}
			$this->data = $this->Tiposconta->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposconta->save($this->data)) {
				$this->Session->setFlash('Tipo de conta editada com sucesso.');
				$this->redirect('/tiposcontas/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposconta');
			$this->redirect('/tiposcontas/index');
		}
		if($this->Tiposconta->del($id)) {
			$this->Session->setFlash('Tipo de conta Excluída: id '.$id.'');
			$this->redirect('/tiposcontas/index');
		}
	}

}
?>
