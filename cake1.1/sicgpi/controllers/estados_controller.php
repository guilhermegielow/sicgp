<?php
class EstadosController extends AppController {

	var $name = 'Estados';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Estado->recursive = 0;
		$this->set('estados', $this->Estado->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Estado.');
			$this->redirect('/estados/index');
		}
		$this->set('estado', $this->Estado->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Estado->save($this->data)) {
				$this->Session->setFlash('Estado inserido com sucesso.');
				$this->redirect('/estados/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Estado');
				$this->redirect('/estados/index');
			}
			$this->data = $this->Estado->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Estado->save($this->data)) {
				$this->Session->setFlash('Estado editado com sucesso.');
				$this->redirect('/estados/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Estado');
			$this->redirect('/estados/index');
		}
		if($this->Estado->del($id)) {
			$this->Session->setFlash('Estado Excluído: id '.$id.'');
			$this->redirect('/estados/index');
		}
	}

}
?>
