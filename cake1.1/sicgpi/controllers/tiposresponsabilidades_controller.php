<?php
class TiposresponsabilidadesController extends AppController {

	var $name = 'Tiposresponsabilidades';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript');

	function index() {
		$this->checkAcess();
    $this->Tiposresponsabilidade->recursive = 0;
		$this->set('tiposresponsabilidades', $this->Tiposresponsabilidade->findAll());
	}

	function view($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposresponsabilidade.');
			$this->redirect('/tiposresponsabilidades/index');
		}
		$this->set('tiposresponsabilidade', $this->Tiposresponsabilidade->read(null, $id));
	}

	function add() {
		$this->checkAcess();
    if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Tiposresponsabilidade->save($this->data)) {
				$this->Session->setFlash('Tipo de responsabilidade inserida com sucesso.');
				$this->redirect('/tiposresponsabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function edit($id = null) {
		$this->checkAcess();
    if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Id inválido para Tiposresponsabilidade');
				$this->redirect('/tiposresponsabilidades/index');
			}
			$this->data = $this->Tiposresponsabilidade->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Tiposresponsabilidade->save($this->data)) {
				$this->Session->setFlash('Tipo de responsabilidade editada com sucesso.');
				$this->redirect('/tiposresponsabilidades/index');
			} else {
				$this->Session->setFlash('Por favor, corrija os erros abaixo.');
			}
		}
	}

	function delete($id = null) {
		$this->checkAcess();
    if(!$id) {
			$this->Session->setFlash('ID inválido para Tiposresponsabilidade');
			$this->redirect('/tiposresponsabilidades/index');
		}
		if($this->Tiposresponsabilidade->del($id)) {
			$this->Session->setFlash('Tipo de responsabilidade Excluída: id '.$id.'');
			$this->redirect('/tiposresponsabilidades/index');
		}
	}

}
?>
