<?php
class UnidadesController extends AppController {

	var $name = 'Unidades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
	  $this->checkAcess();
		$this->Unidade->recursive = 0;
		$this->set('unidades', $this->Unidade->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Unidade.');
			$this->redirect('/unidades/index');
		}
		$this->set('unidade', $this->Unidade->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Unidade->save($this->data)) {
				$this->Session->setFlash('Unidade inserida com sucesso.');
				$this->redirect('/unidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Unidade');
				$this->redirect('/unidades/index');
			}
			$this->data = $this->Unidade->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Unidade->save($this->data)) {
				$this->Session->setFlash('Unidade editada com sucesso.');
				$this->redirect('/unidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Unidade');
			$this->redirect('/unidades/index');
		}
		if($this->Unidade->del($id)) {
			$this->Session->setFlash('Unidade Excluída: id '.$id.'');
			$this->redirect('/unidades/index');
		}
	}

}
?>
