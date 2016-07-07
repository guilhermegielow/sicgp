<?php
class AcosController extends AppController {

	var $name = 'Acos';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
	$this->checkAcess();
		$this->Aco->recursive = 0;
		$this->set('acos', $this->Aco->findAll());
	}

	function view($id = null) {
	$this->checkAcess();
		if(!$id) {
			$this->Session->setFlash('ID inválido para Aco.');
			$this->redirect('/acos/index');
		}
		$this->set('aco', $this->Aco->read(null, $id));
	}

	function add() {
	$this->checkAcess();
		if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Aco->save($this->data)) {
				$this->Session->setFlash('Aco inserido com sucesso.');
				$this->redirect('/acos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Aco');
				$this->redirect('/acos/index');
			}
			$this->data = $this->Aco->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Aco->save($this->data)) {
				$this->Session->setFlash('Aco editado com sucesso.');
				$this->redirect('/acos/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('ID inválido para Aco');
			$this->redirect('/acos/index');
		}
		if($this->Aco->del($id)) {
			$this->Session->setFlash('Aco Excluído: id '.$id.'');
			$this->redirect('/acos/index');
		}
	}

}
?>
