<?php
class TiposreunioesController extends AppController {

	var $name = 'Tiposreunioes';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposreuniao->recursive = 0;
		$this->set('tiposreunioes', $this->Tiposreuniao->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposreuniao.');
			$this->redirect('/tiposreunioes/index');
		}
		$this->set('tiposreuniao', $this->Tiposreuniao->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposreuniao->save($this->data)) {
				$this->Session->setFlash('Tipo de reunião inserida com sucesso.');
				$this->redirect('/tiposreunioes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Tiposreuniao');
				$this->redirect('/tiposreunioes/index');
			}
			$this->data = $this->Tiposreuniao->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposreuniao->save($this->data)) {
				$this->Session->setFlash('Tipo de reunião editada com sucesso.');
				$this->redirect('/tiposreunioes/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposreuniao');
			$this->redirect('/tiposreunioes/index');
		}
		if($this->Tiposreuniao->del($id)) {
			$this->Session->setFlash('Tipo de reunião Excluída: id '.$id.'');
			$this->redirect('/tiposreunioes/index');
		}
	}

}
?>
