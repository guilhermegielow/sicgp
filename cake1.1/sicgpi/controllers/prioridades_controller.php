<?php
class PrioridadesController extends AppController {

	var $name = 'Prioridades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Prioridade->recursive = 0;
		$this->set('prioridades', $this->Prioridade->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Prioridade.');
			$this->redirect('/prioridades/index');
		}
		$this->set('prioridade', $this->Prioridade->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Prioridade->save($this->data)) {
				$this->Session->setFlash('Prioridade inserida com sucesso.');
				$this->redirect('/prioridades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Prioridade');
				$this->redirect('/prioridades/index');
			}
			$this->data = $this->Prioridade->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Prioridade->save($this->data)) {
				$this->Session->setFlash('Prioridade editada com sucesso.');
				$this->redirect('/prioridades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Prioridade');
			$this->redirect('/prioridades/index');
		}
		if($this->Prioridade->del($id)) {
			$this->Session->setFlash('Prioridade Excluída: id '.$id.'');
			$this->redirect('/prioridades/index');
		}
	}

}
?>
